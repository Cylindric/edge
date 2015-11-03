<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

class ItemTypesFixture extends TestFixture
{
    public $import = ['table' => 'item_types'];

    public $records = [
        /*  1 */ ['name' => 'Communications'],
        /*  2 */ ['name' => 'Poisons'],
        /*  3 */ ['name' => 'Detection'],
        /*  4 */ ['name' => 'Medical'],
        /*  5 */ ['name' => 'Cybernetics'],
        /*  6 */ ['name' => 'Entertainment'],
        /*  7 */ ['name' => 'Security'],
        /*  8 */ ['name' => 'Survival'],
        /*  9 */ ['name' => 'Tools'],
        /* 10 */ ['name' => 'Black Market'],
        /* 11 */ ['name' => 'Personal Equipment'],
    ];
}