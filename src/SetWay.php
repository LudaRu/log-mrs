<?php
namespace Logger;

use DateTime;
use ReflectionClass;
use Psr\Log\AbstractLogger;
use Psr\Log\LoggerInterface;

abstract class SetWay extends AbstractLogger implements LoggerInterface
{
	public $enabled = true;

	public function __construct(array $attributes = [])
	{
		$infoClass = new ReflectionClass($this);
		foreach ($attributes as $attribute => $value)
		{
			$property = $infoClass->getProperty($attribute);
			if ($property->isPublic())
			{
				$property->setValue($this, $value);
			}
		}
	}

	protected function getDate()
	{
		return (new DateTime())->format('Y-m-d H:i:s');
	}

	protected function contextToString(array $context = [])
	{
		if (!empty($context)) $data = json_encode($context);
		else $data = null;
		return $data;
	}
}