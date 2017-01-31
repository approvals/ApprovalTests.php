<?php namespace ApprovalTests\Writers;

class TextWriter implements Writer
{
    private $received;
    private $extensionWithoutDot;
    
    public function __construct($received, $extensionWithoutDot)
    {
        $this->received = $received;
        $this->extensionWithoutDot = $extensionWithoutDot;
    }
    
    public function getExtensionWithoutDot()
    {
        return $this->extensionWithoutDot;
    }
    
    public function write($receivedFilename)
    {
        file_put_contents($receivedFilename, $this->received);
        return $receivedFilename;
    }
}
