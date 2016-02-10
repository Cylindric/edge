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
        $this->assertEquals(3, $char->total_credits);

        $char5 = $this->Characters->findByName('no credits')->first();
        $this->assertEquals(0, $char5->total_credits);
    }

    public function testGetTotalXp()
    {
        $char = $this->Characters->findByName('basic')->first();
        $this->assertEquals(6, $char->total_xp);

        $char5 = $this->Characters->findByName('no xp')->first();
        $this->assertEquals(0, $char5->total_xp);
    }

    public function testGetTotalObligation()
    {
        $char = $this->Characters->findByName('basic')->first();
        $this->assertEquals(12, $char->total_obligation);

        $char5 = $this->Characters->findByName('no obligations')->first();
        $this->assertEquals(0, $char5->total_obligation);
    }

    public function testGetTotalSoak()
    {
        $char = $this->Characters->findByName('basic')->first();
        $this->assertEquals(3, $char->total_soak);
    }

    public function testGetTotalStrainThreshold()
    {
        $char = $this->Characters->findByName('basic')->first();
        $this->assertEquals(22, $char->total_strain_threshold);
    }

    public function testGetTotalDefence()
    {
        $char = $this->Characters->findByName('basic')->first();
        $this->assertEquals(2, $char->total_defence['melee']);
        $this->assertEquals(2, $char->total_defence['ranged']);
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