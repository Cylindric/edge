<?php
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\I18n\Time;

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
                'controller' => 'Users',
                'action' => 'login'
            ]
        ]);
        $this->loadComponent('Cookie');
        Time::$defaultLocale = 'en-GB';

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

        $cookie = $this->Cookie->read('rememberMe');
        if (is_array($cookie) && !$this->Auth->User()) {
            if ($this->Users->checkLogin($cookie['username'], $cookie['password'])) {
                $this->Auth->setUser($this->Users->data);
            }
        }

        $this->set('user', $this->Auth->User());
    }
}
