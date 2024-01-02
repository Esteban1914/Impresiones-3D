<?php 
    include_once "db.php";

    class Bot extends DB
    {
        private $token,$path;
        private $MAX_COUNT_FILES;
        public function __construct()
        {
            parent::__construct();
            $this->MAX_COUNT_FILES=3;
            // $this->servername = getenv('DB_HOST');
            // $this->username = getenv('DB_USER');
            // $this->password=getenv('DB_PASSWORD');
            //if($this->password==" ")
            //    $this->password="";
            $this->token = getenv("DB_TELEGRAM_TOKEN");
            $this->path = "https://api.telegram.org/bot".$this->token."/";
        }
        // public function connect()
        // {
        //     try {
        //         $conn = new PDO("mysql:host=$this->servername;", $this->username, $this->password);
        //         $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
        //     } catch(PDOException $e) {
        //         die ("Error:" . $e->getMessage());
        //     }
        //     $conn->exec("USE impresiones3D");
        //     return $conn;
        // }
        public function getMaxCountFiles()
        {
            return $this->MAX_COUNT_FILES;
        }
        public function sendCommand($command)
        {
            return file_get_contents($this->path.$command);
        }
        public function sendCommandJson($command,$context)
        {
            return file_get_contents($this->path.$command,false,$context);
        }
        public function sendMessage($chatID,$msg)
        {
            $this->sendCommand("sendmessage?chat_id=".$chatID."&text=".$msg);
            //file_get_contents($this->path."/sendmessage?chat_id=".$chatID."&text=".$msg);
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

        public function getUserIDByChatID($chatID)
        {
            $conn=$this->connect();
            $sql="SELECT user_id FROM user_telegram WHERE chatid=:chi";
            $query=$conn->prepare($sql);
            $query->execute([":chi"=> $chatID]);
            if($query->rowCount()> 0)
            {
                $row=$query->fetch(PDO::FETCH_ASSOC);
                return $row["user_id"];
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
        public function getCountFiles($chatID)
        {
            $conn=$this->connect();
            $user_id=$this->getUserIDByChatID($chatID);
            $sql="SELECT count_files FROM users WHERE id=:id";
            $query=$conn->prepare($sql);
            if($query->execute([":id"=> $user_id]))
                return $query->fetch(PDO::FETCH_ASSOC)["count_files"];
            return false;
        }
        public function userIsFullFilesByChatID($chatID)
        {
            return $this->getCountFiles($chatID) >= $this->MAX_COUNT_FILES;
        }

        public function setFile($chatID, $file_id)
        {
            $count_files=$this->getCountFiles($chatID);
            if($count_files >= $this->MAX_COUNT_FILES)
                return false;
            $conn=$this->connect();
            $user_id=$this->getUserIDByChatID($chatID);
            $sql="INSERT INTO files_telegram (file_id,user_id) VALUES (:fi,:ui)";
            $query=$conn->prepare($sql);
            if($query->execute([":fi"=> $file_id,":ui"=> $user_id]))
            {        
                $sql="UPDATE users SET count_files = :c WHERE id=:ui";
                $query=$conn->prepare($sql);
                return $query->execute([":c"=> $count_files+1,":ui"=> $user_id]);
            }
            return false;
        }
        public function existFile($file_id)
        {
            $conn=$this->connect();
            $sql="SELECT id FROM files_telegram  WHERE file_id=:fi";
            $query=$conn->prepare($sql);
            $query->execute([":fi"=> $file_id]);
            if($query->rowCount()>0)
                return true;
            return false;
        }
        public function getFilesNamesByChatID($chatID)
        {
            $conn=$this->connect();
            $user_id=$this->getUserIDByChatID($chatID);
            $sql= "SELECT file_id FROM files_telegram WHERE user_id=:ui";
            $query=$conn->prepare($sql);
            $query->execute([":ui"=> $user_id]);
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }
        public function getFileData($file_id)
        {
            $response=file_get_contents("https://api.telegram.org/bot".$this->token."/getFile?file_id=".$file_id);
            return json_decode($response,true);  
        }
    }
?>