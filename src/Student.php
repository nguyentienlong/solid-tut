<?php 

namespace Longka;

use PDO;

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
     * todo: This to prove broken single responsibility in solid principle
     * connect to database, handle connection , etc
     * @return array
     */
    public function getCourses() : array
    {
        $courses = [];

        //database connection info
        $dbHost = '127.0.0.1';
        $dbName = 'phptut';
        $dbUser = 'postgres';
        $dbPass = 'postgres';

        try {
            //new pdo object	
            $db = new PDO("pgsql:dbname=$dbName;host=$dbHost", $dbUser, $dbPass);
			$query = "SELECT course.id, course.name from enrollment, course where enrollment.course_id = course.id and " . 
					"enrollment.student_id = " . $this->studentId;
			$result = $db->query($query);
			var_dump($result);
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
