<?php

namespace ApprovalTests\Reporters;

use Exception;

class CombinationReporter
{
    /**
     * @var Reporter[]
     */
    private $reporters;

    /**
     * @param Reporter[] $reporters
     */
    public function __construct(...$reporters)
    {
        $this->reporters = $reporters;
    }

    public function report($approvedFilename, $receivedFilename)
    {
        $exception = null;
        foreach ($this->reporters as $reporter) {
            if ($reporter->isWorkingInThisEnvironment($receivedFilename)) {
                try {
                    $reporter->report($approvedFilename, $receivedFilename);
                } catch (Exception $e) {
                    $exception = $e;
                }
            }
        }
        if ($exception) {
            throw $exception;
        }
    }

    public function isWorkingInThisEnvironment($receivedFilename)
    {
        foreach ($this->reporters as $reporter) {
            if ($reporter->isWorkingInThisEnvironment($receivedFilename)) {
                return true;
            }
        }
        return false;
    }
}