<?php

namespace ApprovalTests\Reporters;

class DiffPrograms
{
    private static $instance = null;

    public static function getInstance(): DiffPrograms {
        if (!self::$instance) {
            self::$instance = new DiffPrograms();
        }
        return self::$instance;
    }

    /**
     * @var DiffInfo[]
     */
    public $MacDiffPrograms;

    /**
     * @var DiffInfo[]
     */
    public $WindowsDiffPrograms;

    public static function Text()
    {
        return GenericDiffReporter::$TEXT_FILE_EXTENSIONS;
    }

    public static function Image()
    {
        return GenericDiffReporter::$IMAGE_FILE_EXTENSIONS;
    }

    public static function TextAndImage()
    {
        return array_merge(self::Text(), self::Image());
    }

    private function __construct()
    {
        $this->MacDiffPrograms = [
            'DIFF_MERGE' => new DiffInfo(
                "/Applications/DiffMerge.app/Contents/MacOS/DiffMerge", DiffPrograms::Text(), "%s %s -nosplash"),
            'BEYOND_COMPARE' => new DiffInfo(
                "/Applications/Beyond Compare.app/Contents/MacOS/bcomp", DiffPrograms::Text()),
            'KALEIDOSCOPE' => new DiffInfo(
                "/Applications/Kaleidoscope.app/Contents/MacOS/ksdiff", DiffPrograms::TextAndImage()),
            'KDIFF3' => new DiffInfo("/Applications/kdiff3.app/Contents/MacOS/kdiff3",
                DiffPrograms::Text(), "%s %s -m"),
            'P4MERGE' => new DiffInfo("/Applications/p4merge.app/Contents/MacOS/p4merge",
                DiffPrograms::TextAndImage()),
            'TK_DIFF' => new DiffInfo("/Applications/TkDiff.app/Contents/MacOS/tkdiff",
                DiffPrograms::Text()),
            'VISUAL_STUDIO_CODE' => new DiffInfo(
                "/Applications/Visual Studio Code.app/Contents/Resources/app/bin/code", DiffPrograms::Text(), "-d %s %s"),
        ];

        $this->WindowsDiffPrograms = [
            'BEYOND_COMPARE_3' => new DiffInfo("{ProgramFiles}Beyond Compare 3\\BCompare.exe",
                DiffPrograms::TextAndImage()),
            'BEYOND_COMPARE_4' => new DiffInfo("{ProgramFiles}Beyond Compare 4\\BCompare.exe",
                DiffPrograms::TextAndImage()),
            'TORTOISE_IMAGE_DIFF' => new DiffInfo("{ProgramFiles}TortoiseSVN\\bin\\TortoiseIDiff.exe",
                DiffPrograms::Image(), "/left:%s /right:%s"),
            'TORTOISE_TEXT_DIFF' => new DiffInfo("{ProgramFiles}TortoiseSVN\\bin\\TortoiseMerge.exe",
                DiffPrograms::Text()),
            'WIN_MERGE' => new DiffInfo("{ProgramFiles}WinMerge\\WinMergeU.exe", DiffPrograms::Text()),
            'ARAXIS_MERGE' => new DiffInfo("{ProgramFiles}Araxis\\Araxis Merge\\Compare.exe",
                DiffPrograms::Text()),
            'CODE_COMPARE' => new DiffInfo(
                "{ProgramFiles}Devart\\Code Compare\\CodeCompare.exe", DiffPrograms::Text()),
            'KDIFF3' => new DiffInfo("{ProgramFiles}KDiff3\\kdiff3.exe", DiffPrograms::Text()),
            'VISUAL_STUDIO_CODE' => new DiffInfo("{ProgramFiles}Microsoft VS Code\\Code.exe",
                DiffPrograms::Text(), "-d %s %s"),
            'MELD' => new DiffInfo("{ProgramFiles}Meld\\Meld.exe", DiffPrograms::Text()),
        ];
    }
}
