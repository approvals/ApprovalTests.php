<?php

namespace ApprovalTests;

use Exception;

class ApprovalMismatchException extends Exception
{
    public function __construct($approvedFilename, $receivedFilename)
    {
        parent::__construct("The approved file does not match the received file\nApproved: $approvedFilename\nReceived: $receivedFilename");
    }
}