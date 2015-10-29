<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

class StatsFixture extends TestFixture
{
    public $import = ['table' => 'stats'];

    public $records = [
        /* 1 */ ['name' => 'Brawn', 'code' => 'br'],
        /* 2 */ ['name' => 'Agility', 'code' => 'ag'],
        /* 3 */ ['name' => 'Intellect', 'code' => 'int'],
        /* 4 */ ['name' => 'Cunning', 'code' => 'cun'],
        /* 5 */ ['name' => 'Willpower', 'code' => 'will'],
        /* 6 */ ['name' => 'Presence', 'code' => 'pr']
    ];
}