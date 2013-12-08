<?php

namespace Posnet\Printer\Connector;
use Skajdo\Stream\StreamInterface;

/**
 * Class AbstractConnector
 *
 * @author Jacek Kobus <kobus.jacek@gmail.com>
 */
abstract class AbstractConnector implements ConnectorInterface
{
    /**
     * @return StreamInterface
     */
    public abstract function getStream();
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