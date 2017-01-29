<?php namespace ApprovalTests\Tests;

use PHPUnit\Framework\TestCase;
use ApprovalTests\Approvals;
use ApprovalTests\Reporters\OpenDiffReporter;

class ApprovalTest extends TestCase {
	public function testApproveArray() {
		//Approvals::useReporter(new OpenDiffReporter());
		$list = array('zero', 'one', 'two', 'three', 'four', 'five');
		Approvals::approveList($list);
	}

	public function testApproveMap() {
		//Approvals::useReporter(new OpenDiffReporter());
		$list = array(
			'zero' => 'Lance',
			'one' => 'Jim',
			'two' => 'James',
			'three' => 'LLewellyn',
			'four' => 'Asaph',
			'five' => 'Dana'
		);
		Approvals::approveList($list);
	}
}
?>
