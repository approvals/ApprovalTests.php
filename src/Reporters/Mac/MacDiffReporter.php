<?php

namespace ApprovalTests\Reporters\Mac;

use ApprovalTests\Reporters\FirstWorkingReporter;

class MacDiffReporter extends FirstWorkingReporter
{
    public function __construct()
    {
        parent::__construct(
            new BeyondCompareReporterMac(),
            new KaleidoscopeReporter(),
            new DiffMergeReporter(),
            new P4MergeReporter(),
            new TkDiffReporter(),
            new KDiff3ReporterMac());
    }
}
