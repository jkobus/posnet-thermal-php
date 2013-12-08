<?php

namespace Posnet\Printer\Connector;

use Skajdo\Stream\NetworkStream;

/**
 * Class NetworkSocket
 *
 * @author Jacek Kobus <kobus.jacek@gmail.com>
 */
class NetworkSocket extends AbstractConnector
{
    /**
     * @var NetworkStream
     */
    protected $stream;

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
     * @param int $port
     * @param int    $timeout
     */
    function __construct($hostname, $port, $timeout = 10)
    {
        $this->hostname = $hostname;
        $this->port = $port;
    }

    /**
     * @return string
     */
    public function getHostname()
    {
        return $this->hostname;
    }

    /**
     * @return int
     */
    public function getPort()
    {
        return $this->port;
    }

    /**
     * @return NetworkStream
     */
    public function getStream()
    {
        if($this->stream === null){
            $this->stream = new NetworkStream($this->getHostname(), $this->getPort());
            $this->stream->open();
        }
        return $this->stream;
    }
}