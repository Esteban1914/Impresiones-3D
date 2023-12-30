<?php
include_once 'db.php';
class User extends DB
{
    private $username,$password;
 
    public function __construct()
    {
        parent::__construct();
        session_start();
    }
    public function userExist($u,$p)
    {
        $query=$this->connect()->prepare('SELECT * FROM users WHERE username=:u AND password=:p');
        $query->execute(['u'=> $u , 'p' => $p]);
        if($query->rowCount())
            return true;
        return false;
    }
    public function setCurrentUser($u)
    {
        $_SESSION['user']=$u;
    }
    public function getCurrentUser()
    {
        return $_SESSION['user'];
    }
    public function close()
    {
        session_abort();
        session_destroy();
    }
}

?>