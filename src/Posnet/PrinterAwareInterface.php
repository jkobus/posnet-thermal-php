<?php

namespace Posnet;

/**
 * Represents printer-aware entity
 */
interface PrinterAwareInterface
{
    /**
     * @param Printer $printer
     * @return $this
     */
    public function setPrinter(Printer $printer);
}