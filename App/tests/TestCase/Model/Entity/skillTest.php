<?php
namespace App\Test\TestCase\Model\Entity;

use App\Model\Entity\Skill;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Entity\Skill Test Case
 */
class SkillTest extends TestCase
{

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $this->Skill = new Skill();
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Skill);

        parent::tearDown();
    }

    /**
     * Test _getLevel method
     *
     * @return void
     */
    public function testGetLevel()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test dice method
     *
     * @return void
     */
    public function testDice()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
