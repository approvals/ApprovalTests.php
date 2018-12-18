<?php

namespace ApprovalTests\Reporters\Mac;

class DiffMergeReporter extends MacDiffInfoReporter
{
    public function __construct()
    {
        parent::__construct('DIFF_MERGE');
    }
}