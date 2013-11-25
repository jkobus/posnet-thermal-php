<?php

namespace Posnet\Transport;

/**
 * Enables transport of packets to a printer
 */
interface TransportInterface
{
    /**
     * Set timeout in seconds after which the transport
     * will give up on sending the data
     *
     * @param int $timeout
     * @return $this
     */
    public function setTimeout($timeout);

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