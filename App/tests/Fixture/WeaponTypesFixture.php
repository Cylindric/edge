<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

class WeaponTypesFixture extends TestFixture
{
    public $import = ['table' => 'weapon_types'];

    public $records = [
        ['name' => 'Energy Weapons'],
        ['name' => 'Slugthrowers'],
        ['name' => 'Thrown Weapons'],
        ['name' => 'Explosives and Other Weapons'],
        ['name' => 'Brawling Weapons'],
        ['name' => 'Melee Weapons'],
    ];
}