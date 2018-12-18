<?php

namespace ApprovalTests\Reporters\Windows;

class WinMergeReporter extends WindowsDiffInfoReporter
{
    public function __construct()
    {
        parent::__construct('WIN_MERGE');
    }
}