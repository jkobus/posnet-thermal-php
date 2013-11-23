<?php

namespace Posnet;

use Posnet\Adapter\AdapterInterface;
use Posnet\Transport\TransportInterface;

/**
 * Represent the printer
 */
class Printer
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
        return $this->adapter;
    }

    /**
     * @param \Posnet\Transport\TransportInterface $transport
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
     * @param PrintableInterface $entity
     */
    public function doPrint(PrintableInterface $entity)
    {

    }
}