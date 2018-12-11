<?php

namespace ApprovalTests\Reporters;


class WindowsDiffReporter extends FirstWorkingReporter
{
    public function __construct()
    {
        parent::__construct(new BeyondCompareReporter());
    }
}