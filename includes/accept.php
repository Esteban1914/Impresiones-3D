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
                header('Location: ../home.php?accept_request=OK');
                exit;
            }
        }    
        
    }
    header('Location: ../home.php?accept_request=BAD');
?>