<?php 
class Bot
{
    private $servername,$username,$password,$token,$path;
    public function __construct()
    {
        $this->servername = getenv('DB_HOST');
        $this->username = getenv('DB_USER');
        $this->password=getenv('DB_PASSWORD');
        if($this->password==" ")
            $this->password="";
        $this->token = getenv("DB_TELEGRAM_TOKEN");
        $this->path = "https://api.telegram.org/bot".$this->token;
    }
    public function connect()
    {
        try {
            $conn = new PDO("mysql:host=$this->servername;", $this->username, $this->password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
        } catch(PDOException $e) {
            die ("Error:" . $e->getMessage());
        }
        $conn->exec("USE impresiones3D");
        return $conn;
    }
    public function sendMessage($chatID,$msg)
    {
        file_get_contents($this->path."/sendmessage?chat_id=".$chatID."&text=".$msg);
    }
    public function reciveMessage()
    {
        return json_decode(file_get_contents("php://input"),true);
    }
    public function existUserTelegam($chatID)
    {
        $conn=$this->connect();
        $sql="SELECT id FROM user_telegram WHERE chatid=:u";
        $query=$conn->prepare($sql);
        $query->execute([":u"=> $chatID]);
        if($query->rowCount()> 0)
            return true;
        return false;
        
    }

    public function getUserIDByName($username)
    {
        $conn=$this->connect();
        $sql="SELECT id FROM users WHERE username=:un";
        $query=$conn->prepare($sql);
        $query->execute([":un"=> $username]);
        if($query->rowCount()> 0)
        {
            $row=$query->fetch(PDO::FETCH_ASSOC);
            return $row["id"];
        }
        return false;
    }

    public function getChatIDByUsernametelegram($usernametelegram)
    {
        $conn=$this->connect();
        $sql="SELECT chatid FROM user_telegram WHERE username=:unt";
        $query=$conn->prepare($sql);
        $query->execute([":unt"=> $usernametelegram]);
        if($query->rowCount()> 0)
        {
            $row=$query->fetch(PDO::FETCH_ASSOC);
            return $row["chatid"];
        }
        return false;
    }
    public function getUserNameByUserNameTelegram($usernametelegram)
    {
        $conn=$this->connect();
        $sql="SELECT users.username FROM users LEFT JOIN user_telegram ON users.id=user_telegram.user_id WHERE user_telegram.username=:unt";
        $query=$conn->prepare($sql);
        $query->execute([":unt"=> $usernametelegram]);
        if($query->rowCount()> 0)
        {
            $row=$query->fetch(PDO::FETCH_ASSOC);
            return $row["username"];
        }
        return null;
    }
    public function userIsConfirmated($username)
    {
        $conn=$this->connect();
        $sql="SELECT registered FROM user_telegram LEFT JOIN users ON user_telegram.user_id=users.id WHERE users.username=:u";
        $query=$conn->prepare($sql);
        $query->execute([":u"=>$username]);    
        if($query->rowCount()>0)        
            return (bool)$query->fetch(PDO::FETCH_ASSOC)["registered"];
        return null;
    }
    public function userIsConfirmatedUserTelegram($usernametelegram)
    {
        $conn=$this->connect();
        $sql="SELECT registered FROM user_telegram WHERE username=:u";
        $query=$conn->prepare($sql);
        $query->execute([":u"=>$usernametelegram]);    
        if($query->rowCount()>0)        
            return (bool)$query->fetch(PDO::FETCH_ASSOC)["registered"];
        return null;
    }


    public function registerUser($username,$chatID,$user_name)
    {
        $user_id=$this->getUserIDByName($user_name);
        if($user_id===false)
            return null;
        $conn=$this->connect();
        $sql="INSERT INTO user_telegram (username,chatid, user_id) VALUES (:un,:chi,:ui)";
        $query=$conn->prepare($sql);
        if($query->execute([":un"=> $username ,"chi"=> $chatID, "ui"=> $user_id]))
            return true;
        return false;
    }
    public function userConfirm($usernametelegram)
    {
        $conn=$this->connect();
        $sql="UPDATE user_telegram SET registered=:r WHERE username=:u";
        $query=$conn->prepare($sql);
        if($query->execute(["r"=> true,":u"=> $usernametelegram]))
            return true;
        return false;
    } 
    public function userDeleteConfirm($usernametelegram)
    {
        $conn=$this->connect();
        $sql="DELETE FROM user_telegram WHERE username=:u";
        $query=$conn->prepare($sql);
        if($query->execute([":u"=> $usernametelegram]))
            return true;
        return false;
    } 
}
?>