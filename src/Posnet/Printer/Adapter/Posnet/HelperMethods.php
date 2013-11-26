<?php

namespace Posnet\Adapter\Posnet\HelperMethods;

/**
 * Helper methods for Posnet Protocole adapter
 */
class HelperMethods
{
    /**
     * Calculate CRC16 checksum
     *
     * @param string $data
     * @return string
     */
    public static function crc16($data)
    {
        $byte = 0xFF;
        for ($i = 0; $i < strlen($data); $i++){
            $byte = $byte ^ ord($data[$i]);
        }
        return dechex($byte);
    }
}