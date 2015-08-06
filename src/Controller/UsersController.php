<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

class UsersController extends AppController
{

	public function beforeFilter(Event $event)
	{
		parent::beforeFilter($event);
		$this->Auth->allow('logout');
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

	public function login()
	{
		if ($this->request->is('post')) {
			$user = $this->Auth->identify();
			if ($user) {
				$this->Auth->setUser($user);
				return $this->redirect($this->Auth->redirectUrl());
			}
			$this->Flash->error(__('Invalid username or password, try again'));
		}
	}

	public function logout()
	{
		return $this->redirect($this->Auth->logout());
	}
}
