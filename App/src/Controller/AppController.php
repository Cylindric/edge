<?php

namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\I18n\Time;
use Cake\Core\Configure;
use \Ceeram\Blame\Controller\BlameTrait;

class AppController extends Controller {

    use BlameTrait;

    var $CurrentUser = null;

    public function initialize() {
        parent::initialize();
        $this->loadComponent('RequestHandler');
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
        $this->loadComponent('Slack', [
            'webhook_url' => Configure::read('Slack.webhook_url'),
            'enabled' => Configure::read('Slack.enabled')
        ]);
        Time::$defaultLocale = 'en-GB';
    }

    public function isAuthorized($user) {
        if (isset($user['role']) && $user['role'] === 'admin') {
            return true;
        }

        return false;
    }

    public function beforeFilter(Event $event) {
        $this->Auth->allow(['view', 'display']);
        $this->loadModel('Users');

        $cookie = $this->Cookie->read('rememberMe');
        if (is_array($cookie) && !$this->Auth->User()) {

            if ($this->Users->checkLogin($cookie['username'], $cookie['password'])) {
                $this->Auth->setUser($this->Users->data->toArray());
            }
        }

        if ($this->Auth->user()) {
            $this->CurrentUser = $this->Users->get($this->Auth->User('id'));
        } else {
            $this->CurrentUser = null;
        }
        
        $this->set('debug', Configure::read('debug'));
        $this->set('user', $this->CurrentUser);
        $this->set('version', Configure::read('rpgApp.version'));
    }

}
