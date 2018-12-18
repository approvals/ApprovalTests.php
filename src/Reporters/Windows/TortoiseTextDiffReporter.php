<?php

namespace ApprovalTests\Reporters\Windows;

class TortoiseTextDiffReporter extends WindowsDiffInfoReporter
{
    public function __construct()
    {
        parent::__construct('TORTOISE_TEXT_DIFF');
    }
}