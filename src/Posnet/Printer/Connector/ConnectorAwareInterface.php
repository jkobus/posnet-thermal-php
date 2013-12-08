<?php

namespace Posnet\Printer\Connector;

/**
 * Makes object transport-aware
 */
interface ConnectorAwareInterface
{
    /**
     * @param ConnectorInterface $transport
     * @return $this
     */
    public function setConnector(ConnectorInterface $transport);
}