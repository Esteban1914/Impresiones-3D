<?php 
    if(isset($_POST['filament_id']) && isset($_POST['color_id']) )
    {
        
        include_once "bot.php";
        $bot=new Bot();
        if($bot->userIsAdmin())
        {
            if($bot->addFilamentColorFilament($_POST['filament_id'],$_POST['color_id']))
                header("Location: ../views/admin/filament_colors.php?filament_id=".$_POST['filament_id']."&add_filament_color=OK");
            else
                header("Location: ../views/admin/filament_colors.php?add_filament_color=BAD");
        }
    }
?>