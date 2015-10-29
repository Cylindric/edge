<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

class CharactersWeaponsFixture extends TestFixture
{
    public $import = ['table' => 'characters_weapons'];

    public $records = [
        [ 'character_id' => 1, 'weapon_id' => 1, 'equipped' => true ],
    ];
}