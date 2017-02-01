<?php namespace ApprovalTests\Tests;

use PHPUnit\Framework\TestCase;
use ApprovalTests\Approvals;

class ApprovalTest extends TestCase
{
    public function testApproveArray()
    {
        $list = ['zero', 'one', 'two', 'three', 'four', 'five'];
        Approvals::approveList($list);
    }

    public function testApproveMap()
    {
        $list = [
            'zero' => 'Lance',
            'one' => 'Jim',
            'two' => 'James',
            'three' => 'LLewellyn',
            'four' => 'Asaph',
            'five' => 'Dana'
        ];
        Approvals::approveList($list);
    }

    public function testApproveString()
    {
        $fudge = 'fudge';
        Approvals::approveString($fudge);
    }
}
