<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

class CharactersFixture extends TestFixture
{
    public $import = ['table' => 'characters'];

    public $records = [
        /* 1 */ ['user_id' => 2, 'species_id' => 1, 'name' => 'basic', 'stat_br' => 1, 'stat_ag' => 2, 'stat_int' => 3, 'stat_cun' => 4, 'stat_will' => 5, 'stat_pr' => 6],
        /* 2 */ ['user_id' => 2, 'species_id' => 1, 'name' => 'group1member1'],
        /* 3 */ ['user_id' => 2, 'species_id' => 1, 'name' => 'group1member2'],
        /* 4 */ ['user_id' => 2, 'species_id' => 1, 'name' => 'group1member3'],
        /* 5 */ ['user_id' => 2, 'species_id' => 1, 'name' => 'no credits'],
        /* 6 */ ['user_id' => 2, 'species_id' => 1, 'name' => 'no talents'],
        /* 7 */ ['user_id' => 2, 'species_id' => 1, 'name' => 'no obligations'],
        /* 8 */ ['user_id' => 2, 'species_id' => 1, 'name' => 'no xp'], 
    ];
}