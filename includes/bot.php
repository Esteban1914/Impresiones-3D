<?php 
    include_once "db.php";

    class Bot extends DB
    {
        private $token,$path;
        private $MAX_COUNT_FILES,$GROUP_UPLOAD_FILES;
        public function __construct()
        {
            parent::__construct();
            $this->MAX_COUNT_FILES=5;
            $this->GROUP_UPLOAD_FILES="-4000258594";
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
        public function getGroupUploadFiles()
        {
            return $this->GROUP_UPLOAD_FILES;
        }
        public function sendCommand($command)
        {
            return file_get_contents($this->path.$command);
        }
        public function sendCommnadPOSTFile($command,$data)
        {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL,  $this->path.$command);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            $response = curl_exec($ch);
            curl_close ($ch);
            return json_decode($response, true);
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
            $sql="SELECT id FROM user_telegram 
                    WHERE chatid=:u";
            $query=$conn->prepare($sql);
            $query->execute([":u"=> $chatID]);
            if($query->rowCount()> 0)
                return true;
            return false;
            
        }

        public function getUserIDByName($username)
        {
            $conn=$this->connect();
            $sql="SELECT id FROM users 
                    WHERE username=:un";
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
            $sql="SELECT user_id FROM user_telegram 
                    WHERE chatid=:chi";
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
            $sql="SELECT chatid FROM user_telegram 
                    WHERE username=:unt";
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
            $sql="SELECT users.username FROM users 
                    JOIN user_telegram ON users.id=user_telegram.user_id 
                    WHERE user_telegram.username=:unt";
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
            $sql="SELECT registered FROM user_telegram 
                    JOIN users ON user_telegram.user_id=users.id 
                    WHERE users.username=:u";
            $query=$conn->prepare($sql);
            $query->execute([":u"=>$username]);    
            if($query->rowCount()>0)        
                return (bool)$query->fetch(PDO::FETCH_ASSOC)["registered"];
            return null;
        }
        public function userIsConfirmatedUserTelegram($usernametelegram)
        {
            $conn=$this->connect();
            $sql="SELECT registered FROM user_telegram 
                    WHERE username=:u";
            $query=$conn->prepare($sql);
            $query->execute([":u"=>$usernametelegram]);    
            if($query->rowCount()>0)        
                return (bool)$query->fetch(PDO::FETCH_ASSOC)["registered"];
            return null;
        }

        
        // public function registerUser($username,$chatID,$user_name)
        // {
        //     $user_id=$this->getUserIDByName($user_name);
        //     if($user_id===false)
        //         return null;
        //     $conn=$this->connect();
        //     $sql="INSERT INTO user_telegram (username,chatid, user_id) 
        //             VALUES (:un,:chi,:ui)";
        //     $query=$conn->prepare($sql);
        //     if($query->execute([":un"=> $username ,"chi"=> $chatID, "ui"=> $user_id]))
        //         return true;
        //     return false;
        // }
        public function userConfirm($usernametelegram)
        {
            $conn=$this->connect();
            $sql="UPDATE user_telegram SET registered=:r 
                    WHERE username=:u";
            $query=$conn->prepare($sql);
            if($query->execute(["r"=> true,":u"=> $usernametelegram]))
                return true;
            return false;
        } 
        public function userDeleteConfirm($usernametelegram)
        {
            $conn=$this->connect();
            $sql="DELETE FROM user_telegram 
                    WHERE username=:u";
            $query=$conn->prepare($sql);
            if($query->execute([":u"=> $usernametelegram]))
                return true;
            return false;
        } 
        public function getCountFilesByChatID($chatID)
        {
            $conn=$this->connect();
            $sql="SELECT count_files FROM users 
                    JOIN user_telegram ON users.id=user_telegram.user_id 
                    WHERE chatid=:chi";
            $query=$conn->prepare($sql);
            if($query->execute([":chi"=> $chatID]))
                return $query->fetch(PDO::FETCH_ASSOC)["count_files"];
            return false;
        }
        public function getCountFilesByUserName($username)
        {
            $conn=$this->connect();
            $sql="SELECT count_files FROM users 
                    WHERE username=:un";
            $query=$conn->prepare($sql);
            if($query->execute([":un"=> $username]))
                return $query->fetch(PDO::FETCH_ASSOC)["count_files"];
            return false;
        }
        public function userIsFullFilesByChatID($chatID)
        {
            return $this->getCountFilesByChatID($chatID) >= $this->MAX_COUNT_FILES;
        }
        public function userIsFullFilesByUserName($username)
        {
            return $this->getCountFilesByUserName($username) >= $this->MAX_COUNT_FILES;
        }
        public function setFileByChatID($chatID, $file_id , $file_name)
        {
            $count_files=$this->getCountFilesByChatID($chatID);
            if($count_files >= $this->MAX_COUNT_FILES)
                return false;
            $conn=$this->connect();
            $user_id=$this->getUserIDByChatID($chatID);
            $sql="INSERT INTO files_telegram (file_id,user_id,file_name) 
                    VALUES (:fi,:ui,:fn)";
            $query=$conn->prepare($sql);
            if($query->execute([":fi"=> $file_id,":ui"=> $user_id, ":fn"=>$file_name ]))
            {        
                $sql="UPDATE users SET count_files = :c
                        WHERE id=:ui";
                $query=$conn->prepare($sql);
                return $query->execute([":c"=> $count_files+1,":ui"=> $user_id]);
            }
            return false;
        }
        public function setFileByUserName($username, $file_id,$file_name)
        {
            $count_files=$this->getCountFilesByUserName($username);
            if($count_files >= $this->MAX_COUNT_FILES)
                return false;
            $conn=$this->connect();
            $user_id=$this->getUserIDByName($username);
            $sql="INSERT INTO files_telegram (file_id,user_id,file_name) 
                    VALUES (:fi,:ui,:fn)";
            $query=$conn->prepare($sql);
            if($query->execute([":fi"=> $file_id,":ui"=> $user_id,":fn"=>$file_name]))
            {        
                $sql="UPDATE users SET count_files = :c
                        WHERE id=:ui";
                $query=$conn->prepare($sql);
                return $query->execute([":c"=> $count_files+1,":ui"=> $user_id]);
            }
            return false;
        }
        public function existFile($file_id)
        {
            $conn=$this->connect();
            $sql="SELECT id FROM files_telegram  
                    WHERE file_id=:fi";
            $query=$conn->prepare($sql);
            $query->execute([":fi"=> $file_id]);
            if($query->rowCount()>0)
                return true;
            return false;
        }
        // public function getIDFileByChatID($chatID)
        // {
        //     $conn=$this->connect();
        //     $sql="SELECT files_telegram.id FROM files_telegram 
        //             JOIN users ON files_telegram.user_id = users.id 
        //             JOIN user_telegram ON users.id = user_telegram.user_id 
        //             WHERE chatid=:chi";
        //     $query=$conn->prepare($sql);
        //     $query->execute([":chi"=> $chatID]);
        //     return $query->fetch(PDO::FETCH_ASSOC)['id'];
        // }
        public function getFilesNameByChatID($chatID)
        {
            $conn=$this->connect();
            $sql="SELECT files_telegram.file_name FROM files_telegram 
                    JOIN users ON files_telegram.user_id = users.id 
                    JOIN user_telegram ON users.id = user_telegram.user_id 
                    WHERE chatid=:chi";
            $query=$conn->prepare($sql);
            $query->execute([":chi"=> $chatID]);
            return $query->fetch(PDO::FETCH_ASSOC);
        }
        // public function getFilesInfo($chatID)
        // {
        //     $conn=$this->connect();
        //     $sql="SELECT file_id,files_telegram.id FROM files_telegram 
        //             JOIN users ON files_telegram.user_id = users.id 
        //             JOIN user_telegram ON users.id = user_telegram.user_id 
        //             WHERE chatid=:chi";
        //     $query=$conn->prepare($sql);
        //     $query->execute([":chi"=> $chatID]);
        //     return $query->fetchAll(PDO::FETCH_ASSOC);
        // }
        // public function getFileInfo($file_id)
        // {
        //     $response=file_get_contents("https://api.telegram.org/bot".$this->token."/getFile?file_id=".$file_id);
        //     return json_decode($response,true);  
        // }
        public function getFileNameByID($id)
        {
            $conn=$this->connect();
            $sql="SELECT file_name FROM files_telegram 
                    WHERE id=:id";
            $query=$conn->prepare($sql);
            $query->execute([":id"=> $id]);
            return $query->fetch(PDO::FETCH_ASSOC)['file_name'];
        }
        public function getFilesIDNameByUser($username)
        {
            $conn=$this->connect();
            $sql="SELECT file_name,files_telegram.id FROM files_telegram 
                    JOIN users ON files_telegram.user_id = users.id 
                    WHERE username=:un";
            $query=$conn->prepare($sql);
            $query->execute([":un"=> $username]);
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }
        // public function getFileIDsByUser($username)
        // {
        //     $conn=$this->connect();
        //     $sql="SELECT file_id,files_telegram.id FROM files_telegram 
        //             JOIN users ON files_telegram.user_id = users.id 
        //             WHERE username=:un";
        //     $query=$conn->prepare($sql);
        //     $query->execute([":un"=> $username]);
        //     return $query->fetchAll(PDO::FETCH_ASSOC);
        // }
        // public function deleteFile($id)
        // {
        //     $conn=$this->connect();
            
        //     $sql= "SELECT user_id FROM files_telegram WHERE id=:i";
        //     $query=$conn->prepare($sql);
        //     $query->execute(["i"=> $id]);
        //     if($query->rowCount()>0)
        //     {
        //         $user_id=$query->fetch(PDO::FETCH_ASSOC)['user_id'];
        //         $sql= "DELETE FROM files_telegram WHERE id=:i";
        //         $query=$conn->prepare($sql);
        //         if($query->execute(["i"=> $id]))
        //         {
        //             $sql="UPDATE users SET count_files = :c WHERE id=:ui";
        //             $query=$conn->prepare($sql);
        //             return $query->execute([":c"=> $count_files-1,":ui"=> $user_id]);
        //         }
        //     }
            
        // }
    }
?>