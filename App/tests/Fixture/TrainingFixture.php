<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

class TrainingFixture extends TestFixture
{
    public $connection = 'test';
    public $import = ['table' => 'training', 'connection' => 'default'];

    public $records = [
        [
            'id' => 1,
            'character_id' => 1,
            'skill_id' => 2,
            'level' => 2,
        ],
    ];

}