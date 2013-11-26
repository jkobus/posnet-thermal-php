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

    /**
     * @param int $timeout
     * @return $this
     */
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

    /**
     * {@inheritdoc}
     */
    public abstract function send($data);

    /**
     * {@inheritdoc}
     */
    public abstract function receive($length = 1024);

}