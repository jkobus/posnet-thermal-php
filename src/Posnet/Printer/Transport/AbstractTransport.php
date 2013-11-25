<?php

namespace Posnet\Printer\Transport;

/**
 * Abstract transport
 */
abstract class AbstractTransport implements TransportInterface
{

    /**
     * @var int
     */
    protected $timeout;

    public function setTimeout($timeout)
    {
        $this->timeout = $timeout;
        return $this;
    }

    /**
     * @return int
     */
    public function getTimeout()
    {
        return $this->timeout;
    }

    public abstract function receive();

    public abstract function send($data);

}