<?php

namespace framework\models;

class Auth
{
    private $db;

    public function __construct(\mysqli $db)
    {
        $this->db = $db;
    }

    public function authenticateUser($user, $pass) {
        $user = mysqli_escape_string($this->db, $user);
        $pass = mysqli_escape_string($this->db, $pass);
        $sql = "SELECT username, `type`, id FROM auth WHERE username = '$user' AND password = '$pass'";
        $result = $this->db->query($sql);
        if ($result)
            return $result->fetch_assoc();
    }
}
