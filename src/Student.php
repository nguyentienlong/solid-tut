<?php 

namespace Longka;

use PDO;
use Longka\Database;

class Student
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var string studentId
     */
    protected $studentId;

    /**
     * @var string birthday
     */
    protected $birthday;

    public function __construct()
    {
        //echo "this is student constructor" . "\n";
        //assume that this studentId = 1
        $this->studentId = 1;
    }

    /**
     * Returns all courses that students enrolled
     * @return array
     */
    public function getCourses() : array
    {
        $courses = [];

        //database connection info
        //new pdo object	

		try {
			$db = new Database();
			$courses = $db->getCourses($this->studentId);	
        } catch (Exception $e) {
            throw $e;
        }
        
        return $courses;
    }
}
