<?php namespace ApprovalTests\Writers;

require_once 'Writer.php';
require_once 'Zend/Pdf.php';
require_once 'Zend/Pdf/Element/String.php';
require_once 'Zend/Pdf/Element/String/Binary.php';

class ZendPdfWriter implements Writer {

    /**
     *
     * @var Zend_Pdf
     */
    private $received;

    public function __construct(Zend_Pdf $received) {
        $this->received = $received;
    }

    public function getExtensionWithoutDot() {
        return 'pdf';
    }

    public function write($receivedFilename) {
        $this->mockPdfTimestamps();
        $this->received->save($receivedFilename);
        return $receivedFilename;
    }

    public function mockPdfTimestamps() {
        foreach ($this->received->pages as &$page) {
            $dict = $page->getPageDictionary();
            $dict->LastModified = new Zend_Pdf_Element_String(Zend_Pdf::pdfDate(0));
        }
        $reflect = new ReflectionClass($this->received);
        $property = $reflect->getProperty("_trailer");
        $property->setAccessible(true);
        $trailer = $property->getValue($this->received);

        $trailer->ID->items[0] = new Zend_Pdf_Element_String_Binary(0);
        $trailer->ID->items[1] = new Zend_Pdf_Element_String_Binary(0);
    }

}