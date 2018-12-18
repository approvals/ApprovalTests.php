<?php

namespace ApprovalTests;

use ApprovalTests\Reporters\Reporter;

class SkipCombinationException extends \Exception {
}

class CombinationApprovals
{
    static $empty = ["CombinationApprovalsEmpty"];

    public static function verifyAllCombinations1($param, array $values, Reporter $reporter = null)
    {
        self::verifyAllCombinations9($param, $values, self::$empty, self::$empty, self::$empty, self::$empty, self::$empty, self::$empty, self::$empty, self::$empty, $reporter);
    }

    public static function verifyAllCombinations2($param, array $values1, array $values2, Reporter $reporter = null)
    {
        self::verifyAllCombinations9($param, $values1, $values2, self::$empty, self::$empty, self::$empty, self::$empty, self::$empty, self::$empty, self::$empty, $reporter);
    }

    public static function verifyAllCombinations3($param, array $values1, array $values2, array $values3, Reporter $reporter = null)
    {
        self::verifyAllCombinations9($param, $values1, $values2, $values3, self::$empty, self::$empty, self::$empty, self::$empty, self::$empty, self::$empty, $reporter);
    }

    public static function verifyAllCombinations4($param, array $values1, array $values2, array $values3, array $values4, Reporter $reporter = null)
    {
        self::verifyAllCombinations9($param, $values1, $values2, $values3, $values4, self::$empty, self::$empty, self::$empty, self::$empty, self::$empty, $reporter);
    }

    public static function verifyAllCombinations5($param, array $values1, array $values2, array $values3, array $values4, array $values5, Reporter $reporter = null)
    {
        self::verifyAllCombinations9($param, $values1, $values2, $values3, $values4, $values5, self::$empty, self::$empty, self::$empty, self::$empty, $reporter);
    }

    public static function verifyAllCombinations6($param, array $values1, array $values2, array $values3, array $values4, array $values5, array $values6, Reporter $reporter = null)
    {
        self::verifyAllCombinations9($param, $values1, $values2, $values3, $values4, $values5, $values6, self::$empty, self::$empty, self::$empty, $reporter);
    }

    public static function verifyAllCombinations7($param, array $values1, array $values2, array $values3, array $values4, array $values5, array $values6, array $values7, Reporter $reporter = null)
    {
        self::verifyAllCombinations9($param, $values1, $values2, $values3, $values4, $values5, $values6, $values7, self::$empty, self::$empty, $reporter);
    }

    public static function verifyAllCombinations8($param, array $values1, array $values2, array $values3, array $values4, array $values5, array $values6, array $values7, array $values8, Reporter $reporter = null)
    {
        self::verifyAllCombinations9($param, $values1, $values2, $values3, $values4, $values5, $values6, $values7, $values8, self::$empty, $reporter);
    }

    public static function verifyAllCombinations9($param, array $values1, array $values2, array $values3, array $values4, array $values5, array $values6, array $values7, array $values8, array $values9, Reporter $reporter = null)
    {
        $output = '';
        foreach ($values1 as $i1) {
            foreach ($values2 as $i2) {
                foreach ($values3 as $i3) {
                    foreach ($values4 as $i4) {
                        foreach ($values5 as $i5) {
                            foreach ($values6 as $i6) {
                                foreach ($values7 as $i7) {
                                    foreach ($values8 as $i8) {
                                        foreach ($values9 as $i9) {
                                            $thisOutput = self::displayArguments($i1, $i2, $i3, $i4, $i5, $i6, $i7, $i8, $i9);
                                            try {
                                                $thisOutput .= $param($i1, $i2, $i3, $i4, $i5, $i6, $i7, $i8, $i9);
                                            } catch (SkipCombinationException $e) {
                                                continue;
                                            } catch (\Exception $e) {
                                                $thisOutput .= get_class($e) . ' thrown: ' . $e->getMessage();
                                            }
                                            $output .= $thisOutput . "\n";
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        Approvals::verifyString($output, $reporter);
    }

    public static function displayArguments(...$args): string
    {
        return '[' . implode(', ', array_filter($args, function($i) { return $i !== self::$empty[0]; })) . "] => ";
    }
}