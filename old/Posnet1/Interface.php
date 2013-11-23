<?php

/**
 * @author Jacek Kobus <kobus.jacek@gmail.com>
 * @version $Id$
 */
interface Posnet_Interface
{
	//public function write($command, $sequence = '', $numeric = array());
	
	public function read($length = 8192);
	
	public function open();
	
	public function createReceipt();
	
	/**
	 * @param Posnet_Receipt $receipt
	 * @return Posnet_Interface
	 */
	public function printReceipt( Posnet_Receipt $receipt );
}