<?php namespace ApprovalTests\Writers;

use ApprovalTests\Namers\Namer;

interface Writer
{
    public function getExtensionWithoutDot();
    
    public function write($fileNameAndPath, $approvalsFolder);
}
