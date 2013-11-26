<?php

namespace Posnet\Adapter\Posnet;

use Posnet\Adapter\Posnet\HelperMethods\HelperMethods;

/**
 * Command frame
 */
class PrinterFrame
{
    const STX = 0x02;

    const TAB = 0x09;

    const ETX = 0x03;

    const HASH = 0x23;

    const AT = 0x40;

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
     * @var array
     */
    protected $token = null;

    /**
     * @param string $mnemonic
     * @param array  $arguments
     * @param string $token
     */
    function __construct($mnemonic, $arguments = array(), $token = null)
    {
        $this->mnemonic = $mnemonic;
        $this->arguments = $arguments;
        $this->token = $token;
    }

    /**
     * @param string $mnemonic
     * @return PrinterFrame
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
     * @return PrinterFrame
     */
    public function setArguments(array $arguments)
    {
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
     * @param array $token
     * @return PrinterFrame
     */
    public function setToken($token)
    {
        $this->token = $token;

        return $this;
    }

    /**
     * @return array
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * Build a frame
     *
     * @return string
     */
    public function build()
    {
        $args = null;
        foreach($this->arguments as $name => $value){
            $args .= $name . $value . self::TAB;
        }

        $token = null;
        if($this->token !== null){
            $token = self::AT . $this->token . self::TAB;
        }

        $frameBody = $this->mnemonic . self::TAB . $args . $token;
        $crc16 = HelperMethods::crc16($frameBody);
        $frame = self::STX . $frameBody . self::HASH . $crc16 . self::ETX;
        return $frame;
    }
//
//    /**
//     * @return string
//     */
//    public function __toString()
//    {
//        return $this->build();
//    }
}