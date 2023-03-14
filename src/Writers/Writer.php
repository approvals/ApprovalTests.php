<?php namespace ApprovalTests\Writers;

use ApprovalTests\Namers\Namer;

interface Writer
{
    public function getExtensionWithoutDot();

    public function write($fileNameAndPath, $approvalsFolder);
    public function writeEmpty($fileNameAndPath, $approvalsFolder);

    public function delete($fileNameAndPath);
}
