<?php namespace ApprovalTests\Tests;

use PHPUnit\Framework\TestCase;
use ApprovalTests\Namers\PHPUnitNamer;

class PHPUnitNamerTest extends TestCase
{
    public function testTheClassParts()
    {
        $namer = new PHPUnitNamer();
        $this->assertEquals('ApprovalTests\\Tests\\PHPUnitNamerTest', $namer->getCallingTestClassName());
        $this->assertEquals('testTheClassParts', $namer->getCallingTestMethodName());
        $this->assertEquals(dirname(__FILE__), $namer->getCallingTestDirectory());
    }
}
