<?php
namespace App\Test\TestCase\Controller;

use App\Controller\UsersController;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\IntegrationTestCase;

class ControllerTestBase extends IntegrationTestCase
{

    public function setUp()
    {
        $this->Users = TableRegistry::get('Users');
    }

    protected function setUser($username)
    {
        $user = $this->Users->findByUsername($username)->first();

        $this->session([
            'Auth' => [
                'User' => [
                    'id' => $user->id,
                    'username' => $user->username,
                    'role' => $user->role,
                ]
            ]
        ]);
    }

    protected function setJson()
    {
        $this->configRequest([
            'headers' => ['Accept' => 'application/json']
        ]);
    }

}
