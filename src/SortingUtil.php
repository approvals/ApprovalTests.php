<?php namespace ApprovalTests;

class SortingUtil
{
    // https://gist.github.com/cdzombak/601849
    private static function ksortRecursive(&$array, $sort_flags = SORT_REGULAR)
    {
        if (!is_array($array)) return false;
        ksort($array, $sort_flags);
        foreach ($array as &$arr) {
            self::ksortRecursive($arr, $sort_flags);
        }
        return true;
    }

    public static function orderFieldNamesAlphabetically($array)
    {
        $result = $array;
        self::ksortRecursive($result);
        return $result;
    }
}