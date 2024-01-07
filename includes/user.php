<?php
include_once 'db.php';
class User extends DB
{
    //private $username,$password;
 
    public function __construct()
    {
        parent::__construct();
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
    public function userExistPassword($u,$p)
    { 
        $query=$this->connect()->prepare('SELECT id FROM users WHERE username=:u AND password=:p');
        $query->execute(['u'=> $u, ":p"=> md5($p)]);
        if($query->rowCount())
            return true;
        return false;
    }
    public function setUserSession($un,$unt="")
    {
        $this->setDataSession(
            array(
                    "user"=>$un,
                    "usernametelegram"=>$unt
                )
            );
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
    
    // public function getCurrentUser()
    // {
    //     return $_SESSION['user'];
    // }
    public function closeSession()
    {
        session_unset();
        session_destroy();
    }
    public function updateUserName($username,$newuername)
    {
        $sql="UPDATE users SET username=:nun WHERE username=:un";
        $query=$this->connect()->prepare($sql);
        return $query->execute(['nun'=> $newuername, "un"=> $username]);
    }
    public function updatePassWUser($username,$password)
    {
        $sql="UPDATE users SET password=:p WHERE username=:un";
        $query=$this->connect()->prepare($sql);
        return $query->execute([':un'=> $username, ":p"=> md5($password)]);
    }
    public function getUserRole()
    {
        $username=$this->getDataSession("user");
        $sql="SELECT role FROM users WHERE username=:un";
        $query=$this->connect()->prepare($sql);
        $query->execute([':un'=> $username]);
        if( $query->rowCount() > 0)
            return $query->fetch(PDO::FETCH_ASSOC)["role"];
    }
    public function userIsUser()
    {
        return $this->getUserRole()=="user";
    }
    public function userIsAdmin()
    {
        return $this->getUserRole()=="admin";
    }
    public function userIsDev()
    {
        return $this->getUserRole()=="dev";
    }
    
}

?>