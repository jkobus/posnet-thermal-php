<?php

namespace Posnet\Printer\Adapter\Posnet;

use Skajdo\Crc16CCIT;

/**
 * Response frame
 */
class ResponseFrame
{
    /**
     * Printer command
     *
     * @var string
     */
    protected $mnemonic;

    /**
     * @var int
     */
    protected $errorCode;

    /**
     * @param string $mnemonic
     */
    function __construct($mnemonic)
    {
        $this->setMnemonic($mnemonic);
    }

    /**
     * @param string $mnemonic
     * @return Frame
     * @return $this
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
     * @param int $errorCode
     * @return ResponseFrame
     */
    public function setErrorCode($errorCode)
    {
        $this->errorCode = $errorCode;

        return $this;
    }

    /**
     * @return int
     */
    public function getErrorCode()
    {
        return $this->errorCode;
    }

    /**
     * @return bool
     */
    public function hasError()
    {
        return $this->getErrorCode() !== null;
    }

    /**
     * Decode raw data and create a response frame
     *
     * @param $raw
     * @return ResponseFrame
     */
    public static function decode($raw){

        return new self('asd');
    }
}