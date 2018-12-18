<?php

namespace ApprovalTests\Reporters;

class TortoiseDiffReporter extends FirstWorkingReporter
{
    public function __construct()
    {
        parent::__construct(new TortoiseImageDiffReporter(), new TortoiseTextDiffReporter());
    }
}