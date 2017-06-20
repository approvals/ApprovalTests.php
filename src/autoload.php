<?php

$vendor_autoload = dirname(__FILE__) . "/../vendor/autoload.php";
require_once($vendor_autoload);

function exception_error_handler($errno, $errstr, $errfile, $errline ) {
    throw new \ErrorException($errstr, 0, $errno, $errfile, $errline);
}
set_error_handler(__NAMESPACE__ .'\exception_error_handler');
