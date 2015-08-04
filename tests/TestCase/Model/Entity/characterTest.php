<?php
namespace App\Test\TestCase\Model\Entity;

use App\Model\Entity\character;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Entity\character Test Case
 */
class characterTest extends TestCase
{

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $this->character = new character();
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->character);

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
