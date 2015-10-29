<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

class TalentsFixture extends TestFixture
{
    public $import = ['table' => 'talents'];

    public $records = [
        /* 1 */ [ 'name' => 'basic', 'soak_per_rank' => 1, 'strain_per_rank' => 2 ],
    ];
}