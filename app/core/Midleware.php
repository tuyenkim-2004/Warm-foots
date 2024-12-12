<?php

class Middleware
{
    public static function checkAuth()
    {
        if (!isset($_SESSION['username'])) {
            header('Location: /user/login');
            exit;
        }
    }
}
