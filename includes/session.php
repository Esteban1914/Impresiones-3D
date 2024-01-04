<?php

class Session{
    public function __construct()
    {
        $this->startSession();
    } 
    public function startSession()
    {
        if(session_status() === PHP_SESSION_NONE) 
        {
            $time=86400;    //24h
            session_set_cookie_params($time);
            session_start();
            setcookie(session_name(), session_id(), time() + $time, '/');
        }
    }
    public function setDataSession($array_data)
    {
        foreach($array_data as $key => $value)
            $_SESSION[$key] = $value;
        
    }
    public function existDataSession($data)
    {
        return isset($_SESSION[$data]);
    }
}

?>