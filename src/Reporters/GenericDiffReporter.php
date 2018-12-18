<?php

namespace ApprovalTests\Reporters;

use ApprovalTests\SystemUtil;

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
        SystemUtil::execInBackground(sprintf('"%s" ' . $this->parameters, $this->diffProgram, $receivedFilename, $approvedFilename));
    }

    public function isWorkingInThisEnvironment($receivedFilename)
    {
        return is_executable($this->diffProgram);
    }
}