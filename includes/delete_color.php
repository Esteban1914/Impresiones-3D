<?php 
    include_once "bot.php";
    $bot=new Bot();
    if(!$bot->userIsAdmin())
    {
        header("Location: /impresiones3d/home.php");
        exit;
    }
    if(isset($_POST["delete_id"]))
    {
        if($bot->deleteColor($_POST["delete_id"]))
        {
            header('Location: ../views/admin/colors.php?delete_color=OK');
            exit;
        }
        header('Location: ../views/admin/colors.php?delete_color=BAD');
    }
?>