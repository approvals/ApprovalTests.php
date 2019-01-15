<?php

namespace ApprovalTests\Reporters\Windows;

use ApprovalTests\Reporters\FirstWorkingReporter;

class WindowsDiffReporter extends FirstWorkingReporter
{
    public function __construct()
    {
        parent::__construct(
            new BeyondCompareReporter(),
            new TortoiseDiffReporter(),
            new CodeCompareReporter(),
            new WinMergeReporter(),
            new AraxisMergeReporter(),
            new MeldReporterWindows(),
            new KDiff3ReporterWindows());
    }
}
