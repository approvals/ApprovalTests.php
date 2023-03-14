<?php

namespace ApprovalTests;

class FileApprover
{
    public static function checkFiles($approvedFilename, $receivedFilename)
    {
        $approvedContents = FileApprover::clean(file_get_contents($approvedFilename));
        $receivedContents = FileApprover::clean(file_get_contents($receivedFilename));

        return $approvedContents === $receivedContents;
    }

    private static function clean($contents)
    {
        return str_replace("\r\n", "\n", $contents);
    }
}
