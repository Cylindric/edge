<?php
namespace App\Test\TestCase\Model\Entity;

use App\Model\Entity\Obligation;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Entity\Obligation Test Case
 */
class ObligationTest extends TestCase
{

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $this->Obligation = new Obligation();
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Obligation);

        parent::tearDown();
    }

    /**
     * Test IsLocked method
     *
     * @return void
     */
    public function testIsLocked()
    {
        $this->Obligation->created_by = 1;

        // specified user is the person that created the record
        $this->assertFalse($this->Obligation->IsLocked(1));

        // specified user is NOT the person that created the record
        $this->assertTrue($this->Obligation->IsLocked(2));

        // specified user is the GM and the creator
        $this->assertFalse($this->Obligation->IsLocked(1, 1));

        // specified user is the GM but not the creator
        $this->assertFalse($this->Obligation->IsLocked(2, 2));

    }
}
