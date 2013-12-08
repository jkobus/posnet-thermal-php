<?php

namespace Posnet\Printer\Connector;

/**
 * Transports packets to a printer
 */
interface ConnectorInterface
{
    /**
     * Receive data from a printer
     *
     * @param int $length
     * @param string $eolChar
     * @return string
     */
    public function receive($length = 8142, $eolChar = null);

    /**
     * Send data to a printer
     *
     * @param string $data
     * @return $this
     */
    public function send($data);
}