<?php

namespace Posnet\Printer;

/**
 * Interface PrinterExceptionInterface
 *
 * @author Jacek Kobus <kobus.jacek@gmail.com>
 */
interface PrinterExceptionInterface
{
    /**
     * @return PrinterInterface
     */
    public function getPrinter();
}