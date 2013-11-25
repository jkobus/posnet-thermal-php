<?php

namespace Posnet\Adapter;

use Posnet\Transport\TransportInterface;

/**
 * Posnet Protocol Adapter
 */
class Posnet implements AdapterInterface
{

    public function isOnline()
    {
        // TODO: Implement isOnline() method.
    }

    public function isReady()
    {
        // TODO: Implement isReady() method.
    }

    public function isBusy()
    {
        // TODO: Implement isBusy() method.
    }

    public function isInFiscalMode()
    {
        // TODO: Implement isInFiscalMode() method.
    }

    public function isInTestMode()
    {
        // TODO: Implement isInTestMode() method.
    }

    /**
     * @param TransportInterface $transport
     * @return $this
     */
    public function setTransport(TransportInterface $transport)
    {
        // TODO: Implement setTransport() method.
    }
}