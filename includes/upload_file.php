<?php
    if (isset($_FILES['file'])) 
    {
        echo $_POST["filament"];
        echo $_POST["filament_color"];
        echo $_FILES["file"]["name"];
        exit;
        include_once "bot.php";
        $bot= new Bot();
        $target_file = "../tem_data/".$_FILES["file"]["name"];
        move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);

        $data = array(
            'chat_id' => $bot->getGroupUploadFiles(),
            'document' => new CURLFile($target_file),
            'caption' => 
                        "Usuario: @"
                        .$bot->getDataSession('user')
                        .($bot->getDataSession('usernametelegram')?"\nTelegram: @".$bot->getDataSession('usernametelegram'):"")
                        ."\nContacto: ".$bot->getDataSession('validation_data')
        );
        $response=$bot->sendCommnadPOSTFile("sendDocument",$data);
        //unlink($target_file);
        if($response['ok']===true && $bot->setFileByUserName($_SESSION["user"],$response['result']['document']['file_id'],$_FILES["file"]["name"]))
        {
            $id=$bot->getIDFileByFileID($response['result']['document']['file_id']);
            $file_info=pathinfo($_FILES["file"]["name"]);
            rename($target_file, "../tem_data/".$file_info['filename']."_".$id.".".$file_info['extension']);
            header("Location: ../home.php?upload_file=OK");
        }
       else
            header("Location: ../home.php?upload_file=BAD");
    }
    echo "Nada";
    exit;
?>
