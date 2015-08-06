<?php
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;

class AppController extends Controller
{

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Flash');
		$this->loadComponent('Auth', [
			'authorize' => ['Controller'],
			'loginRedirect' => [
				'controller' => 'Characters',
				'action' => 'index'
			],
			'logoutRedirect' => [
				'controller' => 'Pages',
				'action' => 'display',
				'home'
			]
		]);
	}
	
	public function isAuthorized($user)
	{
		if (isset($user['role']) && $user['role'] === 'admin') {
			return true;
		}
		
		return false;
	}
	
	public function beforeFilter(Event $event)
	{
		$this->Auth->allow(['view', 'display']);
		$this->set('user', $this->Auth->User());
	}
}
