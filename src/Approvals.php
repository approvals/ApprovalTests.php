<?php namespace ApprovalTests;

use ApprovalTests\Reporters\DiffReporter;
use ApprovalTests\Writers\Writer;
use ApprovalTests\Writers\TextWriter;
use ApprovalTests\Reporters\Reporter;
use ApprovalTests\Namers\PHPUnitNamer;
use ApprovalTests\Namers\Namer;

class Approvals
{
    public static function verifyString($received, Reporter $reporter = null)
    {
        self::verify(new TextWriter($received, 'txt'), new PHPUnitNamer(), $reporter);
    }

    public static function getReporter()
    {
        return new DiffReporter();
    }

    /**
     * Perform the approval test by comparing the contents of one file to another
     */
    public static function verify(Writer $writer, Namer $namer, Reporter $reporter = null)
    {
        if ($reporter == null) {
            $reporter = self::getReporter();
        }

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
            throw new ApprovalMismatchException($approvedFilename, $receivedFilename);
        }
    }

    public static function verifyTransformedList(array $list, $callbackObject, $methodName, $reporter = null)
    {
        $string = '';
        foreach ($list as $item) {
            $string .= $item . ' -> ' . $callbackObject->$methodName($item) . "\n";
        }
        self::verifyString($string, $reporter);
    }

    public static function verifyList(array $list, $reporter = null)
    {
        $string = '';
        foreach ($list as $key => $item) {
            $string .= '[' . $key . '] -> ' . $item . "\n";
        }
        self::verifyString($string, $reporter);
    }

    public static function verifyHtml($html, $reporter = null)
    {
        self::verify(new TextWriter($html, 'html'), new PHPUnitNamer(), $reporter);
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
