<?php 
    include_once "bot.php";
    $bot=new Bot();
    if(!$bot->userIsAdmin())
    {
        header("Location: /impresiones3d/home.php");
        exit;
    }
    if(isset($_POST["color_id"])&&isset($_POST["filament_id"]))
    {
        if($bot->deleteFilamentColor($_POST["filament_id"],$_POST["color_id"]))
        {
            header('Location: ../views/admin/filament_colors.php?filament_id='.$_POST["filament_id"].'&delete_filament_color=OK');
            exit;
        }
        header('Location: ../views/admin/filament_colors.php?filament_id='.$_POST["filament_id"].'&delete_filament_color=BAD');
    }
?>