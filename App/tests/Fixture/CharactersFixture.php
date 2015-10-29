<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

class CharactersFixture extends TestFixture
{
    public $import = ['table' => 'characters'];

    public $records = [
        /* 1 */ ['name' => 'basic', 'stat_br' => 1, 'stat_ag' => 2, 'stat_int' => 3, 'stat_cun' => 4, 'stat_will' => 5, 'stat_pr' => 6],
        /* 2 */ ['name' => 'group1member1', 'group_id' => 1],
        /* 3 */ ['name' => 'group1member2', 'group_id' => 1],
        /* 4 */ ['name' => 'group1member3', 'group_id' => 1],
        /* 5 */ ['name' => 'no cred, talent, ob, xp'],
    ];
}