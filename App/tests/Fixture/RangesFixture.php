<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

class RangesFixture extends TestFixture
{
    public $import = ['table' => 'ranges'];

    public $records = [
        /* 1 */ ['name' => 'Engaged'],
        /* 2 */ ['name' => 'Short'],
        /* 3 */ ['name' => 'Medium'],
        /* 4 */ ['name' => 'Long'],
        /* 5 */ ['name' => 'Extreme'],
    ];
}