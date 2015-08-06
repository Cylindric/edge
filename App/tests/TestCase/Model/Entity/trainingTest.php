<?php
namespace App\Test\TestCase\Model\Entity;

use App\Model\Entity\training;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Entity\training Test Case
 */
class trainingTest extends TestCase
{

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $this->training = new training();
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->training);

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
