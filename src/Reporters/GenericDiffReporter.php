<?php

namespace ApprovalTests\Reporters;

class GenericDiffReporter implements Reporter
{
    public static $STANDARD_ARGUMENTS = "%s %s";
    public static $TEXT_FILE_EXTENSIONS = [".txt", ".csv", ".htm", ".html", ".xml", ".eml",
        ".java", ".css", ".js", ".json"];
    public static $IMAGE_FILE_EXTENSIONS = [".png", ".gif", ".jpg", ".jpeg", ".bmp", ".tif",
        ".tiff"];

    private $diffProgram;
    private $fileExtensions;
    private $parameters;

    public function __construct(string $diffProgram, array $fileExtensions, string $parameters) {
        $this->diffProgram = $diffProgram;
        $this->fileExtensions = $fileExtensions;
        $this->parameters = $parameters;
    }

    public function report($approvedFilename, $receivedFilename)
    {
        self::execInBackground(sprintf('"%s" ' . $this->parameters, $this->diffProgram, $receivedFilename, $approvedFilename));
    }

    public function isWorkingInThisEnvironment($receivedFilename)
    {
        return is_executable($this->diffProgram);
    }

    // Taken from http://php.net/manual/en/function.exec.php#86329
    private static function execInBackground(string $cmd)
    {
        if (substr(php_uname(), 0, 7) == "Windows") {
            pclose(popen("start /B \"needed title\" " . $cmd, "r"));
        } else {
            exec($cmd . " > /dev/null &");
        }
    }
}