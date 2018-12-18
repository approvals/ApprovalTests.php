<?php

namespace ApprovalTests\Reporters\Windows;

class TortoiseDiffReporter extends FirstWorkingReporter
{
    public function __construct()
    {
        parent::__construct(new TortoiseImageDiffReporter(), new TortoiseTextDiffReporter());
    }
}