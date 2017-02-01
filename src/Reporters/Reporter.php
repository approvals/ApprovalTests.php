<?php namespace ApprovalTests\Reporters;

interface Reporter
{
    public function report($approvedFileContents, $receivedFileContents);
}
