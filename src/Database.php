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

	/**
	 * Returns all courses that students enrolled
	 *
	 * @var int $studentId
	 *
	 * @return array
	 * @throws Exception
	 */ 
	public function getCourses($studentId) : array
	{
		$courses = [];	
		try {
			$db = new Database(); 	
			$conn = $this->getPostgresDbConnection();
			$query = "SELECT course.id, course.name from enrollment, course where enrollment.course_id = course.id and " .
                    "enrollment.student_id = " . $studentId;
 			$result = $conn->query($query);
			foreach ($result as $row) {
				$courses[] = [
					'id' => $row['id'],
					'name' => $row['name'],
				];
			}

		} catch (Exception $e) {
			throw $e;
		}
		return $courses;
	}			
}
