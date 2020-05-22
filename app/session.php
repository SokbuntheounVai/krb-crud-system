<?php
// error_reporting(E_ALL);
// error_reporting(-1);
// ini_set('error_reporting', E_ALL);
class Session
{
    public static $username, $data;

    public function _contructor($username)
    {
        self::$username = $username;
    }

    public static function getUsername()
    {
        return self::$username;
    }

    public static function setUsername($username)
    {
        self::$username = $username;
    }

    public static function store_session($args)
    {
        session_start();
         foreach($args as $key => $value){
             $_SESSION[$key] = $value;
         }
    }

    public static function get_session($arg){
        return $_SESSION[$arg];
    }

    public static function clear_session(){
        session_start();
        session_destroy();
    }
}



