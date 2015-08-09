<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

class SpeciesFixture extends TestFixture
{
    public $connection = 'test';
    public $import = ['table' => 'species', 'connection' => 'default'];

    public $records = [
        [
            'id' => 1,
            'name' => 'Human',
            'class' => 'Human',
            'stat_br' => 2,
            'stat_ag' => 2,
            'stat_int' => 2,
            'stat_cun' => 2,
            'stat_will' => 2,
            'stat_pr' => 2,
        ],
    ];
}