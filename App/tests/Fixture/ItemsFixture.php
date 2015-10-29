<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

class ItemsFixture extends TestFixture
{
    public $import = ['table' => 'items'];

    public $records = [
        /* 1 */ [ 'name' => 'basic item', 'item_type_id' => 1 ],
    ];
}