<?php

/**
 * @author Jacek Kobus <kobus.jacek@gmail.com>
 * @version $Id: Abstract.php 60 2011-11-15 00:42:03Z jacek $
 */
abstract class Posnet_Adapter_Abstract
{
	/**
	 * Device options
	 * @var array
	 */
	protected $options = array();
	
	/**
	 * Connection handle
	 * @var stream
	 */
	protected $handle = null;
	
	/**
	 * Stream timeot
	 * @var unknown_type
	 */
	protected $timeout = 5;
	
	/**
	 * Create new device connection adapter
	 * @param string $device
	 * @param array $options
	 */
	public function __construct(array $options = array())
	{
		$this->options = $options;
		if($this->getOption('timeout'))
			$this->timeout = (int) $this->getOption('timeout');
	}
	
	/**
	 * Open connection
	 */
	public abstract function open();
	
	/**
	 * @return bool
	 */
	public function isOpen()
	{
		if($this->handle === false || is_null($this->handle))
			return false;
		return true;
	}
	
	/**
	 * Close connection
	 * @return Posnet_Adapter_Abstract
	 */
	public function close()
	{
		$this->handle = null;
		return $this;
	}
	
	/**
	 * Read data from device
	 * @param int $length
	 * @return mix
	 */
	public abstract function read($length = 8192);
	
	/**
	 * Write data to a device stream
	 * @param mix $data
	 * @param int $length
	 * @return int bytes written
	 * @throws Posnet_Adapter_Exception
	 */
	public abstract function write($data, $length = null);
	
	/**
	 * Set stream tmeout
	 * @param int $seconds
	 * @return Posnet_Adapter_Abstract
	 */
	public function setTimeot($seconds)
	{
		$this->timeout = $seconds;
		return $this;
	}
	
	/**
	 * Get adapter option
	 * @param string $name
	 * @return mix|NULL if option was not found
	 */
	protected function getOption($name)
	{
		if(isset($this->options[$name]))
			return $this->options[$name];
		return null;
	}
	
	/**
	 * Throw exception
	 * @param string $message
	 * @param int $code
	 */
	protected function throwException($message, $code = null)
	{
		throw new Posnet_Adapter_Exception($message, $code);
	}
}