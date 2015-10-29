<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

class XpFixture extends TestFixture
{
    public $import = ['table' => 'xp'];

    public $records = [
        [ 'character_id' => 1, 'value' => 2 ],
        [ 'character_id' => 1, 'value' => 4 ],

        [ 'character_id' => 2, 'value' => 8 ],
        [ 'character_id' => 2, 'value' => 16 ],

        [ 'character_id' => 3, 'value' => 32 ],

        [ 'character_id' => 4, 'value' => 64 ],
    ];
}