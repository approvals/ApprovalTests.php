<?php namespace ApprovalTests\Namers;

interface Namer
{
    public function getApprovedFile($extensionWithoutDot);
    public function getReceivedFile($extensionWithoutDot);
    public function getCallingTestClassName();
    public function getCallingTestClassNameWithoutNamespace();
    public function getCallingTestMethodName();
    public function getCallingTestDirectory();
}