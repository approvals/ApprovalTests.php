<?php

namespace ApprovalTests\Reporters;

use ApprovalTests\Reporters\Mac\MacDiffReporter;
use ApprovalTests\Reporters\Windows\WindowsDiffReporter;

class DiffReporter extends FirstWorkingReporter
{
    public function __construct()
    {
        parent::__construct(new MacDiffReporter(), new WindowsDiffReporter(), new PHPUnitReporter());
    }
}