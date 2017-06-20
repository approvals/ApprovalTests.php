<?php namespace ApprovalTests\Writers;

use ApprovalTests\FileUtil;

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

    /**
     * Write the file to disk
     */
    public function write($fileNameAndPath, $approvalsFolder)
    {
        FileUtil::createFolderIfNotExists($approvalsFolder);
        file_put_contents($fileNameAndPath, $this->received);
        return $fileNameAndPath;
    }
}
