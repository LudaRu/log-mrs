<?php
namespace Logger\Ways;

use Logger\SetWay;
use Psr\Log\LogLevel;

class ToSTD extends SetWay
{
	public function log($level, $message, array $context = [])
	{
		$cont = $this->getDate()." ".$level." ".$message." ".$this->contextToString($context);
		$stdout = fopen('php://stdout', 'w');
		echo "STDOUT:\n";
        fwrite($stdout , $cont);
	}
}
