<?php namespace ApprovalTests;

use ApprovalTests\Reporters\DiffReporter;
use ApprovalTests\Writers\Writer;
use ApprovalTests\Writers\TextWriter;
use ApprovalTests\Reporters\Reporter;
use ApprovalTests\Namers\PHPUnitNamer;
use ApprovalTests\Namers\Namer;
use PHPUnit\Framework\Assert;

class Approvals
{
    public static function verifyString($received, Reporter $reporter = null)
    {
        self::verifyStringWithFileExtension($received, 'txt', $reporter);
    }

    public static function verifyStringWithFileExtension($received, $extensionWithoutDot, Reporter $reporter = null)
    {
        self::verify(new TextWriter($received, $extensionWithoutDot), new PHPUnitNamer(), $reporter);
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
        self::satisfyPHPUnitRequirementForAssert();
        if ($reporter == null) {
            $reporter = self::getReporter();
        }

        $extension = $writer->getExtensionWithoutDot();
        $approvedFilename = $namer->getApprovedFile($extension);
        if (!file_exists($approvedFilename)) {
          $writer->writeEmpty(
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
        self::verifyStringWithFileExtension($html, 'html', $reporter);
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

    /**
     * @param mixed $data
     * @param Reporter $reporter
     * @throws ApprovalMismatchException
     */
    public static function verifyAsJson($data, $reporter = null)
    {
        $json = json_encode(SortingUtil::orderFieldNamesAlphabetically($data), JSON_PRETTY_PRINT);
        self::verifyStringWithFileExtension($json, 'json', $reporter);
    }

    private static function satisfyPHPUnitRequirementForAssert()
    {
        Assert::assertTrue(true);
    }
}
