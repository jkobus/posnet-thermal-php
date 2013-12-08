<?php

ini_set('wincache.ocenabled', false);

use Posnet\Printer\Adapter\Posnet\RequestFrame;
use Posnet\Printer\Transport\SerialPort;

require_once __DIR__ . '/vendor/autoload.php';

$modeCommand = 'mode COM5 baud=115200 parity=n data=8 stop=1 rts=on to=off';
exec($modeCommand);

//
//
//$dailyReport = new \Posnet\Report\DailyReport();
//$reportPrinter = new \Posnet\Report\ReportPrinter($dailyReport);
//
//$adapter = new \Posnet\Printer\Adapter\Posnet\PosnetAdapter();
//$connector = new \Posnet\Printer\Connector\SerialConnector('COM3');
//
//$printer = new \Posnet\Printer\Printer($adapter, $connector);
////$printer->doPrint($reportPrinter);
//
//
//$frame = new RequestFrame('sdev');
//$frame->setAsynchronous(true);
//
//$adapter->push($frame);
//


//$connector = new \Posnet\Printer\Connector\SerialConnector('COM2');

//$frame = new RequestFrame('!sdev');
$frame = new RequestFrame('!sdev');
$content = $frame->build() . PHP_EOL;

echo 'Frame: ' . $content . PHP_EOL;
$handle = fopen('\\\\.\\COM3', 'r+b');

$written = fwrite($handle, $content, strlen($content));

echo 'Written: ' . $written . PHP_EOL;
echo 'Reading ...' . PHP_EOL;

//stream_set_blocking($handle, 0);
sleep(1);
$buffer = fread($handle, 8);
var_dump($buffer);
fclose($handle);
die;

//echo 'Buffer: ' . $buffer . PHP_EOL;
//echo 'Complete !';
