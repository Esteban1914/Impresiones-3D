<?php
ini_set('display_errors', 'Off');    // Evita que los errores se muestren en la pantalla
error_reporting(E_ALL & ~E_NOTICE);  // Desactiva los avisos

class Session{
    public function __construct()
    {
        $this->startSession();
        $path = __DIR__ . "/../.env";
        if (!file_exists($path)) {
            die ("No .env file");
        }
        $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        foreach ($lines as $line) {
            if (strpos(trim($line), '#') === 0) {
                continue;
            }
            list($key, $value) = explode('=', $line, 2);
            $key = trim($key);
            $value = trim($value);
            putenv("$key=$value"); 
        }
        
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
    public function getDataSession($data)
    {
        return isset($_SESSION[$data])?$_SESSION[$data]: null ;
    }
    public function existSessionUser()
    {
        return $this->existDataSession('user');
    }
}

?>