<?php
    if (isset($_FILES['file'])) 
    {
        include_once "bot.php";
        $bot= new Bot();
        $target_dir = "./";
        $target_file = $target_dir . basename($_FILES["file"]["name"]);
        move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);

        $data = array(
            'chat_id' => $bot->getGroupUploadFiles(),
            'document' => new CURLFile($target_file)
        );
        $response=$bot->sendCommnadPOSTFile("sendDocument",$data);
        //unlink($target_file);
        if($response['ok']===true && $bot->setFileByUserName($_SESSION["user"],$response['result']['document']['file_id'],basename($_FILES["file"]["name"])))
            header("Location: ../home.php?upload_file=OK");
        else
            header("Location: ../home.php?upload_file=BAD");
    }
?>
