<?php

namespace ApprovalTests\Reporters;

class WindowsDiffInfoReporter extends GenericDiffReporter
{
    public function __construct(string $diffInfoName)
    {
        $diffInfo = DiffPrograms::getInstance()->WindowsDiffPrograms[$diffInfoName];
        parent::__construct($diffInfo->diffProgram, $diffInfo->fileExtensions, $diffInfo->parameters);
    }
}