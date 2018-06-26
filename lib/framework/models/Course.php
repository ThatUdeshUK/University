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

    public function getCourses()
    {
        $result = $this->db->query("select * from course");
        return DBUtils::getAssocArray($result);
    }

    public function getCourse($c_code)
    {
        $result = $this->db->query("select * from course where c_code = " . $c_code );
        return $result->fetch_assoc();
    }

    public function addCourse($name, $credit, $hours, $college, $prerequisite, $d_code)
    {
        if ($prerequisite)
            $sql = "insert into course (`name`, credit, hours, college, prerequisite, d_code) values ('". $name ."','". $credit ."','".
                $hours ."','". $college ."','". $prerequisite ."','". $d_code ."')";
        else
            $sql = "insert into course (`name`, credit, hours, college, d_code) values ('". $name ."','". $credit ."','". $hours ."','".
                $college ."','". $d_code ."')";
        $result = $this->db->query($sql);
        return $result;
    }

    public function updateCourse($c_code, $name, $credit, $hours, $college, $prerequisite, $d_code)
    {
        if ($prerequisite)
            $sql = "update course set `name` = '". $name ."', credit = '". $credit ."', hours = '". $hours."', college = '".
                $college  ."', prerequisite = '". $prerequisite ."', d_code = '". $d_code ."' where c_code = " . $c_code;
        else
            $sql = "update course set `name` = '". $name ."', credit = '". $credit ."', hours = '". $hours."', college = '".
                $college ."', prerequisite = NULL, d_code = '". $d_code ."' where c_code = " . $c_code;
        $result = $this->db->query($sql);
        return $result;
    }

    public function deleteCourse($c_code)
    {
        $sql = "delete from course where c_code = " . $c_code;
        $result = $this->db->query($sql);
        return $result;
    }
}
