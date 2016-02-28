<?php

namespace App\Controller;

class ChroniclesController extends AppController {

    public $helpers = ['Tanuck/Markdown.Markdown'];

    /**
     * @internal
     */
    public function initialize() {
        parent::initialize();
        $this->loadModel('Groups');
    }

    /**
     * @internal
     */
    public function isAuthorized($user) {
        // Public actions
        if ($this->request->action === 'index') {
            return true;
        }

        $u = $this->Users->get($user['id']);

        if ($this->request->action == 'add') {
            $group = $this->Groups->get($this->request->params['pass'][0]);
            if ($group->UserCanAddChronicle($u)) {
                return true;
            }
        }

        if ($this->request->action == 'publish') {
            $chronicle = $this->Chronicles->get($this->request->data['chronicle_id']);
            if ($chronicle->CanEdit($u)) {
                return true;
            }
        }

        // These actions require a valid Group Id that the user owns
        if (in_array($this->request->action, [
                    'edit',
                ])) {
            if ($this->request->is('post')) {
                if (array_key_exists('group_id', $this->request->data)) {
                    $group_id = $this->request->data['group_id'];
                } else {
                    $group_id = $this->request->data['id'];
                }
            } else {
                $group_id = (int) $this->request->params['pass'][0];
            }

            if ($this->Groups->isOwnedBy($group_id, $u->id)) {
                return true;
            }
        }

        return parent::isAuthorized($user);
    }

    /**
     * Get the Chronicles for the Group ID passed in the POST data.
     * @param int group_id The ID of the Group to fetch stories for.
     * @param int offset The record to get, where 0 is the latest, 1 is the previous and so forth backwards in time. If omitted, all stories are returned.
     */
    public function index($group_id = 0, $offset = -1) {

        if ($this->request->is('post')) {
            $group_id = (int) $this->request->data('group_id');
            $offset = (int) $this->request->data('offset');
        }

        $group = $this->Groups->get($group_id);
        $gm = $this->Groups->getGm($group_id);

        // We only need the basic info if this isn't a full-on JSON query.
        if (!$this->request->is('json')) {
            $this->set(compact('group'));
            return;
        }
        
        $query = $this->Chronicles
                ->getVisibleForGroup($group_id, $this->CurrentUser)
                ->order('created DESC');

        $total_chronicles = $query->count();

        if ($offset >= 0) {
            $query->limit(1)->offset($offset);
        }

        $chronicles = $query->toArray();

        if ($this->request->is('json')) {
            $n = 0;
            foreach ($chronicles as $c) {
                if ($offset === -1) {
                    $c->has_next = ($n > 0);
                    $c->has_previous = ($n < $total_chronicles - 1);
                } else {
                    $c->has_next = ($offset > 0);
                    $c->has_previous = ($offset < $total_chronicles - 1);
                }
                $c->editable = $c->canEdit($this->CurrentUser, $gm->id);
                $n++;
            }
        }

        $this->set(compact('group', 'chronicles', 'total_chronicles'));
        $this->set('_serialize', ['chronicles', 'total_chronicles']);
    }

    public function add($group_id) {
        $chronicle = $this->Chronicles->newEntity();
        $chronicle->group_id = (int) $group_id;
        $chronicle->user_id = $this->Auth->user('id');

        if ($this->request->is('post')) {
            $chronicle = $this->Chronicles->patchEntity($chronicle, $this->request->data);
            if ($this->Chronicles->save($chronicle)) {
                $this->Flash->success(__('The chronicle has been saved.'));
                return $this->redirect(['action' => 'index', $group_id]);
            } else {
                $this->Flash->error(__('The chronicle could not be saved. Please, try again.'));
            }
        }

        $this->set('chronicle', $chronicle);
        $this->set('_serialize', ['chronicle']);
    }

    public function delete() {
        $this->request->allowMethod(['post']);
        $id = (int) $this->request->data['chronicle_id'];
        $chronicle = $this->Chronicles->get($id);
        if ($this->Chronicles->delete($chronicle)) {
            
        } else {
            
        }
        $this->set(compact('chronicle'));
        $this->set('_serialize', 'chronicle');
    }

    public function publish() {
        $this->request->allowMethod(['post']);
        $id = (int) $this->request->data['chronicle_id'];
        $published = (bool) $this->request->data['published'];

        $chronicle = $this->Chronicles->get($id);
        $chronicle->published = $published;
        if ($this->Chronicles->save($chronicle)) {
            $this->response->statusCode(200);
        } else {
            $this->response->statusCode(501);
        }
        $this->set(compact('chronicle'));
        $this->set('_serialize', 'chronicle');
    }

    /**
     * Get the Chronicles for the Group ID passed in the POST data.
     * @param int group_id The ID of the Group to fetch stories for.
     * @param int offset The record to get, where 0 is the latest, 1 is the previous and so forth backwards in time.
     */
    public function edit_for_group() {
        //$this->request->allowMethod(['post']);

        $group_id = (int) $this->request->data['group_id'];
        $offset = (int) $this->request->data['offset'];

        $chronicles = $this->Chronicles
                ->find()
                ->where(['group_id' => $group_id])
                ->order(['created'])
        ;
        dump($chronicles);
        $this->set('chronicles', $chronicles);
        $this->set('_serialize', ['chronicles']);
    }

}
