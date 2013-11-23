<?php

namespace Posnet\Transport;

/**
 * Enables transport of packets to a remote printer
 */
class Tcp implements TransportInterface
{
    /**
     * @var string
     */
    protected $hostname;

    /**
     * @var int
     */
    protected $port;

    /**
     * @param string $hostname
     * @param string $port
     */
    function __construct($hostname, $port)
    {
        $this->hostname = $hostname;
        $this->port = $port;
    }

    /**
     * {@inheritdoc}
     */
    public function send($data)
    {

    }

    /**
     * {@inheritdoc}
     */
    public function receive()
    {

    }
}