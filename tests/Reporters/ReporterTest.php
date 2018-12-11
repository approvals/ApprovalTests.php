<?php
/**
 * Created by PhpStorm.
 * User: yehos
 * Date: 12/11/2018
 * Time: 1:36 PM
 */

namespace ApprovalTests\Tests\Reporters;

use ApprovalTests\Reporters;

class TestReporter implements Reporters\Reporter {
    public $working = true;
    public $reported = false;

    public function report($approvedFilename, $receivedFilename)
    {
        $this->reported = true;
    }

    public function isWorkingInThisEnvironment($receivedFilename)
    {
        return $this->working;
    }
}

class ReporterTest extends \PHPUnit_Framework_TestCase
{
    public function testFirstWorkingReporterFirst()
    {
        $firstTestReporter = new TestReporter();
        $secondTestReporter = new TestReporter();

        $reporter = new Reporters\FirstWorkingReporter($firstTestReporter, $secondTestReporter);
        $this->assertTrue($reporter->isWorkingInThisEnvironment("b.txt"));
        $reporter->report("a.txt", "b.txt");
        $this->assertTrue($firstTestReporter->reported);
        $this->assertFalse($secondTestReporter->reported);
    }

    public function testFirstWorkingReporterSecond()
    {
        $firstTestReporter = new TestReporter();
        $firstTestReporter->working = false;
        $secondTestReporter = new TestReporter();

        $reporter = new Reporters\FirstWorkingReporter($firstTestReporter, $secondTestReporter);
        $this->assertTrue($reporter->isWorkingInThisEnvironment("b.txt"));
        $reporter->report("a.txt", "b.txt");
        $this->assertFalse($firstTestReporter->reported);
        $this->assertTrue($secondTestReporter->reported);
    }
}
