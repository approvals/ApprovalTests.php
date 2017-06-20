<?php namespace ApprovalTests;

class FileUtil
{
    public static function createFileIfNotExists($filename)
    {
        if (!file_exists($filename)) {
            return touch($filename);
        }
    }

    public static function createFolderIfNotExists($approvalsFolder)
    {
        if (!is_dir($approvalsFolder)) {
            return mkdir($approvalsFolder);
        }
    }
}
