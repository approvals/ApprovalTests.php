<?php

namespace ApprovalTests\Reporters\Windows;

use ApprovalTests\Reporters\DiffPrograms;
use ApprovalTests\Reporters\GenericDiffReporter;

class WindowsDiffInfoReporter extends GenericDiffReporter
{
    public function __construct($diffInfoName)
    {
        $diffInfo = DiffPrograms::getInstance()->WindowsDiffPrograms[$diffInfoName];
        parent::__construct($diffInfo->diffProgram, $diffInfo->fileExtensions, $diffInfo->parameters);
    }
}
