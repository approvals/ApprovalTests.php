<?php namespace ApprovalTests;

use ApprovalTests\Writers\Writer;
use ApprovalTests\Writers\TextWriter;
use ApprovalTests\Reporters\Reporter;
use ApprovalTests\Reporters\PHPUnitReporter;
use ApprovalTests\Reporters\OpenReceivedFileReporter;
use ApprovalTests\Namers\PHPUnitNamer;
//use ApprovalTests\Writers\ZendPdfWriter;

class Approvals {
	private $reporter = null;
	private $testDirectory = '';

	public function __construct($testFile)
	{
		$this->testDirectory = dirname($testFile);
	}

	public function approveString($received) {
		self::approve(new TextWriter($received, 'txt'), new PHPUnitNamer(), self::getReporter('txt'));
	}

	public function getReporter($extensionWithoutDot) {
		if (is_null(self::$reporter)) {
		switch($extensionWithoutDot) {
			case 'html':
			case 'pdf':
				return new OpenReceivedFileReporter();
				break;
			default:
				return new PHPUnitReporter();
			}
		}
		return self::$reporter;
	}

	public function useReporter(Reporter $reporter) {
		self::$reporter = $reporter;
	}

	public function approve(Writer $writer, $namer, Reporter $reporter) {
		$extension = $writer->getExtensionWithoutDot();
		$approvedFilename = $namer->getApprovedFile($extension);
		$receivedFilename = $writer->write($namer->getReceivedFile($extension));
		var_dump($extension, $approvedFilename, $receivedFilename);die;
		if (!file_exists($approvedFilename)) {
			$approvedContents = null;
		} else {
			$approvedContents = file_get_contents($approvedFilename);
		}
		$receivedContents = file_get_contents($receivedFilename);
		if ($approvedContents === $receivedContents) {
			unlink($receivedFilename);
		} else {
			$hint = "\n------ To Approve, use the following command ------\n";
			$hint .= 'mv -v "' . addslashes($receivedFilename) . '" "' . addslashes($approvedFilename) . "\"\n";
			$hint .= "\n\n";
			$reporter->reportFailure($approvedFilename, $receivedFilename); 
			throw new \RuntimeException('Approval File Mismatch: ' . $receivedFilename . ' does not match ' . $approvedFilename . $hint);
		}
	}

	public function approveTransformedList(array $list, $callbackObject, $methodName) {
		$string = '';
		foreach($list as $item) {
			$string .= $item . ' -> ' . $callbackObject->$methodName($item) . "\n";
		}
		self::approveString($string);
	}

	public function approveList(array $list) {
		$string = '';
		foreach($list as $key => $item) {
			$string .= '[' . $key . '] -> ' . $item . "\n";
		}
		self::approveString($string);
	}

	public function approveHtml($html) {
		self::approve(new TextWriter($html, 'html'), new PHPUnitNamer(), self::getReporter('html'));
	}

	public function approvePdf(Zend_Pdf $pdf) {
		self::approve(new ZendPdfWriter($pdf), new PHPUnitNamer(), self::getReporter('pdf'));
	}
}