<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

class NotesFixture extends TestFixture
{
    public $import = ['table' => 'notes'];

    public $records = [
        /* 1 */ [ 'note' => 'basic note', 'private' => false ],
    ];
}