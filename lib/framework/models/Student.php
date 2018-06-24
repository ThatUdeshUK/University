<?php

namespace framework\models;

use framework\util\DBUtils;

class Student
{
    private $db;

    public function __construct(\mysqli $db)
    {
        $this->db = $db;
    }

    public function getUGStudents()
    {
        $result = $this->db->query("select * from student AS s INNER JOIN undergraduate_student AS ug ON s.s_id = ug.s_id");
        return DBUtils::getAssocArray($result);
    }

    public function getGStudents()
    {
        $result = $this->db->query("select * from student AS s INNER JOIN graduate_student AS g ON s.s_id = g.s_id");
        return DBUtils::getAssocArray($result);
    }

    public function getNMStudents()
    {
        $result = $this->db->query("select * from student AS s INNER JOIN non_matriculating_student AS nm ON s.s_id = nm.s_id");
        return DBUtils::getAssocArray($result);
    }

    public function getUGStudent($s_id)
    {
        $result = $this->db->query("select * from student AS s INNER JOIN undergraduate_student AS ug ON s.s_id = ug.s_id where ug.s_id = " . $s_id );
        return $result->fetch_assoc();
    }

    public function getGStudent($s_id)
    {
        $result = $this->db->query("select * from student AS s INNER JOIN graduate_student AS g ON s.s_id = g.s_id where g.s_id = " . $s_id );
        return $result->fetch_assoc();
    }

    public function getNMStudent($s_id)
    {
        $result = $this->db->query("select * from student AS s INNER JOIN non_matriculating_student AS nm ON s.s_id = nm.s_id where nm.s_id = " . $s_id );
        return $result->fetch_assoc();
    }

    public function addUGStudent($name, $address, $status)
    {
        $sql = "insert into student (`name`, address, status) values ('". $name ."','". $address ."','". $status ."')";
        $result = $this->db->query($sql);
        if ($result) {
            $last_id = $this->db->insert_id;
            $sql = "insert into undergraduate_student values ('". $last_id ."')";
            $result = $this->db->query($sql);
        }
        return $result;
    }

    public function addGStudent($name, $address, $status, $ug_major)
    {
        $sql = "insert into student (`name`, address, status) values ('". $name ."','". $address ."','". $status ."')";
        $result = $this->db->query($sql);
        if ($result) {
            $last_id = $this->db->insert_id;
            $sql = "insert into graduate_student values ('". $last_id ."','". $ug_major ."')";
            $result = $this->db->query($sql);
        }
        return $result;
    }

    public function addNMStudent($name, $address, $status, $study_hours)
    {
        $sql = "insert into student (`name`, address, status) values ('". $name ."','". $address ."','". $status ."')";
        $result = $this->db->query($sql);
        if ($result) {
            $last_id = $this->db->insert_id;
            $sql = "insert into non_matriculating_student values ('". $last_id ."','". $study_hours ."')";
            $result = $this->db->query($sql);
        }
        return $result;
    }

    public function updateUGStudent($s_id, $name, $address, $status)
    {
        $sql = "update student set `name` = '". $name ."', address = '". $address ."', status = '". $status ."' where s_id = " . $s_id;
        $result = $this->db->query($sql);
        return $result;
    }

    public function updateGStudent($s_id, $name, $address, $status, $ug_major)
    {
        $sql = "update student set `name` = '". $name ."', address = '". $address ."', status = '". $status ."' where s_id = " . $s_id;
        $result = $this->db->query($sql);
        if ($result) {
            $sql = "update graduate_student set ug_major = '". $ug_major ."' where s_id = " . $s_id;
            $result = $this->db->query($sql);
        }
        return $result;
    }

    public function updateNMStudent($s_id, $name, $address, $status, $study_hours)
    {
        $sql = "update student set `name` = '". $name ."', address = '". $address ."', status = '". $status ."' where s_id = " . $s_id;
        $result = $this->db->query($sql);
        if ($result) {
            $sql = "update non_matriculating_student set study_hours = '". $study_hours ."' where s_id = " . $s_id;
            $result = $this->db->query($sql);
        }
        return $result;
    }

    public function deleteStudent($s_id)
    {
        $sql = "delete from student where s_id = " . $s_id;
        $result = $this->db->query($sql);
        return $result;
    }

}
