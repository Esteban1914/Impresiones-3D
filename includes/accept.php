<?php 
    include_once "bot.php";
    $bot=new Bot();
    if(!$bot->existSessionUser())
    {
        header("Location: ../home.php");
        exit;
    }
    if(isset($_POST["accept_id"]))
    {
        $id=$_POST["accept_id"];
        $message=$_POST["message"];
        if($bot->userIsAdmin())
        {   
            if($bot->setAcceptFile($id,$message))
            {
                $file_data=$bot->getFileInfoRequestByID($id);
                $bot->sendMessageTelegramToUser($bot->getDataSession('user'),"El fichero ".$file_data['file_name']." ha sido aceptado");
                $bot->sendMessage(
                    $bot->getGroupUploadFiles(),
                    "Aceptado de fichero\nFile: ".$file_data['file_name']
                    ."\nUsuario: @".$file_data['username']
                    .($file_data['usernametelegram']?"\nTelegram: @".$file_data['usernametelegram']:"")
                    ."\nAdminstrador: @".$file_data['usernameadmin']
                    .($file_data['adminnametelegram']?"\nTelegram Admin: @".$file_data['adminnametelegram']:"")
                );
                    header('Location: ../home.php?accept_request=OK');
                
                exit;
            }
        }    
        
    }
    header('Location: ../home.php?accept_request=BAD');
?>