<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

class CharactersTalentsFixture extends TestFixture
{
    public $import = ['table' => 'characters_talents'];

    public $records = [
        [ 'character_id' => 1, 'talent_id' => 1 ],
    ];
}