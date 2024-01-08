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
                header('Location: ../home.php?request_file=OK');
                exit;
            }
        }    
        header('Location: ../home.php?request_file=BAD');
    }
?>