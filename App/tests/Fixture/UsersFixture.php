<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

class UsersFixture extends TestFixture
{
    public $import = ['table' => 'users'];

    public $records = [
        /* 1 */ [ 'username' => 'admin', 'role' => 'admin' ],
        /* 2 */ [ 'username' => 'user', 'role' => 'user' ],
        /* 3 */ [ 'username' => 'gm', 'role' => 'user' ],
    ];
}