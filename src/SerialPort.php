<?php

/**
 *
 * @author Jacek Kobus <kobus.jacek@gmail.com>
 * @version $Id: SerialPort.php 48 2011-06-29 20:24:31Z jacek $
 */
class SerialPort
{
	/**
	 * Create new serial port connection with a specified device.
	 * @param string $device
	 * @return SerialPort_Device
	 */
	public static function newDevice($device)
	{
		return new SerialPort_Device($device);
	}
}