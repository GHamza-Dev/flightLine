<?php


class Auth{
    
    public function __construct($id,$username,$role = null){
        $_SESSION['logged'] = true;
        $_SESSION['id'] = $id;
        $_SESSION['username'] = $username;
        $_SESSION['role'] = $role;
    }

    private static function redirect($location){
        header('location:'.URLROOT.$location);
        exit;
    }

    private static function _404(){
        header("HTTP/1.0 404 Not Found");exit;
    }

    public static function check($role = false){
        if (!isset($_SESSION['logged']) || !$_SESSION['logged']){
            self::redirect("user/login");
        }

        if ($role && $_SESSION['role'] != $role) {
            self::_404();
        }
    }

}
