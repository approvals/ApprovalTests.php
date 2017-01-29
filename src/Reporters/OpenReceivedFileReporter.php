<?php
require_once 'Reporter.php';

class OpenReceivedFileReporter implements Reporter {
	public function reportFailure($approvedFilename, $receivedFilename) {
		system(escapeshellcmd('open') . ' ' . escapeshellarg($receivedFilename));
	}
}
?>