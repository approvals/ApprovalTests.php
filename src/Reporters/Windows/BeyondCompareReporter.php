<?php

namespace ApprovalTests\Reporters\Windows;

use ApprovalTests\Reporters\FirstWorkingReporter;

class BeyondCompareReporter extends FirstWorkingReporter
{
    public function __construct()
    {
        parent::__construct(new BeyondCompare4ReporterWindows(), new BeyondCompare3ReporterWindows());
    }
}