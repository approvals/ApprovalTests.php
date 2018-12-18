<?php

namespace ApprovalTests\Reporters;

class BeyondCompare4ReporterWindows extends WindowsDiffInfoReporter
{
    public function __construct()
    {
        parent::__construct('BEYOND_COMPARE_4');
    }
}