<?php

namespace ApprovalTests;

class FileApprover
{
    public static function checkFiles(string $approvedFilename, string $receivedFilename): bool
    {
        $approvedContents = FileApprover::clean(file_get_contents($approvedFilename));
        $receivedContents = FileApprover::clean(file_get_contents($receivedFilename));

        return $approvedContents === $receivedContents;
    }

    private static function clean(string $contents): string
    {
        return str_replace("\r\n", "\n", $contents);
    }
}