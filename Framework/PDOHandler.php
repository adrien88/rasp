<?php

namespace Frame;


class PDOHandler
{
	static $PDO = [];

	static function getInstance(string $name, array $config = [])
	{
		if (!isset(self::$PDO[$name]))
			self::$PDO[$name] = new self($name, $config);
		return self::$PDO[$name];
	}

	static function listInstance()
	{
		return array_keys(self::$PDO);
	}

	/**
	 * 
	 */
	function __construct($name, $config)
	{
		try {
			extract($config);
			$str = "$type:dbname=$name;host=$host;";
			self::$PDO[$name] = new \PDO($str, $login, $password);
		} catch (\PDOException $e) {
			var_dump($e);
		}
	}
}
