<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

class StatsFixture extends TestFixture
{
    public $connection = 'test';
    public $import = ['table' => 'stats', 'connection' => 'default'];

    public $records = [
        [
            'id' => 1,
            'name' => 'Brawn',
            'code' => 'br',
        ],
        [
            'id' => 2,
            'name' => 'Agility',
            'code' => 'ag',
        ],
        [
            'id' => 3,
            'name' => 'Intellect',
            'code' => 'int',
        ],
    ];
}