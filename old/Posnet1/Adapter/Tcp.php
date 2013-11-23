<?php

/**
 * Send raw data throught TCP/IP
 * @author Jacek Kobus <kobus.jacek@gmail.com>
 * @version $Id: Tcp.php 60 2011-11-15 00:42:03Z jacek $
 */
class Posnet_Adapter_Tcp extends Posnet_Adapter_Abstract
{
	protected $errorMessage = '';
	protected $errorNo = '0';
	protected $hostname = '127.0.0.1';
	protected $port = 5678;
	
	/**
	 * Create new TCP/IP connection with a printer over a virtual bridge
	 * @param array $options
	 */
	public function __construct(array $options = array())
	{
		parent::__construct($options);
		
		if($this->getOption('hostname'))
			$this->hostname = $this->getOption('hostname');
			
		if($this->getOption('port'))
			$this->port = $this->getOption('port');
	}
	
	/**
	 * Open device
	 * @see Posnet_Adapter_Abstract::open()
	 * @return Posnet_Adapter_Tcp
	 */
	public function open()
	{
		if(!$this->handle){
			$this->handle = fsockopen(
				$this->hostname,
				$this->port,
				$this->errorNo,
				$this->errorMessage,
				$this->timeout
			);
			
			if($this->handle === false){
				throw new Posnet_Adapter_Exception
					('Nie można połączyć się z drukarką (sprawdź adapter COM2TCP).');
			}
		}
		return $this;
	}
	
	/**
	 * Close device
	 * @see Posnet_Adapter_Abstract::close()
	 * @return void
	 */
	public function close()
	{
		@fclose($this->handle);
		parent::close();
	}
	
	/**
	 * Write data to a device stream
	 * @param mix $data
	 * @param int $length
	 * @return int bytes written
	 * @throws Posnet_Adapter_Exception
	 */
	public function write($data, $length = null)
	{
		try {
			$this->open();
			stream_set_timeout($this->handle, $this->timeout);
			$result = fwrite($this->handle, $data);
			if($result === false){
				$this->throwException('Funkcja zapisu zwróciła błąd (fwrite() = false)');
			}
			return $result;
		}catch (Posnet_Adapter_Exception $e){
			$this->throwException('Nie można wysłać danych do urządzenia - '.$e->getMessage());
		}
	}
	
	/**
	 * @return mix
	 */
	public function read($length = 8192)
	{
		//stream_set_timeout($this->handle, $this->timeout);
		$r = fread($this->handle, $length);
		return $r;
	}
}