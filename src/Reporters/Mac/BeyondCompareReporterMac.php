<?php

namespace ApprovalTests\Reporters\Mac;

class BeyondCompareReporterMac extends MacDiffInfoReporter
{
    public function __construct()
    {
        parent::__construct('BEYOND_COMPARE');
    }
}