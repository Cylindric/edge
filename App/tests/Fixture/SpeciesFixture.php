<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

class SpeciesFixture extends TestFixture
{
    public $import = ['table' => 'species'];

    public $records = [
        /* 1 */ [ 'name' => 'species1', 'base_wound' => 10, 'base_strain' => 15 ],
    ];
}