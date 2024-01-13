<?php 
    include_once "bot.php";
    $bot=new Bot();
    if(!$bot->existSessionUser())
    {
        header("Location: ../home.php");
        exit;
    }
    if(isset($_POST["request_id"]))
    {
        $id=$_POST["request_id"];
        $message=$_POST["message"];
        if($bot->fileBelongToUser($id,$bot->getDataSession('user')))
        {   
            if($bot->setRequestFile($id,$message))
            {
                $file_name=$bot->getFileNameByID($id);
                $bot->sendMessageTelegramToUser(
                    $bot->getDataSession('user'),
                    "Se ha solicitado un fichero "
                    .$file_name.
                    ", la respuesta toma en llegar de 1 a 3 días"
                );
                $bot->sendMessage(
                    $bot->getGroupUploadFiles(),
                    "Solicitud de fichero\nFile: "
                    .$file_name."\nUsuario: @"
                    .$bot->getDataSession('user')
                    .($bot->getDataSession('usernametelegram')?"\nTelegram: @".$bot->getDataSession('usernametelegram'):"")
                    ."\nContacto: ".$bot->getDataSession('validation_data'));
                header('Location: ../home.php?request_file=OK');
                exit;
            }
        }    
        header('Location: ../home.php?request_file=BAD');
    }
?>