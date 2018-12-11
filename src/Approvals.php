<?php namespace ApprovalTests;

use ApprovalTests\Writers\Writer;
use ApprovalTests\Writers\TextWriter;
use ApprovalTests\Reporters\Reporter;
use ApprovalTests\Reporters\PHPUnitReporter;
use ApprovalTests\Reporters\OpenReceivedFileReporter;
use ApprovalTests\Namers\PHPUnitNamer;
use ApprovalTests\Namers\Namer;

class Approvals
{
    private static $reporter = null;
    private static $testDirectory = '';

    public static function verifyString($received)
    {
        self::verify(new TextWriter($received, 'txt'), new PHPUnitNamer(), self::getReporter('txt'));
    }

    public static function getReporter($extensionWithoutDot)
    {
        if (is_null(self::$reporter)) {
            switch ($extensionWithoutDot) {
            case 'html':
            case 'pdf':
            default:
                return new PHPUnitReporter();
            }
        }
        return self::$reporter;
    }

    public static function useReporter(Reporter $reporter)
    {
        self::$reporter = $reporter;
    }

    /**
     * Perform the approval test by comparing the contents of one file to another
     */
    public static function verify(Writer $writer, Namer $namer, Reporter $reporter)
    {
        $extension = $writer->getExtensionWithoutDot();
        $approvedFilename = $namer->getApprovedFile($extension);
        if (!file_exists($approvedFilename)) {
          $writer->write(
            $namer->getApprovedFile($extension),
            $namer->getApprovalsDirectory());
        }

        $receivedFilename = $writer->write(
          $namer->getReceivedFile($extension),
          $namer->getApprovalsDirectory());

        $matching = FileApprover::checkFiles($approvedFilename, $receivedFilename);

        if ($matching) {
            $writer->delete($receivedFilename);
        }
        else {
            $reporter->report($approvedFilename, $receivedFilename);
        }
    }

    public static function verifyTransformedList(array $list, $callbackObject, $methodName)
    {
        $string = '';
        foreach ($list as $item) {
            $string .= $item . ' -> ' . $callbackObject->$methodName($item) . "\n";
        }
        self::verifyString($string);
    }

    public static function verifyList(array $list)
    {
        $string = '';
        foreach ($list as $key => $item) {
            $string .= '[' . $key . '] -> ' . $item . "\n";
        }
        self::verifyString($string);
    }

    public static function verifyHtml($html)
    {
        self::verify(new TextWriter($html, 'html'), new PHPUnitNamer(), self::getReporter('html'));
    }

    /**
     * @param $received
     * @deprecated Use verifyString instead.
     */
    public static function approveString($received)
    {
        self::verifyString($received);
    }

    /**
     * @param array $list
     * @deprecated Use verifyList instead.
     */
    public static function approveList(array $list)
    {
        self::verifyList($list);
    }

    /**
     * @param $html
     * @deprecated Use verifyHtml instead.
     */
    public static function approveHtml($html)
    {
        self::verifyHtml($html);
    }
}
