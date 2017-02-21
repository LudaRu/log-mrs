<?php
namespace Logger;

use Iterator;
use Psr\Log\AbstractLogger;
use Psr\Log\LoggerInterface;

class Logger extends AbstractLogger implements LoggerInterface
{
	private $routes;
	public function __construct(Iterator $routes)
	{
		$this->routes = $routes;
	}

	public function log($level, $message, array $context = [])
	{
		foreach ($this->routes as $route)
		{
			//	принадлежит пути?
			if (!$route instanceof SetWay)
			{
				continue;
			}
			//	включено?
			if (!$route->enabled)
			{
				continue;
			}

			$route->log($level, $message, $context);
		}
	}
}