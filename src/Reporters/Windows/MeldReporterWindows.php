<?php

namespace ApprovalTests\Reporters\Windows;

class MeldReporterWindows extends WindowsDiffInfoReporter
{
    public function __construct() {
        parent::__construct('MELD');
    }
}
