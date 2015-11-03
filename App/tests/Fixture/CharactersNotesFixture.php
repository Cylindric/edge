<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

class CharactersNotesFixture extends TestFixture
{
    public $import = ['table' => 'characters_notes'];

    public $records = [
        [ 'character_id' => 1, 'note_id' => 1 ],
    ];
}