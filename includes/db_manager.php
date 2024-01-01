<?php
include_once 'db.php';
class DB_Manager extends DB
{
    //private $username,$password;
 
    public function __construct()
    {
        parent::__construct();
        if(session_status() === PHP_SESSION_NONE) 
            session_start();
    }
    public function registerUser($username, $password)
    {
        $query=$this->connect()->prepare('INSERT INTO users (username,password) VALUES (:u,:p)');
        if($query->execute(['u'=> $username , 'p' => md5($password)]))
            return true;
        return false;
    }
    public function userExistForLogin($u,$p)
    {
        
        $query=$this->connect()->prepare('SELECT * FROM users WHERE username=:u AND password=:p');
        $query->execute(['u'=> $u , 'p' => md5($p)]);
        if($query->rowCount())
            return true;
        return false;
    }
    public function userExist($u)
    { 
        $query=$this->connect()->prepare('SELECT id FROM users WHERE username=:u');
        $query->execute(['u'=> $u]);
        if($query->rowCount())
            return true;
        return false;
    }
    public function getUserNameTelegram($u)
    {
        $sql="SELECT user_telegram.username FROM user_telegram LEFT JOIN users ON user_telegram.user_id=users.id WHERE users.username=:u";
        $query=$this->connect()->prepare($sql);
        $query->execute(['u'=> $u]);
        if($query->rowCount())
            return $query->fetch(PDO::FETCH_ASSOC)["username"];
        return "";
    }
    public function setUserSession($un,$unt="")
    {
        $_SESSION['user']=$un;
        $_SESSION['usernametelegram']=$unt;
        
    }
    public function getCurrentUser()
    {
        return $_SESSION['user'];
    }
    public function close()
    {
        session_unset();
        session_destroy();
    }
}

?>