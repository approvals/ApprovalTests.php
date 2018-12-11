<?php namespace ApprovalTests\Reporters;

use PHPUnit\Framework\Assert;

class PHPUnitReporter implements Reporter
{
    public function report($approvedFilename, $receivedFilename)
    {
        $approvedContents = file_get_contents($approvedFilename);
        $receivedContents = file_get_contents($receivedFilename);
        Assert::assertEquals($approvedContents, $receivedContents);
    }

    public function isWorkingInThisEnvironment($receivedFilename)
    {
        return true;
    }
}
