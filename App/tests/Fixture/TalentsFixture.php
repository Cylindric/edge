<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

class TalentsFixture extends TestFixture
{
    public $connection = 'test';
    public $import = ['table' => 'talents', 'connection' => 'default'];

    public $records = [
        [
            'id' => 1,
            'name' => 'Adversary',
            'description' => '',
            'ranked' => 1,
            'activation_type' => 'Active',
            'page' => 132,
            'created' => '2015-08-09 21:12:47',
            'modified' => '2015-08-09 21:12:47'
        ],
    ];
}
