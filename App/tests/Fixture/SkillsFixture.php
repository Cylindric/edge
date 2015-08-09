<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

class SkillsFixture extends TestFixture
{
    public $connection = 'test';
    public $import = ['table' => 'skills', 'connection' => 'default'];

    public $records = [
        [
            'id' => 1,
            'stat_id' => 3,
            'skilltype_id' => 1,
            'name' => 'Astrogation',
        ],
        [
            'id' => 2,
            'stat_id' => 1,
            'skilltype_id' => 1,
            'name' => 'Athletics',
        ],
    ];
}