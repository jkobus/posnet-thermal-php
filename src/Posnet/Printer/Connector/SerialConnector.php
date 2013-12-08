<?php

namespace Posnet\Printer\Connector;

use Skajdo\Stream\Stream;

/**
 * Class SerialConnector
 * Transport packets using serial port (COM)
 *
 * @author Jacek Kobus <kobus.jacek@gmail.com>
 */
class SerialConnector extends AbstractConnector
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
     * @return $this
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
    public function receive($length = 8142, $eolChar = null)
    {
        if($eolChar !== null){

            $buffer = '';
            $position = 0;

            while(($char = $this->getStream()->read(1)) !== false && $position < $length && $char != $eolChar){
                $buffer .= $char;
            }
            return $buffer;

        }else{
            return $this->getStream()->read($length);
        }
    }
}