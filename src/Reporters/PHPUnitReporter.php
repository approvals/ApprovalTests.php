<?php namespace ApprovalTests\Reporters;

use PHPUnit\Framework\Assert;

class PHPUnitReporter implements Reporter
{
    public function reportFailure($approvedFilename, $receivedFilename)
    {
        if (!file_exists($approvedFilename)) {
            $approvedFileContents = null;
        } else {
            $approvedFileContents = file_get_contents($approvedFilename);
        }
        $receivedFileContents = file_get_contents($receivedFilename);
        Assert::assertEquals($approvedFileContents, $receivedFileContents);
    }
}
