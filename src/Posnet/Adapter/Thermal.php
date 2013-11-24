<?php

namespace Posnet\Adapter;

use DateTime;
use Posnet\Transport\TransportInterface;

/**
 * Thermal Protocol Adapter v 2.x ?
 */
class Thermal implements AdapterInterface
{
    /**
     * @param TransportInterface $transport
     * @return $this
     */
    public function setTransport(TransportInterface $transport)
    {

    }

    public function isOnline()
    {}

    public function isReady()
    {}

    public function isBusy()
    {}

    public function isReadOnly()
    {}

    public function isInFiscalMode()
    {}

    public function isInTestMode()
    {
        // TODO: Implement isInTestMode() method.
    }

    /**
     * In fiscal mode the scope of clock regulation is limited to 1 hour, time can be changed once a day.
     * Availability in read only mode: NO
     *
     * @param \DateTime $date
     * @return $this
     */
    public function setDateTime(DateTime $date){}

    /**
     * @return \DateTime
     */
    public function getDateTime(){}

    /**
     * Set VAT rates
     * Lack of parameter means an inactive rate. The correct percent value is between (0 – 99.99)
     * Date is verified with current settings of system clock. In case of lack of parameter, the user has to confirm the date using the keyboard.
     *
     * VAT value 100 - tax exempted rate.
     * VAT value 101 – inactive rate.
     * There is no possibility to program all rates as inactive rates.
     * Availability in read only mode: NO
     *
     * @param float $a
     * @param float $b
     * @param float $c
     * @param float $d
     * @param float $e
     * @param float $f
     * @param DateTime $date
     */
    public function setVatRates($a = null, $b = null, $c = null, $d = null, $e = null, $f = null, DateTime $date = null)
    {
    }

    public function getVatRates(){}

    public function test()
    {
    }

}