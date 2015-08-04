<?php
namespace App\Test\TestCase\Model\Entity;

use App\Model\Entity\skill;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Entity\skill Test Case
 */
class skillTest extends TestCase
{

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $this->skill = new skill();
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->skill);

        parent::tearDown();
    }

    /**
     * Test initial setup
     *
     * @return void
     */
    public function testInitialization()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
