<?php

namespace Posnet;


use Posnet\Printer\Adapter\Posnet\Posnet;
use Posnet\Printer\Printer;
use Posnet\Printer\Transport\NetworkSocket;

class PrinterTest extends \PHPUnit_Framework_TestCase
{
    public function testCreateEmptyPrinterInstance()
    {
        $printer = new Printer();
        $this->assertNull($printer->getTransport());
        $this->assertNull($printer->getAdapter());
    }

    public function testSetTransport()
    {
        $printer = new Printer();
        $printer->setAdapter(new Posnet());
        $printer->setTransport(new NetworkSocket('localhost', 200));
        $this->assertInstanceOf('Posnet\Printer\Transport\TransportInterface', $printer->getTransport());
    }

    public function testSetAdapter()
    {
        $printer = new Printer();
        $printer->setAdapter(new Posnet());
        $this->assertInstanceOf('Posnet\Printer\Adapter\AdapterInterface', $printer->getAdapter());
    }

}