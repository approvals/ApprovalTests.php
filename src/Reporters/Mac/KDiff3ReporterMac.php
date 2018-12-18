<?php

namespace ApprovalTests\Reporters\Mac;

class KDiff3ReporterMac extends MacDiffInfoReporter
{
    public function __construct()
    {
        parent::__construct('KDIFF3');
    }
}