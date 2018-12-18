<?php

namespace ApprovalTests\Reporters\Windows;

class BeyondCompare3ReporterWindows extends WindowsDiffInfoReporter
{
    public function __construct()
    {
        parent::__construct('BEYOND_COMPARE_3');
    }
}