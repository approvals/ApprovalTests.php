<?php namespace ApprovalTests\Writers;

interface Writer
{
    public function getExtensionWithoutDot();
    
    public function write($receivedFilename);
}
