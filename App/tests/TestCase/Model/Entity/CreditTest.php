<?php
namespace App\Test\TestCase\Model\Entity;

use App\Model\Entity\Credit;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Entity\Credit Test Case
 */
class CreditTest extends TestCase
{

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $this->Credit = new Credit();
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Credit);

        parent::tearDown();
    }

    /**
     * Test IsLocked method
     *
     * @return void
     */
    public function testIsLocked()
    {
        $this->Credit->created_by = 1;

        // specified user is the person that created the record
        $this->assertFalse($this->Credit->IsLocked(1));

        // specified user is NOT the person that created the record
        $this->assertTrue($this->Credit->IsLocked(2));

        // specified user is the GM and the creator
        $this->assertFalse($this->Credit->IsLocked(1, 1));

        // specified user is the GM but not the creator
        $this->assertFalse($this->Credit->IsLocked(2, 2));

    }
}
