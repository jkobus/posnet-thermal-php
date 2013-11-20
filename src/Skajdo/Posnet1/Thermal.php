<?php

/**
 * POSNET Thermal 2.02 (Wer. dok. 1.06)
 * @author Jacek Kobus <kobus.jacek@gmail.com>
 * @version $Id: Thermal.php 60 2011-11-15 00:42:03Z jacek $
 */
class Posnet_Thermal implements Posnet_Interface
{
	/**
	 * @var Posnet_Adapter_Abstract
	 */
	protected $adapter;
	
	public function __construct(Posnet_Adapter_Abstract $adapter = null)
	{
		if($adapter){
			$this->adapter = $adapter;
		}else{
			$this->adapter = new Posnet_Adapter_Tcp();
		}
	}
	
	/**
	 * @throws Posnet_Exception
	 * @return Posnet_Thermal
	 */
	public function open()
	{
		if(!$this->adapter->isOpen())
			$this->adapter->open();
		return $this;
	}
	
	/**
	 * Close connection
	 */
	public function close()
	{
		$this->adapter->close();
	}
	
	/**
	 * Execute a command
	 * @param string $name
	 * @param bytestring $sequence
	 * @param array $numeric
	 * @return bytes written
	 */
	public function send($name, $sequence = '', $numeric = array())
	{
		$numericParams = implode("\x3b", $numeric);
		$frame = $numericParams.$name.$sequence;
		$crc = $this->crc($frame);
		$buffer = "\x1b\x50".$frame.$crc."\x1b\x5c";
		$written = $this->adapter->write($buffer);
		return $written;
	}
	
	/**
	 * @return mix
	 */
	public function read($length = 8192)
	{
		sleep(1);
		return $this->adapter->read($length);
	}
	
	/**
	 * @return int bytes written
	 * @see Posnet_Interface::write()
	 */
	public function write($bytes, $length = null)
	{
		$written = $this->adapter->write($bytes, $length);
		return $written;
	}
	
	/**
	 * Decode response
	 * @todo test
	 * @param string $response
	 * @return array {frame, numeric, command, string, crc}
	 */
	public function decode($response)
	{
		$matches = array();
		$raw = preg_match(
			'#^\x1b\x50(((?:[0-9]{1,3};?)*)((?:\$|\#)[a-zA-Z])(.*))(.{2})\x1b\x5c#s',
			$response,
			$matches
			// 1 - frame contents; 2 - numeric params, 3 - command, 4 - string, 5 - crc
		);
		
		if(count($matches) != 6){
			throw new Posnet_Exception('Nieprawidłowa odpowiedź: "'.$response.'" - nie można zdekodować.');
		}
		
		$numeric = explode(';', $matches[2]);
		
		$r = array(
			'frame' => $matches[1],
			'numeric' => $numeric,
			'command' => $matches[3],
			'string' => $matches[4],
			'crc' => (int) $matches[5],
		);
		
		$crc = $this->crc($r['frame']);
		
		if($crc != $r['crc'])
			throw new Posnet_Exception('Błąd CRC: "'.$crc.'", oczekiwane: '.$r['crc']);
		
		return $r;
	}
	
	/**
	 * @return bool
	 */
	public function isOnline()
	{
		$this->adapter->write("\x10",1);
		$status = $this->checkBit( $this->read(1) , 6);
		if(!$status)
			return false;
		return true;
	}
	
	/**
	 * @return bool
	 */
	public function hasPaper()
	{
		$this->adapter->write("\x10",1);
		$status = $this->checkBit( $this->read(1) , 7);
		if($status)
			return false;
		return true;
	}
	
	/**
	 * Tell if the printer is ready for work.
	 * @return bool
	 */
	public function isFunctional()
	{
		$written = $this->adapter->write("\x10",1);
		$byte = $this->adapter->read(1);
		
		if(empty($byte)){
			return false;
		}
		
		$status1 = $this->checkBit( $byte , 6); // is online
		$status2 = !$this->checkBit( $byte , 7); // paper; returns 1 if no paper
		$status3 = !$this->checkBit( $byte , 8); // mech/driver problems

		if($status1){
			if($status2){
				if($status3){
					return true;
				}else{}
			}else{}
		}else{}
		return false;
	}
	
	/**
	 * @return bool
	 */
	public function isInTrainingMode()
	{
		return !$this->isInFiscalMode();
	}
	
	/**
	 * @return bool
	 */
	public function isInFiscalMode()
	{
		//    01100110
		// 00000001
		$written = $this->adapter->write("\x05",1);
		$byte = $this->adapter->read(1);
		return $this->checkBit( $byte , 5);
	}
	
