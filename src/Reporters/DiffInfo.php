<?php

namespace ApprovalTests\Reporters;

class DiffInfo
{
    public $diffProgram;
    public $parameters;
    public $fileExtensions;

    public function __construct(string $diffProgram, array $fileExtensions, string $parameters = null)
    {
        $this->diffProgram = self::resolveWindowsPath($diffProgram);
        $this->parameters = $parameters ?? GenericDiffReporter::$STANDARD_ARGUMENTS;
        $this->fileExtensions = $fileExtensions;
    }

    private static function resolveWindowsPath(string $diffProgram): string
    {
        $tag = "{ProgramFiles}";
        $diffProgramS = new \Delight\Str\Str($diffProgram);
        if ($diffProgramS->startsWith($tag)) {
            $diffProgram = self::getPathInProgramFilesX86(substr($diffProgram, strlen($tag)));
        }
        return $diffProgram;
    }

    private static function getPathInProgramFilesX86(string $path): string
    {
        $paths = self::getProgramFilesPaths();
        return self::getFirstWorking($path, $paths, "C:\\Program Files\\");
    }

    public static function getFirstWorking(string $path, array $paths, string $ifNotFoundDefault): string
    {
        $fullPath = $ifNotFoundDefault . $path;
        foreach ($paths as $p) {
            $fullPath = $p . DIRECTORY_SEPARATOR . $path;
            if (file_exists($fullPath)) {
                break;
            }
        }
        return $fullPath;
    }

    public static function getProgramFilesPaths(): array
    {
        $paths = [
            getenv("ProgramFiles(x86)"),
            getenv("ProgramFiles"),
            getenv("ProgramW6432"),
            // Programs like Beyond Compare 4 that support per-user installation
            // will likely install themselves here.
            getenv("LocalAppData"),
        ];
        return array_unique(array_filter($paths));
    }
}