<?php

namespace Posnet\Transport;

/**
 * Enables transport of packets to a remote printer
 */
interface TransportInterface
{
    /**
     * Receive data from a printer
     *
     * @return string
     */
    public function receive();

    /**
     * Send data to a printer
     *
     * @param string $data
     * @return $this
     */
    public function send($data);
}