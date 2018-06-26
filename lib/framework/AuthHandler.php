<?php

namespace framework;

class AuthHandler
{
    public static function checkAuth()
    {
        if (!isset($_SESSION['user'])) {
            (new Router())->redirect('login');
        }
    }

    public static function checkSpecificAuth($type)
    {
        if (!isset($_SESSION['user']) || !(isset($_SESSION['type']) && $_SESSION['type'] == $type)) {
            (new Router())->redirect('');
        }
    }

    public static function checkMultiSpecificAuth($types)
    {
        $flag = false;
        foreach ($types as $type) {
            if (isset($_SESSION['user']) && isset($_SESSION['type']) && $_SESSION['type'] == $type) {
                $flag = true;
            }
        }
        if (!$flag)
            (new Router())->redirect('');
    }

    public static function checkLoginAuth()
    {
        if (isset($_SESSION['user'])) {
            (new Router())->redirect('');
        }
    }

    public static function isSpecificAuth($type)
    {
        return isset($_SESSION['user']) && isset($_SESSION['type']) && $_SESSION['type'] == $type;
    }

    public static function getCurrentID()
    {
        if (isset($_SESSION['user']) && isset($_SESSION['id']))
            return $_SESSION['id'];
        else
            return false;
    }

    public static function login($user)
    {
        $_SESSION['user'] = $user['username'];
        $_SESSION['type'] = $user['type'];
        $_SESSION['id'] = $user['id'];
    }


    public static function logout() {
        session_unset();
        session_destroy();
    }
}
