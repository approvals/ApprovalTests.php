<?php namespace ApprovalTests\Writers;

use ApprovalTests\Namers\Namer;

interface Writer
{
    public function getExtensionWithoutDot();

    public function write(string $fileNameAndPath, string $approvalsFolder);
    public function writeEmpty(string $fileNameAndPath, string $approvalsFolder);

    public function delete(string $fileNameAndPath);
}
