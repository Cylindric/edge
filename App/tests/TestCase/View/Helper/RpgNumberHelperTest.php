<?php

namespace App\Test\TestCase\View\Helper;

use App\View\Helper\RpgNumberHelper;
use Cake\TestSuite\TestCase;
use Cake\View\View;

class RpgNumberHelperTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
        $View = new View();
        $this->RpgNumber = new RpgNumberHelper($View);
    }

    public function testNumbersSmallerThan1000NotChanged()
    {
        $result = $this->RpgNumber->toReadableSize(1);
        $this->assertEquals("1", $result, "Expected 1, got $result");

    }

    public function testNumbersGreaterThan1K()
    {
        $result = $this->RpgNumber->toReadableSize(1000);
        $this->assertEquals("1k", $result);

        $result = $this->RpgNumber->toReadableSize(1300);
        $this->assertEquals("1.3k", $result);
    }

    public function testNumbersGreaterThan1M()
    {
        $result = $this->RpgNumber->toReadableSize(1000000);
        $this->assertEquals("1m", $result);

        $result = $this->RpgNumber->toReadableSize(1300000);
        $this->assertEquals("1.3m", $result);
    }

    public function testNumbersGreaterThan1B()
    {
        $result = $this->RpgNumber->toReadableSize(1000000000);
        $this->assertEquals("1b", $result);

        $result = $this->RpgNumber->toReadableSize(1300000000);
        $this->assertEquals("1.3b", $result);
    }

    public function testNumbersGreaterThan1T()
    {
        $result = $this->RpgNumber->toReadableSize(1000000000000);
        $this->assertEquals("1t", $result);

        $result = $this->RpgNumber->toReadableSize(1300000000000);
        $this->assertEquals("1.3t", $result);
    }
}