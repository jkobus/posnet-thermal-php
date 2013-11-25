<?php

namespace Posnet\Printer\Transport;

/**
 * Makes object transport-aware
 */
interface TransportAwareInterface
{
    /**
     * @param TransportInterface $transport
     * @return $this
     */
    public function setTransport(TransportInterface $transport);
}