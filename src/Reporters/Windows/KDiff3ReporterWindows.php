<?php

namespace ApprovalTests\Reporters\Windows;

class KDiff3ReporterWindows extends WindowsDiffInfoReporter
{
    public function __construct() {
        parent::__construct('KDIFF3');
    }
}
