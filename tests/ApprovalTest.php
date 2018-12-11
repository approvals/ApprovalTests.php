<?php namespace ApprovalTests\Tests;

use Exception;
use PHPUnit\Framework\TestCase;
use ApprovalTests\Approvals;

class ApprovalTest extends TestCase
{
    public function testVerifyArray()
    {
        $list = ['zero', 'one', 'two', 'three', 'four', 'five'];
        Approvals::verifyList($list);
    }

    public function testFailedVerifyArray()
    {
        $this->expectException(Exception::class);
        $list = ['zero', 'one', 'two', 'three', 'four', 'five'];
        Approvals::verifyList($list);
    }

    public function testVerifyMap()
    {
        $list = [
            'zero' => 'Lance',
            'one' => 'Jim',
            'two' => 'James',
            'three' => 'LLewellyn',
            'four' => 'Asaph',
            'five' => 'Dana'
        ];
        Approvals::verifyList($list);
    }

    public function testVerifyString()
    {
        $fudge = 'fudge';
        Approvals::verifyString($fudge);
    }
}
