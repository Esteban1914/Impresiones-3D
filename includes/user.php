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
    public function getUserNameTelegram($u)
    {
        $sql="SELECT user_telegram.username FROM user_telegram LEFT JOIN users ON user_telegram.user_id=users.id WHERE users.username=:u";
        $query=$this->connect()->prepare($sql);
        $query->execute(['u'=> $u]);
        if($query->rowCount())
            return $query->fetch(PDO::FETCH_ASSOC)["username"];
        return "";
    }
    public function setCurrentUser($un,$unt)
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