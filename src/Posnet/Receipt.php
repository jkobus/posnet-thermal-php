<?php

/**
 * Create receipt
 * @author Jacek Kobus <kobus.jacek@gmail.com>
 * @version $Id$
 */
class Posnet_Receipt implements Countable {
	
	/**
	 * @var Posnet_Interface
	 */
	protected $driver;
	
	/**
	 * @var array
	 */
	protected $items = array();
	
	/**
	 * List of avilable tax-classes
	 * @var array
	 */
	protected $taxClass = array(
		'A', 'B', 'C', 'D', 'E', 'F', 'G', 'Z'
	);
	
	/**
	 * Create new receipt
	 * @param Posnet_Interface $driver
	 */
	public function __construct( Posnet_Interface $driver )
	{
		$this->driver = $driver;
	}

	public function addItem($name, $grossPrice, $totalGrossPrice, $quantity = 1, $taxClass = 'A')
	{
		if(!in_array($taxClass, $this->taxClass))
			throw new Posnet_Receipt_Exception
				('Invalid tax-class: '.$taxClass.' (allowed: A-G,Z)');

		if(empty($name))
			throw new Posnet_Receipt_Exception('Item name cannot be empty.');
				
		$this->items[] = array(
			'name' => $name,
			'quantity' => $quantity,
			'price' => $grossPrice,
			'total' => $totalGrossPrice,
			'taxClass' => $taxClass,
		);
		return $this;
	}
	
	/**
	 * @return array
	 */
	public function getItems()
	{
		return $this->items;
	}
	
	/**
	 * @return int
	 */
	public function count()
	{
		return count($this->items);
	}
	
	/**
	 * Send to printer
	 * @throws Posnet_Exception
	 */
	public function send()
	{
		return $this->driver->printReceipt( $this );
	}
	
	/**
	 * Alias of send()
	 * @throws Posnet_Exception
	 * @return
	 */
	public function printReceipt()
	{
		return $this->send();
	}
	
}