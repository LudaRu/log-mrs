<?php
include 'vendor/autoload.php';

$ways = new SplObjectStorage();

$ways->attach(new Logger\Ways\ToSTD([
	'enabled' => true,
]));

$ways->attach(new Logger\Ways\ToFile([
	'enabled' => false,
	'filePath' => 'data/logs.log',
]));

$ways->attach(new Logger\Ways\ToDatabase([
	'enabled' => false,
	'host' => 'localhost',
	'dbname' => 'dbname',
	'username' => 'root',
	'password' => 'pass',
	'table' => 'Logs'
]));

/*
 *	$logger-> [level] ( [message] , [строка, массив, объект] )
 *	level -- info, alert, error, debug, notice, warning, critical, emergency
 */
$array = ['1','2','3','4','5'];
$logger = new Logger\Logger($ways);
$logger->info("Info msg",$array);