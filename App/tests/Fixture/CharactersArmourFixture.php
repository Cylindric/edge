<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

class CharactersArmourFixture extends TestFixture
{
    public $import = ['table' => 'characters_armour'];

    public $records = [
        [ 'character_id' => 1, 'armour_id' => 1, 'equipped' => true ],
    ];
}