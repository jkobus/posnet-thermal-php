<?php

namespace Posnet\Adapter;

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
}