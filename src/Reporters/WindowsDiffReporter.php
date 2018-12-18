<?php

namespace ApprovalTests\Reporters;


class WindowsDiffReporter extends FirstWorkingReporter
{
    public function __construct()
    {
        parent::__construct(
            new BeyondCompareReporter(),
            new TortoiseDiffReporter(), new CodeCompareReporter(), new WinMergeReporter(), new AraxisMergeReporter(), new KDiff3Reporter());
    }
}