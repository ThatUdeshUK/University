<?php

namespace framework\models;

use framework\util\DBUtils;

class Course
{
    private $db;

    public function __construct(\mysqli $db)
    {
        $this->db = $db;
    }

    public function getCourseSections($c_code)
    {
        $result = $this->db->query("select * from course_section WHERE c_code = $c_code");
        return DBUtils::getAssocArray($result);
    }

    public function getCourseSection($c_code, $cs_number)
    {
        $result = $this->db->query("select * from course_section where c_code = " . $c_code . " AND cs_number = " . $cs_number);
        return $result->fetch_assoc();
    }

    public function addCourseSection($c_code, $semester, $year, $class_size, $class_time, $class_room, $e_id)
    {
        $sql = "INSERT INTO course_section (c_code, semester, `year`, class_size, class_time, class_room, e_id) VALUES ($c_code, '$semester', '$year', '$class_size', '$class_time', '$class_room', $e_id)";
        $result = $this->db->query($sql);
        return $result;
    }

    public function updateCourseSection($cs_number, $class_size, $class_time, $class_room, $e_id)
    {
        $sql = "UPDATE course_section SET class_size = $class_size, class_time = '$class_time', class_room = '$class_room', e_id = $e_id WHERE cs_number = '$cs_number'";
        $result = $this->db->query($sql);
        return $result;
    }

    public function deleteCourseSection($cs_number)
    {
        $sql = "DELETE FROM course_section WHERE cs_number = $cs_number";
        $result = $this->db->query($sql);
        return $result;
    }
}
