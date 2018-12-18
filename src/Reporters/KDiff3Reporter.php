<?php

namespace ApprovalTests\Reporters;

class KDiff3Reporter extends WindowsDiffInfoReporter
{
    public function __construct() {
        parent::__construct('KDIFF3');
    }
}
