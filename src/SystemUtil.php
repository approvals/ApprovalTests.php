<?php

namespace ApprovalTests;

class SystemUtil
{
    public static function isWindows(): bool
    {
        // Based on http://php.net/manual/en/function.php-uname.php
        return strtoupper(substr(PHP_OS, 0, 3)) === 'WIN';
    }

    public static function execInBackground(string $cmd)
    {
        // Taken from http://php.net/manual/en/function.exec.php#86329
        if (self::isWindows()) {
            pclose(popen("start /B \"needed title\" " . $cmd, "r"));
        } else {
            exec($cmd . " > /dev/null &");
        }
    }

    public static function viewFile(string $filename)
    {
        if (self::isWindows()) {
            pclose(popen("start /B \"needed title\" \"" . $filename . "\"", "r"));
        } else {
            exec("open \"" . $filename . "\" > /dev/null &");
        }
    }
}
