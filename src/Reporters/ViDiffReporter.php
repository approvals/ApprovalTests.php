<?php namespace ApprovalTests\Reporters;

use ApprovalTests\FileUtil;

class ViDiffReporter implements Reporter {
	public function reportFailure($approvedFilename, $receivedFilename) {
		FileUtil::createFileIfNotExists($approvedFilename);
		system("echo '#!/bin/sh' > /tmp/reporter.command; echo 'vimdiff " . escapeshellarg($approvedFilename) . " " . escapeshellarg($receivedFilename) . "' > /tmp/reporter.command; chmod +x /tmp/reporter.command; open /tmp/reporter.command");
	}
}