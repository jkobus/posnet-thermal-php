<?php

namespace Posnet;

use Posnet\Adapter\AdapterInterface;
use Posnet\Transport\TransportAwareInterface;
use Posnet\Transport\TransportInterface;

/**
 * Represent the printer
 */
class Printer implements TransportAwareInterface
{
    /**
     * @var AdapterInterface
     */
    protected $adapter;

    /**
     * @var TransportInterface
     */
    protected $transport;

    /**
     * @param \Posnet\Adapter\AdapterInterface $adapter
     */
    public function setAdapter(AdapterInterface $adapter)
    {
        $this->adapter = $adapter;
    }

    /**
     * @return \Posnet\Adapter\AdapterInterface
     */
    public function getAdapter()
    {
        if($this->adapter !== null && $this->getTransport() !== null){
            $this->adapter->setTransport($this->getTransport());
        }
        return $this->adapter;
    }

    /**
     * {@inheritdoc}
     */
    public function setTransport(TransportInterface $transport)
    {
        $this->transport = $transport;
    }

    /**
     * @return \Posnet\Transport\TransportInterface
     */
    public function getTransport()
    {
        return $this->transport;
    }

    /**
     * Tell if printer is online
     *
     * @return bool
     */
    public function isOnline()
    {
        return $this->getAdapter()->isOnline();
    }

    /**
     * Tell if printer is ready to work
     *
     * @return bool
     */
    public function isReady()
    {
        return $this->getAdapter()->isReady();
    }

    /**
     * Tell if printer is busy doing transaction
     *
     * @return bool
     */
    public function isBusy()
    {
        return $this->getAdapter()->isBusy();
    }

    /**
     * Printer is processing REAL transactions
     *
     * @return bool
     */
    public function isInFiscalMode()
    {
        return $this->getAdapter()->isInFiscalMode();
    }

    /**
     * Printer is in test mode
     *
     * @return bool
     */
    public function isInTestMode()
    {
        return $this->getAdapter()->isInTestMode();
    }

    /**
     * Transform and send given entity to the printer
     *
     * @param PrintableInterface $printable
     * @return void
     */
    public function doPrint(PrintableInterface $printable)
    {
        $printable->doPrint($this->getAdapter());
    }
}