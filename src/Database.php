<?php

namespace LongKa;

use PDO;
use PDOException;

class Database
{
	/**
 	 * @var array $dbInfo
  	 */		
	protected $dbInfo;

	public function __construct()
	{
		$this->dbInfo = [
			'host' => '127.0.0.1',
			'db-name' => 'phptut',
			'user' => 'postgres',
			'pass' => 'postgres',	
		];			
	}

	/**
	 * Get postgres database connection
	 *
	 * @return PDO
	 * @throws PDOException 
	 */
	public function getPostgresDbConnection() : PDO
	{
		$db = null;
		$url= "pgsql:dbname=" . $this->dbInfo['db-name'] . ";host=" . $this->dbInfo['host'];	

		try {
			$db	= new PDO($url, $this->dbInfo['user'], $this->dbInfo['pass']);
		} catch (PDOException $e) {
			throw $e;			
		}

		return $db;
	}
}		

