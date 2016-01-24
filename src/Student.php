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
     * todo: This to prove broken single responsibility in solid principle
     * connect to database, handle connection , etc
     * @return array
     */
    public function getCourses() : array
    {
        $courses = [];

        //database connection info
        //new pdo object	

        try {
            $db = new Database();
            $conn = $db->getPostgresDbConnection();

            $query = "SELECT course.id, course.name from enrollment, course where enrollment.course_id = course.id and " .
                    "enrollment.student_id = " . $this->studentId;
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
