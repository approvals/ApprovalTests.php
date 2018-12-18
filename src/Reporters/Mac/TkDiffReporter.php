<?php

namespace ApprovalTests\Reporters\Mac;

class TkDiffReporter extends MacDiffInfoReporter
{
    public function __construct()
    {
        parent::__construct('TK_DIFF');
    }
}