	/**
	 * Tell if the printer is doing some transaction
	 * @return bool
	 */
	public function isInTransactionMode()
	{
		$written = $this->adapter->write("\x05",1);
		$byte = $this->adapter->read(1);
		return $this->checkBit( $byte , 7);
	}
	
	/**
	 * Get receipt header
	 * @return string
	 */
	public function getHeader()
	{
		$this->send('#u');
		$result = $this->decode($this->read());
		return $result['string'];
	}
	
	/**
	 * Set header
	 * @param string $string 40 chars per line, 20 bold chars per line
	 * @throws Posnet_Adapter_Exception
	 * @return Posnet_Thermal
	 */
	public function setHeader($string, $cashRegId = '', $cashier = '' )
	{
		if(strlen($string) > 500)
			throw new Posnet_Adapter_Exception
				('Parametr "string" jest za długi (max. 500 znaków).');
	
		$this->send('$f', 'ABC' . "\xff", array(0));
			
		//$crc = '$f'."abc"."\xff".$cashRegId."\x0d".$cashier."\x0d". "00";
		/*
		$frame = "0\x24F\xff";
		$crc = $this->crc( $frame );
		$buffer = "\x1b\x50$frame$crc\x1b\x5c";
		
		$this->write($buffer);
		var_dump($buffer);*/
		//$this->send('$f', $string."\xff".$cashRegId."\x0d".$cashier."\x0d", array(0));
		return $this;
	}
	
	/**
	 * Print daily report
	 * @param string $day
	 * @param string $month
	 * @param string $year
	 * @return Posnet_Thermal
	 */
	public function printDailyReport($day = '', $month = '', $year = '')
	{
		$this->send('#r', '', array(1, $year, $month, $day));
		return $this;
	}
	
	/**
	 * Print receipt
	 * @see Posnet_Interface::printReceipt()
	 * @return Posnet_Thermal
	 */
	public function printReceipt( Posnet_Receipt $receipt )
	{
		if($this->isInTransactionMode()){
			if($this->isInTransactionMode()){
				$this->send('$e', '', array(0,0,0));
				throw new Posnet_Exception
					('Drukarka jest zajęta (w trybie transakcji). Spróbuj ponownie za chwilę.');
			}
		}
		
		$this->send('$h', '', array(0,0));
		
		$total = 0;
		$lines = array();

		define('CR', "\x0d");
		define('TR', "\x2F");
		
		$i = 1;
		foreach ($receipt->getItems() as $item){
			$total += $item['total'];
			$this->send('$l',
				"$item[name]\x0D$item[quantity]\x0D$item[taxClass]\x2F$item[price]\x2F$item[total]\x2F",
			array($i));
			$i++;
		}
		
		$this->send('$e', "000\x0d0/$total/", array(1));
		return $this;
	}
	
	/**
	 * @see Posnet_Interface::createNewReceipt()
	 * @return Posnet_Receipt
	 */
	public function createReceipt()
	{
		return new Posnet_Receipt($this);
	}
	
	/**
	 * @return array string => d;m;y;h;i;s
	 */
	public function getTime()
	{
		$this->send('#c');
		$data = $this->read();
		$data = $this->decode($data);
		return $data;
	}
	
	/**
	 * Check bit value
	 * @param unknown_type $offset
	 * @return bool
	 */
	public function checkBit($word, $offset)
	{
		$word = (string) $word;
		
		if(empty($word))
			throw new Posnet_Adapter_Exception('Podany bajt jest pusty.');
		
		//@todo dac max 255 - xff
		$dec = ord($word);
		if($dec > 255){
			throw new Posnet_Adapter_Exception
				('Podano niepoprawną wartość bajtu. Maksymalny rozmiar: 0xFF (dec 255).');
		}
		
		$word = decbin($dec);
		$word = str_pad($word, 8, '0', STR_PAD_LEFT);
		//return (( (int) $word >>(8-$offset))&1);
		return (bool) substr($word, $offset-1, 1);
	}
	
	/**
	 * Play short beep
	 */
	public function playBeep()
	{
		$this->write("\x07", 1);
		return $this;
	}
	
	/**
	 * Play double beep
	 */
	public function playDoubleBeep()
	{
		$this->playBeep();
		sleep(1);
		$this->playBeep();
		return $this;
	}
	
	/**
	 * Play long beep
	 * @param int $lengthInSeconds
	 */
	public function playLongBeep($lengthInSeconds = 5)
	{
		for ($i=0;$i<$lengthInSeconds;$i++){
			$this->playBeep();
		}
		return $this;
	}
	
	/**
	 * @param string $data
	 * @return byte
	 */
	public function crc($data)
	{
		$dataLength = strlen($data);
		$byte = 0xFF;
		for ($i = 0; $i < strlen($data); $i++){
			$byte = $byte ^ ord($data[$i]);
		}
		return dechex($byte);
	}
}