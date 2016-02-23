<?php

namespace App\Controller;

use \Cake\Network\Exception\ForbiddenExceptionException;
use \Cake\Datasource\Exception\NotFoundException;

class ChroniclesController extends AppController {

    public $helpers = ['Tanuck/Markdown.Markdown'];

    public function initialize() {
        parent::initialize();
        $this->loadModel('Groups');
    }

    public function isAuthorized($user) {
        // Public actions
        if ($this->request->action === 'index') {
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

    public function index($group_id = 0) {

        if ($this->request->is('post')) {
            $group_id = $this->request->data('group_id');
        }

        $group = $this->Groups
                ->findById($group_id)
                ->contain([
                    'GroupsUsers' => function($q) {
                        return $q->select(['group_id', 'user_id', 'gm'])
                                ->where(['GroupsUsers.gm' => true]);
                    }])
                ->first();
dump($group);
                $chronicles = $this->Chronicles
                        ->findByGroupId($group->id)
                        ->where(['OR' => [
                        ['published' => true],
                        ['created_by' => $this->Auth->user('id')]
                    ],
                ]);

                if ($this->request->is('json')) {
                    foreach ($chronicles as $c) {
                        $c->editable = $c->canEdit($this->Auth->user('id'), $group->GroupsUsers->gm);
                    }
                }

                $this->set('chronicles', $chronicles);
                $this->set('_serialize', 'chronicles');
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
        