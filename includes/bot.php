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
    }
    public function sendMessage($chatID,$msg)
    {
        file_get_contents($this->path."/sendmessage?chat_id=".$chatID."&text=".$msg);
    }
    public function reciveMessage()
    {
        return json_decode(file_get_contents("php://input"),true);
    }
}
?>