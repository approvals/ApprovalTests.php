<?php

namespace ApprovalTests\Reporters;

class BeyondCompareReporter extends GenericDiffReporter
{
    public function __construct() {
        $diffInfo = DiffPrograms::getInstance()->WindowsDiffPrograms['BEYOND_COMPARE_4'];
        parent::__construct($diffInfo->diffProgram, $diffInfo->fileExtensions, $diffInfo->parameters);
    }
}