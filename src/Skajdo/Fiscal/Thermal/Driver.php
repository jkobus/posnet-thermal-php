<?php

require_once 'SerialPort.php';
require_once 'SerialPort/Device.php';

/**
 * Sterownik dla drukarek pracujących pod prot. POSNET THERMAL
 * Obsługiwane drukarki:
 * - Thermal FV EJ 1.01
 * - Thermal HS FV EJ 1.01
 * - Thermal FV 3.02
 *
 * @author Jacek Kobus <kobus.jacek@gmail.com>
 * @copyright Wszystkie prawa zastrzeżone.
 * @version $Id: Driver.php 60 2011-11-15 00:42:03Z jacek $
 */
class Fiscal_Thermal_Driver
{
	/**
	 * Com port
	 * @var string
	 */
	protected $port = null;
	
	/**
	 * Connection handle
	 * @var SerialPort_Device
	 */
	protected $device = null;
	
	/**
	 * Open device
	 *
	 * @param string $comPort
	 * @param string $mode OPTIONAL
	 * @throws Fiscal_Posnet_Exception
	 * @return Fiscal_Posnet_Driver
	 */
	public function open($com)
	{
		$this->port = $com;
		$this->device = SerialPort::newDevice('\\\\.\\'.$this->port);
		$this->device->open();
		//exec('mode com2 baud=9600 data=8 STOP=1 parity=n');
		return $this;
	}
	
	/**
	 * Close device
	 * @return Fiscal_Posnet_Driver
	 */
	public function close()
	{
		$this->device->close();
		return $this;
	}
	
	/**
	 *
	 * @param unknown_type $command
	 * @param unknown_type $sequence
	 * @param unknown_type $numeric
	 */
	public function write($command, $sequence = '', $numeric = array())
	{
		
		$numParams = implode("\x3b", $numeric);
		$frameContents = $numParams.$command.$sequence;

		$crc = $this->crc($frameContents);
		$command = "\x1b\x50".$frameContents.$crc."\x1b\x5c";

		$time = time();
		
		$socket = fsockopen('localhost', 5000, $errno, $errstr, 5);
		if($socket === false){
			throw new Exception($errstr);
		}

		stream_set_timeout($socket, 5);
		file_put_contents('fiskal.txt', $command);
		fwrite($socket, $command);
		//$response = stream_get_line($socket, 8192, "\x1b\x5c");
		$response = fread($socket, 8192);

		echo "Czas [".(time() - $time)."] - ".$response . PHP_EOL;
	}
	
	/**
	 * Read data from device
	 * @param int $length
	 */
	public function read($length = 0)
	{
		sleep(5);
		return $this->device->read($length);
	}

	/**
	 * Obliczanie bajtu kontrolnego (CRC16-CCITT)
	 * @param string $data
	 * @return string hex control byte
	 */
	protected function crc($data)
	{
		$dataLength = strlen($data);
		$byte = 0xFF;
		for ($i = 0; $i < strlen($data); $i++){
			$byte = $byte ^ ord($data[$i]);
		}
		return dechex($byte);
	}
}