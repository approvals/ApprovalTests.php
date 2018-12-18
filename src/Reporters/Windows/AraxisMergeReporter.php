<?php

namespace ApprovalTests\Reporters\Windows;

class AraxisMergeReporter extends WindowsDiffInfoReporter
{
    public function __construct()
    {
        parent::__construct('ARAXIS_MERGE');
    }
}