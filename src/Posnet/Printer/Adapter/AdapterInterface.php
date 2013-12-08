<?php

namespace Posnet\Printer\Adapter;

use DateTime;
use Posnet\Printer\Connector\ConnectorAwareInterface;

/**
 * Interface AdapterInterface
 *
 * @author Jacek Kobus <kobus.jacek@gmail.com>
 */
interface AdapterInterface extends ConnectorAwareInterface
{
    /**
     * @param \DateTime $date
     * @return $this
     */
    public function printDailyReport(DateTime $date);
}