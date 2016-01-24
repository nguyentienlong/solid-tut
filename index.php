<?php
require_once __DIR__.'/vendor/autoload.php';

$student = new Longka\Student();
$courses = $student->getCourses();
var_dump($courses);

