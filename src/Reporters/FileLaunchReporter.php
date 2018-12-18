<?php

namespace ApprovalTests\Reporters;

use ApprovalTests\SystemUtil;

class FileLaunchReporter implements Reporter
{
    public function report($approvedFilename, $receivedFilename)
    {
        SystemUtil::viewFile($receivedFilename);
    }

    public function isWorkingInThisEnvironment($receivedFilename)
    {
        return true;
    }
}