<?php namespace ApprovalTests\Reporters;

use PHPUnit\Framework\Assert;

class PHPUnitReporter implements Reporter
{
    public function report($approvedFileContents, $receivedFileContents)
    {
        try {
            Assert::assertEquals($approvedFileContents, $receivedFileContents);
            return true;
        } catch (\PHPUnit\Framework\ExpectationFailedException $e) {
            return false;
        }
    }
}
