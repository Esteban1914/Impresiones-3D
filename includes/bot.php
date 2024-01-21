<?php 
    include_once "user.php";

    class Bot extends User
    {
        private $token,$path;
        private $MAX_COUNT_FILES,$GROUP_UPLOAD_FILES;
        public function __construct()
        {
            parent::__construct();
            $this->MAX_COUNT_FILES=5;
            $this->GROUP_UPLOAD_FILES="-4114338928";
            // $this->servername = getenv('DB_HOST');
            // $this->username = getenv('DB_USER');
            // $this->password=getenv('DB_PASSWORD');
            //if($this->password==" ")
            //    $this->password="";
            $this->token = getenv("DB_TELEGRAM_TOKEN");
            $this->path = "https://api.telegram.org/bot".$this->token."/";
        }
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
            $msg=str_replace("\n", rawurlencode("\n"), $msg);
            $msg=str_replace("[", rawurlencode("["), $msg);
            $msg=str_replace("]", rawurlencode("]"), $msg);
            $msg=str_replace("(", rawurlencode("("), $msg);
            $msg=str_replace(")", rawurlencode(")"), $msg);
            $this->sendCommand("sendmessage?chat_id=".$chatID."&text=".$msg);
        }
        public function reciveMessage()
        {
            return json_decode(file_get_contents("php://input"),true);
        }
        public function existUserTelegam($chatID)
        {
            $conn=$this->connect();
            $sql="SELECT id FROM user_telegram 
                    WHERE chat_id=:u";
            $query=$conn->prepare($sql);
            $query->execute([":u"=> $chatID]);
            if($query->rowCount()> 0)
                return true;
            return false;
            
        }
        public function getUserIDByChatID($chatID)
        {
            $conn=$this->connect();
            $sql="SELECT user_id FROM user_telegram 
                    WHERE chat_id=:chi";
            $query=$conn->prepare($sql);
            $query->execute([":chi"=> $chatID]);
            if($query->rowCount()> 0)
            {
                $row=$query->fetchColumn();
                return $row["user_id"];
            }
            return false;
        }

        public function getChatIDByUsernametelegram($usernametelegram)
        {
            $conn=$this->connect();
            $sql="SELECT chat_id FROM user_telegram 
                    WHERE username=:unt";
            $query=$conn->prepare($sql);
            $query->execute([":unt"=> $usernametelegram]);
            if($query->rowCount()> 0)
            {
                $row=$query->fetchColumn();
                return $row["chat_id"];
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
                return $query->fetchColumn();
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
                return (bool)$query->fetchColumn();
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
                return (bool)$query->fetchColumn();
            return null;
        }

        
        public function registerUserTelegram($usernametelegram,$chatID,$user_name)
        {
            
            $user_id=$this->getUserIDByName($user_name);
            if($user_id===false)
                return null;
            $conn=$this->connect();
            $sql="INSERT INTO user_telegram (username,chat_id, user_id) 
                    VALUES (:un,:chi,:ui)";
            $query=$conn->prepare($sql);
            if($query->execute([":un"=> $usernametelegram ,"chi"=> $chatID, "ui"=> $user_id]))
                return true;
            return false;
        }
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
            // $sql="SELECT count_files FROM users 
            //         JOIN user_telegram ON users.id=user_telegram.user_id 
            //         WHERE chat_id=:chi";
            $sql="SELECT Count(*) FROM files 
                JOIN user_telegram ON files.user_id=user_telegram.user_id 
                WHERE chat_id=:chi";
            $query=$conn->prepare($sql);
            if($query->execute([":chi"=> $chatID]))
                return $query->fetchColumn();
            return false;
        }
        public function getCountFilesByUserName($username)
        {
            $conn=$this->connect();
            // $sql="SELECT count_files FROM users 
            //         WHERE username=:un";
            $sql="SELECT Count(*) FROM files 
                JOIN users ON users.id=files.user_id 
                WHERE users.username=:un";
            $query=$conn->prepare($sql);
            if($query->execute([":un"=> $username]))
                return $query->fetchColumn();
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
        public function addFileByChatID($chatID, $file_id , $file_name)
        {
            $count_files=$this->getCountFilesByChatID($chatID);
            if($count_files >= $this->MAX_COUNT_FILES)
                return false;
            $conn=$this->connect();
            $user_id=$this->getUserIDByChatID($chatID);
            $sql="INSERT INTO files (file_id,user_id,file_name) 
                    VALUES (:fi,:ui,:fn)";
            $query=$conn->prepare($sql);
            if($query->execute([":fi"=> $file_id,":ui"=> $user_id, ":fn"=>$file_name ]))
            {      
                return true;  
                // $sql="UPDATE users SET count_files = count_files + 1
                //         WHERE id=:ui";
                // $query=$conn->prepare($sql);
                // return $query->execute([":ui"=> $user_id]);
            }
            return false;
        }
        public function setFileByUserName($username, $file_id,$file_name,$filament_id,$filament_color_id)
        {
            $count_files=$this->getCountFilesByUserName($username);
            if($count_files >= $this->MAX_COUNT_FILES)
                return false;
            $conn=$this->connect();
            $user_id=$this->getUserIDByName($username);
            $sql="INSERT INTO files (file_id,user_id,file_name) 
                    VALUES (:fi,:ui,:fn)";
            $query=$conn->prepare($sql);
            if($query->execute([":fi"=> $file_id,":ui"=> $user_id,":fn"=>$file_name]))
            {
                $id=$this->getIDFileByFileID($file_id);  
                $sql="INSERT INTO file_requests (file_id,filament_id,filament_color_id) 
                    VALUES (:fid,:fi,:fci)";
                $query=$conn->prepare($sql);
                if($query->execute([":fid"=> $id,":fi"=> $filament_id,":fci"=>$filament_color_id]))
                    return true;  
            }
            return false;
        }
        public function getIDFileByFileID($file_id)
        {
            $conn=$this->connect();
            $sql="SELECT id FROM files 
                    WHERE file_id=:fi";
            $query=$conn->prepare($sql);
            if($query->execute([":fi"=> $file_id]))
                return $query->fetchColumn();
            return false;
        }
        public function existFile($file_id)
        {
            $conn=$this->connect();
            $sql="SELECT id FROM files  
                    WHERE file_id=:fi";
            $query=$conn->prepare($sql);
            $query->execute([":fi"=> $file_id]);
            if($query->rowCount()>0)
                return true;
            return false;
        }
        public function getFilesNameByChatID($chatID)
        {
            $conn=$this->connect();
            $sql="SELECT files.file_name FROM files 
                    JOIN user_telegram ON files.user_id = user_telegram.user_id 
                    WHERE user_telegram.chat_id=:chi";
            $query=$conn->prepare($sql);
            $query->execute([":chi"=> $chatID]);
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }
        public function getFileNameByID($id)
        {
            $conn=$this->connect();
            $sql="SELECT file_name FROM files 
                    WHERE id=:id";
            $query=$conn->prepare($sql);
            $query->execute([":id"=> $id]);
            return $query->fetchColumn();
        }
        public function getFileUserNameById($id)
        {
            $conn=$this->connect();
            $sql="SELECT username FROM users
                    JOIN files ON files.user_id=users.id 
                    WHERE files.id=:id";
            $query=$conn->prepare($sql);
            $query->execute([":id"=> $id]);
            return $query->fetchColumn();
        }
        public function getFileUserTelegramNameById($id)
        {
            $conn=$this->connect();
            $sql="SELECT username FROM user_telegram
                    RIGHT JOIN files ON files.user_id=user_telegram.user_id 
                    WHERE files.id=:id";
            $query=$conn->prepare($sql);
            $query->execute([":id"=> $id]);
            return $query->fetchColumn();
        }
        public function getFilesInfoByUser($username)
        {
            $conn=$this->connect();
            $sql="SELECT file_name,files.id,file_requests.state
                    FROM files 
                    JOIN users ON files.user_id = users.id
                    JOIN file_requests ON file_requests.file_id = files.id 
                    WHERE users.username=:un";
            $query=$conn->prepare($sql);
            $query->execute([":un"=> $username]);
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }
        public function getIDFilesByID($id)
        {
            $conn=$this->connect();
            $sql="SELECT file_id FROM files 
                    WHERE id=:id";
            $query=$conn->prepare($sql);
            $query->execute([":id"=> $id]);
            return $query->fetchColumn();
        }
        public function getFilesNameByID($id)
        {
            $conn=$this->connect();
            $sql="SELECT file_name FROM files 
                    WHERE id=:id";
            $query=$conn->prepare($sql);
            $query->execute([":id"=> $id]);
            return $query->fetchColumn();
        }
        public function getFileURLDownloadBase($url)
        {
            
        }
        public function getFileURLDownload($id,$folder=FALSE)
        {
            
            $file_name_cache=$this->getFilesNameByID($id);
            $file_info=pathinfo($file_name_cache);
            $file_name=$file_info['filename']."_".$id.".".$file_info['extension'];
            $url_access='/impresiones3d/tem_data/'.$file_name;
            $url_file=($folder?$folder:".")."/tem_data/".$file_name;
            if(!file_exists($url_file))
            {
                return null;
                $url_telegram=$this->getURLFileTelegramByID($id);
                $contenido = file_get_contents($url_telegram);
                if($contenido!==false)
                    file_put_contents($url_file, $contenido);
            }
            return $url_access;
 
        }
        public function sendMessageTelegramToUser($username,$msg)
        {
            $conn= $this->connect();
            $sql="SELECT chat_id FROM user_telegram
                    LEFT JOIN users ON user_telegram.user_id=users.id
                    WHERE users.username=:un";
            $query=$conn->prepare($sql);
            $query->execute([":un"=> $username]);
            $chat_id=$query->fetchColumn();
            if($chat_id)
                $this->sendMessage($chat_id,$msg);
            return false;

        } 
        public function getURLFileTelegramByID($id)
        {
            $file_id=$this->getIDFilesByID($id);
            $response=file_get_contents("https://api.telegram.org/bot".$this->token."/getFile?file_id=".$file_id);
            $file_path=json_decode($response,true)['result']['file_path'];
            return "https://api.telegram.org/file/bot".$this->token."/".$file_path;
        }
        public function fileBelongToUser($id_file,$username)
        {
            $conn=$this->connect();
            $sql="SELECT username FROM users
                    JOIN files ON files.user_id=users.id
                    WHERE files.id=:id";
            $query=$conn->prepare($sql);
            $query->execute([":id"=> $id_file]);
            return $query->fetchColumn()==$username;
        }
        public function deleteFile($id)
        {
            $conn=$this->connect();
            $sql="DELETE FROM files
                WHERE id=:id";
            $query=$conn->prepare($sql);
            if($query->execute([":id"=> $id]))
                return true;
            return false;
            
        }
        public function deleteFilament($id)
        {
            $conn=$this->connect();
            $sql="DELETE FROM filament
                WHERE id=:id";
            $query=$conn->prepare($sql);
            if($query->execute([":id"=> $id]))
                return true;
            return false;
            
        }
        
        // public  function getFileStatus($id)
        // {
        //     $conn=$this->connect();
        //     $sql="SELECT file_requests.file_id,files.file_name,
        //             FROM file_requests 
        //             JOIN files ON files.id=file_requests.file_id
        //             WHERE files.id=:id";
        //     $query=$conn->prepare($sql);
        //     $query->execute([":id"=> $id]);
        //     $resp=$query->fetch();
        //     if($query->rowCount()>0 )    
        //     {
        //         if($resp['completed']==true)
        //         {
        //         $sql="SELECT state FROM file_requests 
        //             JOIN files_users_requests ON file_requests.user_request_id=files_users_requests.id
        //             WHERE files_users_requests.id=:id";
        //         $query=$conn->prepare($sql);
        //         $query->execute([":id"=> $resp['id']]);
        //         return $query->fetchColumn();
        //         }
        //         return "p";
        //     }
        //     return "n";
        // }
        public function setRequestFile($id,$message)
        {
            $user_id=$this->getUserIDByName($this->getDataSession('user'));
            $conn=$this->connect();
            $sql="INSERT INTO files_users_requests (message,user_id,file_id)
                    VALUES (:m,:ui,:id)";
            $query=$conn->prepare($sql);
            return $query->execute([":m"=>$message,":ui"=>$user_id,":id"=> $id]);
            
        }
        public function cancelFile($id)
        {
            
            $conn=$this->connect();
            $sql="DELETE FROM files_users_requests
                    WHERE file_id=:id";
            $query=$conn->prepare($sql);
            return $query->execute([":id"=> $id]);
            
        }
        public function getCountUsers()
        {
            $conn=$this->connect();
            $sql="SELECT Count(*) FROM users";
            $query=$conn->prepare($sql);
            if ($query->execute())
                return $query->fetchColumn();
        }
        public function getCountRequest()
        {
            $conn=$this->connect();
            $sql="SELECT Count(*) FROM file_requests 
                                WHERE state IS NULL";
            $query=$conn->prepare($sql);
            if ($query->execute())
                return $query->fetchColumn();
        }
        public function getCountAccept()
        {
            $conn=$this->connect();
            $sql="SELECT Count(*) FROM file_requests 
                                WHERE state = 'ACCEPT'";
            $query=$conn->prepare($sql);
            if ($query->execute())
                return $query->fetchColumn();
        }
        public function getCountDenied()
        {
            $conn=$this->connect();
            $sql="SELECT Count(*) FROM file_requests 
                                WHERE state = 'DENIED'";
            $query=$conn->prepare($sql);
            if ($query->execute())
                return $query->fetchColumn();
        }
        public function getCountCompleted()
        {
            $conn=$this->connect();
            $sql="SELECT Count(*) FROM file_requests 
                                WHERE state = 'COMPLETED'";
            $query=$conn->prepare($sql);
            if ($query->execute())
                return $query->fetchColumn();
        }
        
        public function getLastUsers($no_id)
        {
            $conn=$this->connect();
            $sql="SELECT users.id,users.username,role,data,type,user_telegram.username AS telegram_username FROM users 
                    JOIN user_validation ON users.id=user_validation.user_id 
                    LEFT JOIN user_telegram ON users.id=user_telegram.user_id
                    WHERE users.id != :nid 
                    ORDER BY users.date DESC 
                    LIMIT 5 
                    ";
            $query=$conn->prepare($sql);
            $query->execute([":nid"=> $no_id]);
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }
        public function getFilteredtUsers($no_id,$filter_username)
        {
            $conn=$this->connect();
            $sql="SELECT users.id,users.username,role,data,type,user_telegram.username AS telegram_username FROM users 
                    JOIN user_validation ON users.id=user_validation.user_id 
                    LEFT JOIN user_telegram ON users.id=user_telegram.user_id
                    WHERE users.id != :nid 
                    AND users.username LIKE :search
                    ORDER BY users.username DESC 
                    LIMIT 5 
                    ";
            $query=$conn->prepare($sql);
            $query->execute([":nid"=> $no_id,":search"=>"%".$filter_username."%"]);
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }
        public function getNewRequests()
        {
            $conn=$this->connect();
            $sql="SELECT file_requests.id,file_requests.file_id,users.username,files.file_name
                    FROM file_requests 
                    JOIN files ON file_requests.file_id=files.id
                    JOIN users ON files.user_id=users.id
                    WHERE state IS NULL 
                    ORDER BY file_requests.date ASC 
                    LIMIT 5 
                    ";
            $query=$conn->prepare($sql);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }
        public function getNewAccepts()
        {
            $conn=$this->connect();
            $sql="SELECT file_requests.id,file_requests.message, _username.username ,files.file_name, files.id AS file_id,_adminname.username AS adminname
                    FROM file_requests
                    JOIN files_users_requests ON file_requests.user_request_id=files_users_requests.id
                    JOIN files ON files.id= files_users_requests.file_id
                    JOIN users AS _username ON _username.id= files_users_requests.user_id
                    JOIN users AS _adminname ON _adminname.id= files_users_requests.user_id
                    WHERE file_requests.completed = false 
                    ORDER BY file_requests.date ASC 
                    LIMIT 5 
                    ";
            $query=$conn->prepare($sql);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }
        
        function fileIsRequest($file_id)
        {
            $conn=$this->connect();
            $sql="SELECT id 
                    FROM files_users_requests 
                    WHERE file_id = :id AND completed=FALSE
                    ";
            $query=$conn->prepare($sql);
            $query->execute([':id'=>$file_id]);
            return ($query->rowCount()>0);
        }
        public function getRequest($file_id)
        {
            $conn=$this->connect();
            $sql="SELECT files_users_requests.id,files_users_requests.message,users.username,files.file_name 
                    FROM files_users_requests 
                    JOIN users ON files_users_requests.user_id=users.id
                    JOIN files ON files_users_requests.file_id=files.id
                    WHERE files_users_requests.file_id = :id AND completed=FALSE
                    ";
            $query=$conn->prepare($sql);
            $query->execute([':id'=>$file_id]);
            return $query->fetch();
        }
        public function setAcceptFile($id_request_users,$message)
        {
            $conn=$this->connect();
            $sql="INSERT INTO file_requests (message,state,user_admin,user_request_id) 
                VALUES (:mes,:st,:ua,:urid)
            ";
            $query=$conn->prepare($sql);
            if($query->execute([":mes"=> $message,":st"=>'a',':ua'=>$this->getDataSession('id'),':urid'=>$id_request_users]))
            {
                $sql="UPDATE files_users_requests SET completed=TRUE
                    WHERE id=:idru";
                $query=$conn->prepare($sql);
                if($query->execute([":idru"=> $id_request_users]))
                    return true;
            }
            return false;
        }
        public function setDeniedFile   ($id_request_users,$message)
        {
            $conn=$this->connect();
            $sql="INSERT INTO file_requests (message,state,user_admin,user_request_id) 
                VALUES (:mes,:st,:ua,:urid)
            ";
            $query=$conn->prepare($sql);
            if($query->execute([":mes"=> $message,":st"=>'d',':ua'=>$this->getDataSession('id'),':urid'=>$id_request_users]))
            {
                $sql="UPDATE files_users_requests SET completed=TRUE
                    WHERE id=:idru";
                $query=$conn->prepare($sql);
                if($query->execute([":idru"=> $id_request_users]))
                    return true;
            }
            return false;
        }
        public function getFileInfoRequestByID($id)
        {
            $conn=$this->connect();
            $sql="SELECT files.file_name,_user.username,_usertelegram.username as usernametelegram,_admin.username as usernameadmin,_admintelegram.username as adminnametelegram
                    FROM file_requests 
                    JOIN files_users_requests ON files_users_requests.id=file_requests.user_request_id
                    JOIN files ON files_users_requests.file_id=files.id
                    JOIN users AS _user ON _user.id=files_users_requests.user_id
                    JOIN users AS _admin ON _admin.id=file_requests.user_admin
                    LEFT JOIN user_telegram AS _usertelegram ON files_users_requests.user_id=_usertelegram.user_id
                    LEFT JOIN user_telegram AS _admintelegram ON file_requests.user_admin=_admintelegram.user_id
                    WHERE file_requests.user_request_id = :id  
                    ";
            $query=$conn->prepare($sql);
            $query->execute([":id"=>$id]);
            return $query->fetch();
        }
        public function getFilaments()
        {
            $conn=$this->connect();
            $sql="SELECT id,name,price
                    FROM filament 
                    ";
            $query=$conn->prepare($sql);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } 
        public function getFilamentColors($filament_id)
        {
            $conn=$this->connect();
            $sql="SELECT filament_color.id,filament_color.name,filament_color.color
                    FROM filament_color
                    LEFT JOIN filament_color_relation ON filament_color_relation.color_id=filament_color.id 
                    LEFT JOIN filament ON filament.id=filament_color_relation.filament_id
                    WHERE filament.id=:fi
                    ";
            $query=$conn->prepare($sql);
            $query->execute([':fi'=>$filament_id]);
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }
        public function getFilamentNameByID($id)
        {
            $conn=$this->connect();
            $sql="SELECT name
                    FROM filament 
                    WHERE id=:id";
            $query=$conn->prepare($sql);
            $query->execute([':id'=>$id]);
            return $query->fetchColumn();
        }
        public function getFilamentColorNameByID($id)
        {
            $conn=$this->connect();
            $sql="SELECT name
                    FROM filament_color
                    WHERE id=:id";
            $query=$conn->prepare($sql);
            $query->execute([':id'=>$id]);
            return $query->fetchColumn();
        }
        public function getLastFilements()
        {
            $conn=$this->connect();
            $sql="SELECT *
                    FROM filament
                    ORDER BY filament.id DESC 
                    LIMIT 5
                    ";
            $query=$conn->prepare($sql);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }
        public function getFiltredFilements($name)
        {
            $conn=$this->connect();
            $sql="SELECT *
                    FROM filament
                    WHERE name LIKE :search
                    ORDER BY filament.id DESC 
                    LIMIT 5
                    ";
            $query=$conn->prepare($sql);
            $query->execute([":search"=>"%".$name."%"]);
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }
        public function addFilament($name,$price)
        {
            $conn=$this->connect();
            $sql="INSERT INTO filament (name,price) 
                    VALUES (:n,:p)";
            $query=$conn->prepare($sql);
            if($query->execute([":n"=> $name ,":p"=> $price]))
                return true;
            return false;
        } 
        public function addFilamentColor($filament_id,$name,$color)
        {
            $conn=$this->connect();
            $sql="INSERT INTO filament_color (name,color) 
                    VALUES (:n,:c)";
            $query=$conn->prepare($sql);
            if($query->execute([":n"=> $name ,":c"=> $color]))
            {
                $sql="SELECT id
                        FROM filament_color
                        WHERE name=:n";
                $query=$conn->prepare($sql);
                $query->execute([':n'=>$name]);
                if($query->rowCount()> 0)
                {
                    $id=$query->fetchColumn();
                    $sql="INSERT INTO  filament_color_relation (filament_id,color_id)
                            VALUES (:fid,:cid)";
                    $query=$conn->prepare($sql);
                    return $query->execute([':fid'=>$filament_id,":cid"=>$id]);   
                }
            }
            return false;
        } 
        

        public function getFiltredFilamentColors($filament_id,$name)
        {
            $conn=$this->connect();
            $sql="SELECT filament_color.name,filament_color.id
                    FROM filament_color
                    JOIN filament_color_relation ON filament_color.id=color_id
                    JOIN filament ON filament_color_relation.filament_id=filament.id
                    WHERE filament.id=:fid  AND filament_color.name LIKE :search
                    ORDER BY filament_color.id DESC 
                    LIMIT 5
                    ";
            $query=$conn->prepare($sql);
            $query->execute([":fid"=>$filament_id,":search"=>"%".$name."%"]);
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }
        public function getLastFilamentColor($filament_id)
        {
            $conn=$this->connect();
            $sql="SELECT filament_color.name,filament_color.id
                    FROM filament_color
                    JOIN filament_color_relation ON filament_color.id=color_id
                    JOIN filament ON filament_color_relation.filament_id=filament.id
                    WHERE filament.id=:fid 
                    ORDER BY filament_color.id DESC 
                    LIMIT 5 
                    ";
            $query=$conn->prepare($sql);
            $query->execute([':fid'=>$filament_id]);
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }
    }

    
    
?>