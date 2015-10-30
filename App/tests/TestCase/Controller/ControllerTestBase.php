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

    protected function setNormalUser()
    {
        $user = $this->Users->findByUsername('user')->first();

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

    protected function setGmUser()
    {
        $user = $this->Users->findByUsername('gm')->first();
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
