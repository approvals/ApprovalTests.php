<?php

namespace ApprovalTests\Reporters;

class CodeCompareReporter extends WindowsDiffInfoReporter
{
    public function __construct()
    {
        parent::__construct('CODE_COMPARE');
    }
}