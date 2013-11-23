<?php

date_default_timezone_set('Europe/Warsaw');

include_once 'Fiscal/Thermal/Exception.php';
include_once 'Fiscal/Thermal/Driver.php';

include_once 'Posnet/Exception.php';
include_once 'Posnet/Interface.php';
include_once 'Posnet/Thermal.php';

include_once 'Posnet/Adapter/Exception.php';
include_once 'Posnet/Adapter/Abstract.php';
include_once 'Posnet/Adapter/Tcp.php';

$device = new Posnet_Thermal(new Posnet_Adapter_Tcp(array('port' => 5678)));


$device->open();

echo '=============================================' . PHP_EOL;


define('CR', "\x0d");
define('TR', "\x2f");

$device->write('$h', '', array(0)); // sprzedaż
$device->write('$l',"test1" . CR . 1 . CR . 'A' . TR . 2599.00 . TR . 2599.00 . TR, array(1));
$device->write('$l',"test2" . CR . 1 . CR . 'A' . TR . 25 . TR . 25 . TR, array(2));
$device->write('$l', "test3" . CR . 1 . CR . 'A' . TR . 2 . TR . 2 . TR, array(3));
$device->write('$l', "test <3" . CR . 99 . CR . 'A' . TR . 1 . TR . 99 . TR, array(4));


//$device->write('$e'); // ANULOWANIE TRANSAKCJI
$device->write(
	'$e', "0" . CR
	. '           Dziekuje za zakupy' . CR
	. '         i zapraszam ponownie :)' . CR
	. '            http://test.pl'
	. CR . 0 . TR . 2725 . TR,
	
	array(1, 0, 3, 0)
); // POTWIERDZENIE TRANSAKCJI

/*

$device->write("#u",2);

$res = $device->read();

var_dump( $res );
*/

/*
$device = new Fiscal_Thermal_Driver();

/*
try {
	$device->open('com2');
	echo 'Polaczenie udalo sie !';
}catch (Fiscal_Thermal_Exception $e){
	echo 'Polaczenie NIE powiodło się !';
}*/

//var_dump(ini_get('default_socket_timeout'));
//die;

//ESC P 1 ; Py; Pm ; Pd #r [<nr_kasy> CR <kasjer> CR] <check> ESC \
//$res = $device->write('#r', "1\x0dJacek\x0d", array(1,11,5,8)); // dobowy

//$res = $device->write('$h', '', array(0)); // sprzedaż
// ESC P Pi $l <nazwa> CR <ilość> CR <ptu> / CENA / BRUTTO / <check> ESC \
//$res = $device->write('$l', "Testowy towar A\x0d", array(1)); // linia paragonu
//$res = $device->write('$l', "\x0dTestowy towar A\x0d1.\x0dA\x2f100\x2f123\x2f", array(1)); // linia paragonu
//$res = $device->write('$l', "1\x0d"."Testowy towar B"."\x0d"."1"."\x0d"."A/20/30.69", array(2)); // linia paragonu
//$res = $device->write('$e'); // linia paragonu



//$res = $device->write('#v');
//$prnt = $device->read(1);


//var_dump($res,$prnt);

//$device->close();