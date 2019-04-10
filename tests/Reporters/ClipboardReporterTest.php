<?php

namespace ApprovalTests\Tests\Reporters;

use ApprovalTests\Reporters\ClipboardReporter;

class ClipboardReporterTest extends \PHPUnit\Framework\TestCase
{
    public function testClipboardReporter() {
        $this->assertEquals("move /Y \"received.txt\" \"approved.txt\"", ClipboardReporter::getCommandLineFor("approved.txt", "received.txt", true));
        $this->assertEquals("mv \"received.txt\" \"approved.txt\"", ClipboardReporter::getCommandLineFor("approved.txt", "received.txt", false));
    }
}