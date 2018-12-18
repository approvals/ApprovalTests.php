<?php

namespace ApprovalTests\Reporters\Windows;

use ApprovalTests\Reporters\FirstWorkingReporter;

class TortoiseDiffReporter extends FirstWorkingReporter
{
    public function __construct()
    {
        parent::__construct(new TortoiseImageDiffReporter(), new TortoiseTextDiffReporter());
    }
}