<?php

namespace ApprovalTests;


use PHPUnit\Framework\Assert;

class FileApprover
{

    public static function checkFiles($approvedFilename, $receivedFilename): bool
    {
        $approvedContents = file_get_contents($approvedFilename);
        $receivedContents = file_get_contents($receivedFilename);

        try {
            Assert::assertEquals($approvedContents, $receivedContents);
            $matching = true;
        } catch (\PHPUnit\Framework\ExpectationFailedException $e) {
            $matching = false;
        }
        return $matching;
    }
}