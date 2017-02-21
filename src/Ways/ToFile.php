<?php
namespace Logger\Ways;

use Logger\SetWay;

class ToFile extends SetWay
{
	public $filePath;
	public $template = "{date} {level} {message} {context}";
	
	public function __construct(array $attributes = [])
	{
		parent::__construct($attributes);

		if (!file_exists($this->filePath))
		{
			touch($this->filePath);
		}
	}

	public function log($level, $message, array $context = [])
	{
		//	$cont -- date, level, message, context
		$cont = $this->getDate()." ".$level." ".$message." ".$this->contextToString($context);
		file_put_contents($this->filePath, $cont.PHP_EOL, FILE_APPEND);
	}
}
