<?php 
    include_once "bot.php";
    $bot=new Bot();
    if(!$bot->existSessionUser())
    {
        header("Location: ../home.php");
        exit;
    }
    if(isset($_POST["cancel_id"]))
    {
        $id=$_POST["cancel_id"];
        if($bot->fileBelongToUser($id,$bot->getDataSession('user')))
        {
            if($bot->cancelFile($id))
            {
                header('Location: ../home.php?cancel_file=OK');
                exit;
            }
        }    
        header('Location: ../home.php?cancel_file=BAD');
    }
?>