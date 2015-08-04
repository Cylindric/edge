<?php
namespace App\Test\TestCase\Model\Entity;

use App\Model\Entity\growth;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Entity\growth Test Case
 */
class growthTest extends TestCase
{

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $this->growth = new growth();
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->growth);

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
