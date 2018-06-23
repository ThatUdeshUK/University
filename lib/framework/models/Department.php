<?php

namespace framework\models;

use framework\util\DBUtils;

class Department
{
    private $db;

    public function __construct(\mysqli $db)
    {
        $this->db = $db;
    }

    public function getDepartments()
    {
        $result = $this->db->query("select * from department");
        return DBUtils::getAssocArray($result);
    }

    public function getDepartment($d_code)
    {
        $result = $this->db->query("select * from department where d_code = " . $d_code );
        return $result->fetch_assoc();
    }

    public function addDepartment($name, $phone, $location, $head)
    {
        if ($head)
            $sql = "insert into department (d_name, phone, d_location, head) values ('". $name ."','". $phone ."','". $location ."','". $head ."')";
        else
            $sql = "insert into department (d_name, phone, d_location) values ('". $name ."','". $phone ."','". $location ."')";
        $result = $this->db->query($sql);
        return $result;
    }

    public function updateDepartment($code, $name, $phone, $location, $head)
    {
        echo $code . " " . $name . " " . $phone . " " . $location . " " . $head;
        if ($head)
            $sql = "update department set d_name = '". $name ."', phone = '". $phone ."', d_location = '". $location ."', head = ". $head ." where d_code = " . $code;
        else
            $sql = "update department set d_name = '". $name ."', phone = '". $phone ."', d_location = '". $location ."', head = NULL where d_code = " . $code;
        $result = $this->db->query($sql);
        return $result;
    }

    public function deleteDepartment($code)
    {
        $sql = "delete from department where d_code = " . $code;
        $result = $this->db->query($sql);
        return $result;
    }

}
