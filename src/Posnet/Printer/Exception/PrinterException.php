<?php

namespace Posnet\Printer;

use Exception;

/**
 * Class PrinterException
 *
 * @author Jacek Kobus <kobus.jacek@gmail.com>
 */
class PrinterException extends Exception implements PrinterExceptionInterface
{
    /**
     * @var PrinterInterface
     */
    protected $printer;

    /**
     * @param \Posnet\Printer\PrinterInterface $printer
     */
    public function setPrinter($printer)
    {
        $this->printer = $printer;
    }

    /**
     * @return \Posnet\Printer\PrinterInterface
     */
    public function getPrinter()
    {
        return $this->printer;
    }
}