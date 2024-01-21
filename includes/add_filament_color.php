<?php 
    if(isset($_POST['filament'])&&isset($_POST['name']) && isset($_POST['color']) )
    {
        
        include_once "bot.php";
        $bot=new Bot();
        if($bot->userIsAdmin())
        {
            if($bot->addFilamentColor($_POST['filament'],$_POST['name'],$_POST['color']))
                header("Location: ../views/admin/filament_colors.php?add_filament_color=OK");
            else
                header("Location: ../views/admin/filament_colors.php?add_filament_color=BAD");
        }
    }
?>