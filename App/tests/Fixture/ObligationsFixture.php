<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

class ObligationsFixture extends TestFixture
{
    public $import = ['table' => 'obligations'];

    public $records = [
        [ 'character_id' => 1, 'value' => 4 ],
        [ 'character_id' => 1, 'value' => 8 ],

        [ 'character_id' => 2, 'value' => 16 ],
        [ 'character_id' => 2, 'value' => 32 ],

        [ 'character_id' => 3, 'value' => 64 ],

        [ 'character_id' => 4, 'value' => 128 ],
    ];
}