<?php

namespace Posnet\Printer\Adapter;

use Posnet\Printer\Transport\TransportInterface;

/**
 * Abstract adapter
 */
abstract class AbstractAdapter implements AdapterInterface
{
    /**
     * @var TransportInterface
     */
    protected $transport;

    /**
     * @param TransportInterface $transport
     * @return $this
     */
    public function setTransport(TransportInterface $transport)
    {
        $this->transport = $transport;
        return $this;
    }

    /**
     * @return TransportInterface
     */
    public function getTransport()
    {
        return $this->transport;
    }

}