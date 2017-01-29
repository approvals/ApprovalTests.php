<?php namespace ApprovalTests\Reporters;

interface Reporter {
	public function reportFailure($approvedFilename, $receivedFilename);
}