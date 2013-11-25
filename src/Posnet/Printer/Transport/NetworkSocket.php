<?php

namespace Posnet\Printer\Transport;

use Skajdo\Stream\NetworkStream;

/**
 * Transport packets using network stream
 */
class NetworkSocket extends AbstractTransport implements TransportInterface
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
    protected function getStream()
    {
        if($this->stream === null){
            $this->stream = new NetworkStream($this->getHostname(), $this->getPort(), $this->getTimeout());
        }
        return $this->stream;
    }

    /**
     * {@inheritdoc}
     */
    public function send($data)
    {
        // @todo check bytes sent and written
        $this->getStream()->write($data);
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function receive($length = 1024)
    {
        return $this->getStream()->read($length);
    }
}