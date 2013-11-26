<?php

namespace Posnet\Printer\Adapter\Posnet;

use DateTime;
use Posnet\Printer\Adapter\AbstractAdapter;
use Posnet\Printer\Adapter\Posnet\RequestFrame;
use Posnet\Printer\Transport\TransportInterface;

/**
 * Thermal Protocol Adapter
 */
class Posnet extends AbstractAdapter
{
    /**
     * Push frame to the transport adapter and return decoded response
     * or throw exception if response returned an error
     *
     * @param RequestFrame $frame
     * @throws \RuntimeException
     * @return ResponseFrame
     */
    protected function push(RequestFrame $frame)
    {
        $raw = $this->getTransport()->send($frame->build());
        $response = ResponseFrame::decode($raw);
        if($response->hasError()){
            throw new \RuntimeException(sprintf('Response frame (%s) returned with error: %s', $response->getMnemonic(), $response->getErrorCode()));
        }
    }

    /**
     * @param TransportInterface $transport
     * @return $this
     */
    public function setTransport(TransportInterface $transport)
    {}

    public function isOnline()
    {}

    public function isReady()
    {}

    public function isBusy()
    {}

    public function isReadOnly()
    {}

    public function isInFiscalMode()
    {
        $response = $this->push(new RequestFrame('sfsx'));
    }

    public function isInTestMode()
    {}

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
    {}

    public function getVatRates(){}

    public function test()
    {}

}