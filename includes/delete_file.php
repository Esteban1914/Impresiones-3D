<?php 
    include_once "bot.php";
    $bot=new Bot();
    if(!$bot->existSessionUser())
    {
        header("Location: /impresiones3d/home.php");
        exit;
    }
    if(isset($_POST["delete_id"]))
    {
        $id=$_POST["delete_id"];
        if($bot->fileBelongToUser($id,$bot->getDataSession('user')))
        {
            if($bot->deleteFile($id))
            {
                header('Location: /impresiones3d/home.php?delete_file=OK');
                exit;
            }
        }    
        header('Location: /impresiones3d/home.php?delete_file=BAD');
    }
?>