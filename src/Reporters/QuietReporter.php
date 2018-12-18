<?php

namespace ApprovalTests\Reporters;

class QuietReporter implements Reporter
{
    public function report($approvedFilename, $receivedFilename)
    {
    }

    public function isWorkingInThisEnvironment($receivedFilename)
    {
        return true;
    }
}