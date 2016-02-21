<?php

namespace App\Controller;

class ChroniclesController extends AppController {

    public $helpers = ['Tanuck/Markdown.Markdown'];

    public function initialize() {
        parent::initialize();
        $this->loadModel('Groups');
    }

    public function isAuthorized($user) {
        // Public actions
        if (in_array($this->request->action, [
                    'index',
                ])) {
            return true;
        }

        // These actions require a valid Group Id that the user owns
        if (in_array($this->request->action, [
                    'add',
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
            if ($this->Groups->isOwnedBy($group_id, $user['id'])) {
                return true;
            }
        }

        return parent::isAuthorized($user);
    }

    public function index($group_id) {
        $chronicles = $this->Chronicles->findByGroupId($group_id);

        if (!$this->request->is('json')) {
            $chronicles = $this->paginate($chronicles);
        }

        $this->set('chronicles', $chronicles);
        $this->set('_serialize', ['chronicles']);
    }

    public function add($group_id) {
        $chronicle = $this->Chronicles->newEntity();
        $chronicle->group_id = (int) $group_id;
        $chronicle->user_id = $this->Auth->user('id');

        if ($this->request->is('post')) {
            $chronicle = $this->Chronicles->patchEntity($chronicle, $this->request->data);
            if ($this->Chronicles->save($chronicle)) {
                $this->Flash->success(__('The chronicle has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The chronicle could not be saved. Please, try again.'));
                dump($chronicle);
            }
        }

        $this->set('chronicle', $chronicle);
        $this->set('_serialize', ['chronicle']);
    }

    public function edit_for_group() {
        $this->request->allowMethod(['post']);

        $group_id = (int) $this->request->data['group_id'];

        $chronicles = $this->Chronicles
                ->find()
                ->where(['group_id' => $group_id]);

        $this->set('chronicles', $chronicles);
        $this->set('_serialize', ['chronicles']);
    }

}
