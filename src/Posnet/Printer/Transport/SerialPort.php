<?php

namespace Posnet\Printer\Transport;

use Skajdo\Stream\Stream;

/**
 * Transport packets using COM ports
 */
class SerialPort extends AbstractTransport implements TransportInterface
{
    /**
     * @var Stream
     */
    protected $stream;

    /**
     * @var string
     */
    protected $port;

    /**
     * @param $port
     */
    function __construct($port)
    {
        $this->port = $port;
    }

    /**
     * @param string $port
     * @return SerialPort
     */
    public function setPort($port)
    {
        $this->port = $port;

        return $this;
    }

    /**
     * @return string
     */
    public function getPort()
    {
        return $this->port;
    }

    /**
     * @return Stream
     */
    protected function getStream()
    {
        if($this->stream === null){
            $this->stream = new Stream(fopen('\\\\.\\' . $this->getPort(), 'r+b'));
        }
        return $this->stream;
    }

    /**
     * {@inheritdoc}
     */
    public function send($data)
    {
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