<?php namespace ApprovalTests\Tests;

use Exception;
use PHPUnit\Framework\TestCase;
use ApprovalTests\Approvals;
use ApprovalTests\Reporters\QuietReporter;

# begin-snippet: array_example
class ApprovalTest extends TestCase
{
    public function testVerifyArray()
    {
        $list = ['zero', 'one', 'two', 'three', 'four', 'five'];
        Approvals::verifyList($list);
    }
    # end-snippet

    public function testFailedVerifyArray()
    {
        $this->expectException(Exception::class);
        $list = ['zero', 'one', 'two', 'three', 'four', 'five'];
        Approvals::verifyList($list, new QuietReporter());
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

    # begin-snippet: verify_as_json
    public function testVerifyAsJson()
    {
        $obj = [
            "color" => "black",
            "category" => "hue",
            "type" => "primary",
            "code" => [
                "rgba" => [255, 255, 255, 1],
                "hex" => "#000",
            ]
        ];
        Approvals::verifyAsJson($obj);
    }
    # end-snippet
}
