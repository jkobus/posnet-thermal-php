<?php

namespace Posnet\Printer\Adapter\Posnet;

use Skajdo\Crc16CCIT;

/**
 * Command frame
 */
class Frame
{
    const STX = "\x02";

    const TAB = "\x09";

    const ETX = "\x03";

    const HASH = "\x23";

    const AT = "\x40";

    /**
     * Printer command
     *
     * @var string
     */
    protected $mnemonic;

    /**
     * @var array
     */
    protected $arguments = array();

    /**
     * @var string
     */
    protected $token = null;

    /**
     * @param string $mnemonic
     * @param array  $arguments
     * @param string $token
     */
    function __construct($mnemonic, $arguments = array(), $token = null)
    {
        $this->setMnemonic($mnemonic);
        $this->setArguments($arguments);
        if($token !== null){
            $this->setToken($token);
        }
    }

    /**
     * @param string $mnemonic
     * @return Frame
     */
    public function setMnemonic($mnemonic)
    {
        $this->mnemonic = $mnemonic;

        return $this;
    }

    /**
     * @return string
     */
    public function getMnemonic()
    {
        return $this->mnemonic;
    }

    /**
     * @param array $arguments
     * @throws \InvalidArgumentException
     * @return Frame
     */
    public function setArguments(array $arguments)
    {
        foreach($arguments as $name => $value){
            if(strlen($name) != 2){
                throw new \InvalidArgumentException(sprintf('Invalid argument name length: %s', $name));
            }
        }

        $this->arguments = $arguments;
        return $this;
    }

    /**
     * @return array
     */
    public function getArguments()
    {
        return $this->arguments;
    }

    /**
     * @param string $token
     * @throws \InvalidArgumentException
     * @return Frame
     */
    public function setToken($token)
    {
        if(preg_match('#^\d{4}$#', $token) !== 1){
            throw new \InvalidArgumentException('Token must contain 4 digits');
        }
        $this->token = $token;
        return $this;
    }

    /**
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * Build a frame
     *
     * @throws \InvalidArgumentException
     * @return string
     */
    public function build()
    {
        $args = null;
        foreach($this->getArguments() as $name => $value){
            $args .= $name . $value . self::TAB;
        }

        $token = null;
        if($this->getToken() !== null){
            $token = self::AT . $this->getToken() . self::TAB;
        }

        $frameBody = $this->getMnemonic() . self::TAB . $args . $token;
        $crc16 = Crc16CCIT::calculate($frameBody);
        $frame = self::STX . $frameBody . self::HASH . $crc16 . self::ETX;
        return $frame;
    }
}