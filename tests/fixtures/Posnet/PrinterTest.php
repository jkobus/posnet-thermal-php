<?php

namespace Posnet;

use Posnet\Adapter\Thermal;
use Posnet\Transport\Tcp;

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
        $printer->setAdapter(new Thermal());
        $printer->setTransport(new Tcp('localhost', 200));
        $this->assertInstanceOf('Posnet\Transport\TransportInterface', $printer->getTransport());
    }

    public function testSetAdapter()
    {
        $printer = new Printer();
        $printer->setAdapter(new Thermal());
        $this->assertInstanceOf('Posnet\Adapter\AdapterInterface', $printer->getAdapter());
    }

}