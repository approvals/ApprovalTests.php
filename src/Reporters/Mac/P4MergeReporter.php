<?php

namespace ApprovalTests\Reporters\Mac;

class P4MergeReporter extends MacDiffInfoReporter
{
    public function __construct()
    {
        parent::__construct('P4MERGE');
    }
}