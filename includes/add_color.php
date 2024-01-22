<?php 
    if(isset($_POST['name']) && isset($_POST['color']) )
    {
        
        include_once "bot.php";
        $bot=new Bot();
        if($bot->userIsAdmin())
        {
            if($bot->addFilamentColor($_POST['name'],$_POST['color']))
                header("Location: ../views/admin/colors.php?add_color=OK");
            else
                header("Location: ../views/admin/colors.php?add_color=BAD");
        }
    }
?>