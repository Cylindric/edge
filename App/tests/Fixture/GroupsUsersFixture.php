<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

class GroupsUsersFixture extends TestFixture
{
    public $import = ['table' => 'groups_users'];

    public $records = [
        [ 'group_id' => 1, 'user_id' => 3, 'gm' => true ],
        [ 'group_id' => 1, 'user_id' => 2, 'gm' => false ],
    ];
}