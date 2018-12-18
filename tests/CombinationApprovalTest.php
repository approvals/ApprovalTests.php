<?php

use ApprovalTests\CombinationApprovals;
use ApprovalTests\SkipCombinationException;
use PHPUnit\Framework\TestCase;

class CombinationApprovalTest extends TestCase {
    public function testStep1() {
        $values = [1, 2, 3];
        CombinationApprovals::verifyAllCombinations1(function($a1) {
            return implode(", ", [$a1]);
        }, $values);
    }

    public function testStepSkipping() {
        $values = [1, 2, 3];
        CombinationApprovals::verifyAllCombinations2(function($a, $b) {
            if ($a * $b === 2) {
                throw new Exception("No twos");
            }
            if ($a === $b) {
                throw new SkipCombinationException();
            }
            return implode(", ", [$a, $b]);
        }, $values, $values);
    }

    public function testStep9() {
        $values = [1, 2, 3];
        CombinationApprovals::verifyAllCombinations9(function($a1, $a2, $a3, $a4, $a5, $a6, $a7, $a8, $a9) {
            return implode(", ", [$a1, $a2, $a3, $a4, $a5, $a6, $a7, $a8, $a9]);
        }, $values, $values, $values, $values, $values, $values, $values, $values, $values);
    }
}