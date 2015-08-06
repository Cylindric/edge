<?php
namespace App\Test\TestCase\Model\Entity;

use App\Model\Entity\species;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Entity\species Test Case
 */
class speciesTest extends TestCase
{

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $this->species = new species();
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->species);

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
