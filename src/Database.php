<?php

namespace App;

class Database
{

	private static \PDO|null $connection = null;

	private function __construct()
	{
	}

	public static function getConnection(): \PDO
	{
		if (self::$connection !== null) {
			return self::$connection;
		}

		$host = $_ENV['DB_HOST'] ?? '';
		$dbname = $_ENV['DB_NAME'] ?? '';
		$user = $_ENV['DB_USER'] ?? '';
		$pass = $_ENV['DB_PASS'] ?? '';

		$connection = new \PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
		self::$connection = $connection;

		return $connection;
	}
}
