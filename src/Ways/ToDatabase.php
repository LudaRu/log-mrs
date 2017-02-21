<?php
namespace Logger\Ways;

use PDO;
use Logger\SetWay;

/*
 * таблица:
 *
	CREATE TABLE `dbname`.`Logs` ( 
		`id` INT NOT NULL AUTO_INCREMENT , 
		PRIMARY KEY (`id`),
		`date` DATETIME,
		`level` text,
		`message` text,
		`context` text
	) 
	ENGINE = InnoDB;
 */

class ToDatabase extends SetWay
{
	public $host;
	public $dbname;
	public $username;
	public $password;
	public $table;
	private $connection;

	public function __construct(array $attributes = [])
	{
		parent::__construct($attributes);		
		$this->connection = new PDO("mysql:host=".$this->host.";dbname=".$this->dbname."", $this->username, $this->password);
	}

	public function log($level, $message, array $context = [])
	{
		$statement = $this->connection->prepare(
			'INSERT INTO ' . $this->table . ' (date, level, message, context) '.'VALUES (:date, :level, :message, :context)'
		);
		$statement->bindParam(':date', $this->getDate());
		$statement->bindParam(':level', $level);
		$statement->bindParam(':message', $message);
		$statement->bindParam(':context', $this->contextToString($context));
		$statement->execute();
	}
}
