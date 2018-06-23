<?php

namespace framework\models;

use framework\util\DBUtils;

class Professor
{
    private $db;

    public function __construct(\mysqli $db)
    {
        $this->db = $db;
    }

    public function getProfessors()
    {
        $result = $this->db->query("select * from professor");
        return DBUtils::getAssocArray($result);
    }

    public function getProfessor($e_id)
    {
        $result = $this->db->query("select * from professor where e_id = " . $e_id );
        return $result->fetch_assoc();
    }

    public function addProfessor($name, $phone, $office, $d_code)
    {
        $sql = "insert into professor (p_name, phone, office, d_code) values ('". $name ."','". $phone ."','". $office ."','". $d_code ."')";
        $result = $this->db->query($sql);
        return $result;
    }

    public function updateProfessor($e_id, $name, $phone, $office, $d_code)
    {
        $sql = "update professor set p_name = '". $name ."', phone = '". $phone ."', office = '". $office ."', d_code = '". $d_code ."' where e_id = " . $e_id;
        $result = $this->db->query($sql);
        return $result;
    }

    public function deleteProfessor($e_id)
    {
        $sql = "delete from professor where e_id = " . $e_id;
        $result = $this->db->query($sql);
        return $result;
    }

}
