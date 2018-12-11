<?php

namespace ApprovalTests\Reporters;


class DiffReporter extends FirstWorkingReporter
{
    public function __construct()
    {
        parent::__construct(new MacDiffReporter(), new WindowsDiffReporter(), new PHPUnitReporter());
    }
}