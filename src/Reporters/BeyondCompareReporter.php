<?php

namespace ApprovalTests\Reporters;

// Taken from http://php.net/manual/en/function.exec.php#86329
function execInBackground(string $cmd)
{
    if (substr(php_uname(), 0, 7) == "Windows") {
        pclose(popen("start /B \"needed title\" " . $cmd, "r"));
    } else {
        exec($cmd . " > /dev/null &");
    }
}

class BeyondCompareReporter implements Reporter
{
    private $path = "C:\Program Files\Beyond Compare 4\BCompare.exe";

    public function report($approvedFilename, $receivedFilename)
    {
        execInBackground('"' . $this->path . '" "' . $receivedFilename . '" "' . $approvedFilename . '"');
    }

    public function isWorkingInThisEnvironment($receivedFilename)
    {
        return is_executable($this->path);
    }
}