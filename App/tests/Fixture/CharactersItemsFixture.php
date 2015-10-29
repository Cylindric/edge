<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

class CharactersItemsFixture extends TestFixture
{
    public $import = ['table' => 'characters_items'];

    public $records = [
        [ 'character_id' => 1, 'item_id' => 1, 'carried' => true, 'equipped' => true ],
    ];
}