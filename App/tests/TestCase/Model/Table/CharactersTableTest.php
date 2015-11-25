<?php
namespace App\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

class CharactersTableTest extends TestCase
{
    public $fixtures = [
        'app.characters',
        'app.characters_armour',
        'app.armour',
        'app.characters_talents',
        'app.talents',
        'app.credits',
        'app.obligations',
        'app.species',
        'app.xp',
    ];

    public function setUp()
    {
        parent::setUp();
        $this->Characters = TableRegistry::get('Characters');
    }

    public function testGetTotalCredits()
    {
        $char = $this->Characters->findByName('basic')->first();
        $this->assertEquals(3, $char->totalCredits);

        $char5 = $this->Characters->findByName('no credits')->first();
        $this->assertEquals(0, $char5->totalCredits);
    }

    public function testGetTotalXp()
    {
        $char = $this->Characters->findByName('basic')->first();
        $this->assertEquals(6, $char->totalXp);

        $char5 = $this->Characters->findByName('no xp')->first();
        $this->assertEquals(0, $char5->totalXp);
    }

    public function testGetTotalObligation()
    {
        $char = $this->Characters->findByName('basic')->first();
        $this->assertEquals(12, $char->totalObligation);

        $char5 = $this->Characters->findByName('no obligations')->first();
        $this->assertEquals(0, $char5->totalObligation);
    }

    public function testGetTotalSoak()
    {
        $char = $this->Characters->findByName('basic')->first();
        $this->assertEquals(3, $char->totalSoak);
    }

    public function testGetTotalStrainThreshold()
    {
        $char = $this->Characters->findByName('basic')->first();
        $this->assertEquals(22, $char->totalStrainThreshold);
    }

    public function testGetTotalDefence()
    {
        $char = $this->Characters->findByName('basic')->first();
        $this->assertEquals(2, $char->totalDefence['melee']);
        $this->assertEquals(2, $char->totalDefence['ranged']);
    }

    public function testGetBrawn()
    {
        $char = $this->Characters->findByName('basic')->first();
        $this->assertEquals(1, $char->brawn);
    }

    public function testGetAgility()
    {
        $char = $this->Characters->findByName('basic')->first();
        $this->assertEquals(2, $char->agility);
    }

    public function testGetIntellect()
    {
        $char = $this->Characters->findByName('basic')->first();
        $this->assertEquals(3, $char->intellect);
    }

    public function testGetCunning()
    {
        $char = $this->Characters->findByName('basic')->first();
        $this->assertEquals(4, $char->cunning);
    }

    public function testGetWillpower()
    {
        $char = $this->Characters->findByName('basic')->first();
        $this->assertEquals(5, $char->willpower);
    }

    public function testGetPresence()
    {
        $char = $this->Characters->findByName('basic')->first();
        $this->assertEquals(6, $char->presence);
    }

}