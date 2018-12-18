<?php

namespace ApprovalTests\Reporters;

class TortoiseImageDiffReporter extends WindowsDiffInfoReporter
{
    public function __construct()
    {
        parent::__construct('TORTOISE_IMAGE_DIFF');
    }
}