<?php
namespace App\Test\TestCase\Model\Entity;

use App\Model\Entity\Xp;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Entity\Xp Test Case
 */
class XpTest extends TestCase
{

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $this->Xp = new Xp();
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Xp);

        parent::tearDown();
    }

    /**
     * Test IsLocked method
     *
     * @return void
     */
    public function testIsLocked()
    {
        $this->Xp->created_by = 1;

        // specified user is the person that created the record
        $this->assertFalse($this->Xp->IsLocked(1));

        // specified user is NOT the person that created the record
        $this->assertTrue($this->Xp->IsLocked(2));

        // specified user is the GM and the creator
        $this->assertFalse($this->Xp->IsLocked(1, 1));

        // specified user is the GM but not the creator
        $this->assertFalse($this->Xp->IsLocked(2, 2));

    }
}
