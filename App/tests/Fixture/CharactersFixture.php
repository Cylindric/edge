<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

class CharactersFixture extends TestFixture
{
    public $connection = 'test';
    public $import = ['table' => 'characters', 'connection' => 'default'];

    public $records = [
        [
            'id' => 1,
            'user_id' => 1,
            'species_id' => 1,
            'name' => 'char1',
            'stat_br' => 2,
            'stat_ag' => 2,
            'stat_int' => 2,
            'stat_cun' => 2,
            'stat_will' => 2,
            'stat_pr' => 2,
        ],
    ];
}