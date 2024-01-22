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
        if($bot->deleteFilamentColor($_POST["delete_id"]))
        {
            header('Location: ../views/admin/colors.php?delete_filament=OK');
            exit;
        }
        header('Location: ../views/admin/colors.php?delete_filament=BAD');
    }
?>