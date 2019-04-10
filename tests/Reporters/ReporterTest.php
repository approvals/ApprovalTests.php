<?php

namespace ApprovalTests\Tests\Reporters;

use ApprovalTests\Reporters;
use ApprovalTests\Reporters\CombinationReporter;
use Exception;

class TestReporter implements Reporters\Reporter {
    public $working = true;
    public $reported = false;
    public $throwError = false;

    public function report($approvedFilename, $receivedFilename)
    {
        $this->reported = true;
        if ($this->throwError) {
            throw new Exception("Failed report");
        }
    }

    public function isWorkingInThisEnvironment($receivedFilename)
    {
        return $this->working;
    }
}

class ReporterTest extends \PHPUnit\Framework\TestCase
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

    public function testCombinationReporters()
    {
        $firstTestReporter = new TestReporter();
        $secondTestReporter = new TestReporter();
        $combinationReporter = new CombinationReporter($firstTestReporter, $secondTestReporter);
        $this->assertTrue($combinationReporter->isWorkingInThisEnvironment("b.txt"));
        $combinationReporter->report("a.txt", "b.txt");
        $this->assertTrue($firstTestReporter->reported);
        $this->assertTrue($secondTestReporter->reported);
    }

    public function testCombinationReportersWithError()
    {
        $firstTestReporter = new TestReporter();
        $firstTestReporter->throwError = true;
        $secondTestReporter = new TestReporter();
        $combinationReporter = new CombinationReporter($firstTestReporter, $secondTestReporter);
        $this->assertTrue($combinationReporter->isWorkingInThisEnvironment("b.txt"));

        $exception = null;
        try {
            $combinationReporter->report("a.txt", "b.txt");
        } catch (Exception $e) {
            $exception =& $e;
        }

        $this->assertTrue($firstTestReporter->reported);
        $this->assertTrue($secondTestReporter->reported);
        $this->assertNotNull($exception);
    }
}
