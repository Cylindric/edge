<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

class ArmourFixture extends TestFixture
{
    public $import = ['table' => 'armour'];

    public $records = [
        /* 1 */ [ 'name' => 'basic', 'soak' => 1, 'defence' => 2 ],
    ];
}