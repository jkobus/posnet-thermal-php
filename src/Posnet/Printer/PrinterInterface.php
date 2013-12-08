<?php

namespace Posnet\Printer;

use Posnet\Printer\Adapter\AdapterInterface;
use Posnet\Printer\Connector\ConnectorInterface;
use Posnet\Printer\Connector\ConnectorAwareInterface;


/**
 * Interface PrinterInterface
 *
 * @author Jacek Kobus <kobus.jacek@gmail.com>
 */
interface PrinterInterface extends ConnectorAwareInterface
{
    /**
     * @param AdapterInterface $adapter
     * @return $this
     */
    public function setAdapter(AdapterInterface $adapter);

    /**
     * Tell if printer is online
     *
     * @return bool
     */
    public function isOnline();

    /**
     * Tell if printer is busy and cannot print at the time
     *
     * @return bool
     */
    public function isBusy();

    /**
     * Print
     *
     * @param PrintableInterface $printable
     * @return bool
     */
    public function doPrint(PrintableInterface $printable);
}