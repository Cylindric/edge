<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

class CharactersSkillsFixture extends TestFixture
{
    public $import = ['table' => 'characters_skills'];

    public $records = [
        [ 'character_id' => 1, 'skill_id' => 1, 'level' => 1, 'career' => true ],
    ];
}