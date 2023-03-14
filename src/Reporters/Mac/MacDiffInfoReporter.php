<?php

namespace ApprovalTests\Reporters\Mac;

use ApprovalTests\Reporters\DiffPrograms;
use ApprovalTests\Reporters\GenericDiffReporter;

class MacDiffInfoReporter extends GenericDiffReporter
{
    public function __construct($diffInfoName)
    {
        $diffInfo = DiffPrograms::getInstance()->MacDiffPrograms[$diffInfoName];
        parent::__construct($diffInfo->diffProgram, $diffInfo->fileExtensions, $diffInfo->parameters);
    }
}
