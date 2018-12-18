<?php

namespace ApprovalTests\Reporters\Windows;

class CodeCompareReporter extends WindowsDiffInfoReporter
{
    public function __construct()
    {
        parent::__construct('CODE_COMPARE');
    }
}