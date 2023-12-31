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
    public function existUser($chatID)
    {
        $conn=$this->connect();
        $sql="SELECT id FROM user_telegram WHERE chatid=:u";
        $query=$conn->prepare($sql);
        $query->execute([":u"=> $chatID]);
        if($query->rowCount()> 0)
            return true;
        return false;
        
    }
    // public function getUserNameByChatId($chatID)
    // {
    //     $conn=$this->connect();
    //     $sql="SELECT id FROM user_telegram WHERE chatid=:u";
    //     $query=$conn->prepare($sql);
    //     $query->execute([":u"=> $chatID]);
    //     if($query->rowCount()> 0)
    //         return true;
    //     return false;
        
    // }

    // public function getUserNameIDByChatId($chatID)
    // {
    //     $conn=$this->connect();
    //     $sql="SELECT id FROM user_telegram WHERE chatid=:u";
    //     $query=$conn->prepare($sql);
    //     $query->execute([":u"=> $chatID]);
    //     if($query->rowCount()> 0)
    //         return true;
    //     return false;
        
    // }

    public function registerUser($username,$chatID,$user_id)
    {
        $conn=$this->connect();
        $sql="INSERT INTO user_telegram (username,chatid, user_id) VALUES (:un,:chi,:ui)";
        $query=$conn->prepare($sql);
        if($query->execute([":un"=> $username ,"chi"=> $chatID, "ui"=> $user_id]))
            return true;
        return false;
    }
}
?>