<?php namespace ApprovalTests\Reporters;

use PHPUnit\Framework\Assert;

class PHPUnitReporter implements Reporter
{
    public function report($approvedFileContents, $receivedFileContents)
    {
        Assert::assertEquals($approvedFileContents, $receivedFileContents);
    }
}