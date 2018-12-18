<?php

namespace ApprovalTests\Reporters\Mac;

class KaleidoscopeReporter extends MacDiffInfoReporter
{
    public function __construct()
    {
        parent::__construct('KALEIDOSCOPE');
    }
}