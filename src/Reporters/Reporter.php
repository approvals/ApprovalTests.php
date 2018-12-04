<?php namespace ApprovalTests\Reporters;

interface Reporter
{
    public function report($approvedFilename, $receivedFilename);
}
