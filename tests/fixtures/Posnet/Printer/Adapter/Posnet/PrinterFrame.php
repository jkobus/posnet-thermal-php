<?php

namespace Posnet;

use Posnet\Adapter\Posnet\PrinterFrame;
use Posnet\Printer\Adapter\Posnet;
use Posnet\Printer\Printer;
use Posnet\Printer\Transport\NetworkSocket;

class PrinterFrameTest extends \PHPUnit_Framework_TestCase
{
    public function testCreateEmptyFrame()
    {
        new PrinterFrame('test');
    }

    public function testBuildFrameWithoutArguments()
    {
        new PrinterFrame('test');
    }

    public function testBuildFrameWithArguments()
    {
        new PrinterFrame('test');
    }
}