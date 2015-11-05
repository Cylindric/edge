<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

class UsersController extends AppController
{
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow(['login', 'register']);
    }

    public function isAuthorized($user)
    {
        // Public actions
        if (in_array($this->request->action, [
            'register',
            'login',
            'logout',
        ])) {
            return true;
        }

        return parent::isAuthorized($user);
    }

    public function index()
    {
        $this->set('users', $this->paginate($this->Users->find('all')));
    }

    public function view($id)
    {
        $user = $this->Users->get($id);
        $this->set(compact('user'));
    }

    public function register()
    {
        $newUser = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $newUser = $this->Users->patchEntity($newUser, $this->request->data);
            if ($this->Users->save($newUser)) {
                $this->Flash->success(__('Registration successful.'));

                $authUser = $this->Users->get($newUser->id)->toArray();
                $this->Auth->setUser($authUser);

                return $this->redirect(['controller' => 'characters', 'action' => 'index']);
            }
        }
        $this->set('newUser', $newUser);
    }

    public function add()
    {
        $newUser = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $newUser = $this->Users->patchEntity($newUser, $this->request->data);
            if ($this->Users->save($newUser)) {
                $this->Flash->success(__('The user has been saved.'));
                return $this->redirect(['action' => 'add']);
            }
            $this->Flash->error(__('Unable to add the user.'));
        }
        $this->set('newUser', $newUser);
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);

        if ($user->id == $this->Auth->user('id')) {
            $this->Flash->error(__('You cannot delete yourself!'));
            return $this->redirect(['action' => 'index']);
        }
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }

    public function edit($id)
    {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {

            if (!empty(trim($this->request->data['new_password']) && $this->request->data['new_password'] == $this->request->data['password_confirm'])) {
                $this->request->data['password'] = trim($this->request->data['new_password']);
            }

            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The User has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The User could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);

    }

    public function login()
    {
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);

                if ($this->request->data['remember_me']) {
                    $cookie = array();
                    $cookie['username'] = $this->request->data['username'];
                    $cookie['password'] = $this->request->data['password'];
                    $this->Cookie->write('rememberMe', $cookie, true, "1 month");
                } else {
                    $this->Cookie->delete('rememberMe');
                }

                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Flash->error(__('Invalid username or password, try again'));
        }
    }

    public function logout()
    {
        $this->Cookie->delete('rememberMe');
        return $this->redirect($this->Auth->logout());
    }
}
