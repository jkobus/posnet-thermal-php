<?php

require_once 'SerialPort/Device/Exception.php';

/**
 *
 * @author Jacek Kobus <kobus.jacek@gmail.com>
 * @version $Id: Device.php 48 2011-06-29 20:24:31Z jacek $
 */
class SerialPort_Device
{
	protected $device = null;
	protected $handle = null;
	
	public function __construct($device)
	{
		$this->device = $device;
		register_shutdown_function(array($this, "close"));
	}
	
	/**
	 * Open device
	 * @return void
	 */
	public function open()
	{
		if($this->device){
			$this->handle = fopen($this->device, 'r+');
			if($this->handle === false){
				$this->exception(
					'Could not connect to the device. '
					.'Make sure it is connected and not used by another application.'
				);
			}
			stream_set_blocking($this->handle, 1);
		}else{
			$this->exception('Device was not set.');
		}
		return;
	}
	
	/**
	 * Close device
	 * @return void
	 */
	public function close()
	{
		if(!is_null($this->handle) && $this->handle !== false)
			fclose($this->handle);
		$this->handle = null;
	}
	
	public function reconnect()
	{
		$this->close();
		$this->open();
	}
	
	/**
	 * Read from socket
	 * @param int $length
	 */
	public function read($length = null)
	{
		var_dump(stream_get_meta_data($this->handle));
		die;
		
		//stream_set_blocking($this->handle, 0);
		//stream_set_timeout($this->handle, 10);
		$i = 0;
		$content = '';
		//do {
		
		$content = stream_get_contents($this->handle,2);
		//$content = file_get_contents($this->handle);
		//} while (($i += 128) === strlen($content));
		
		//$buffer = fread($this->handle, 1024);
		return $content;
	}
	
	/**
	 * @param unknown_type $data
	 * @return int bytes written
	 */
	public function write($data)
	{
		if( ($result = fwrite($this->handle, $data)) === false)
			$this->exception('Could not write to the device.');
		return $result;
	}
	
	/**
	 * Throw exception
	 * @param string $message
	 * @throws SerialPort_Device_Exception
	 * @return void
	 */
	protected function exception($message)
	{
		throw new SerialPort_Device_Exception($message);
	}
}