<?php 
    if(isset($_POST['name']) && isset($_POST['price']) )
    {
        
        include_once "bot.php";
        $bot=new Bot();
        if($bot->userIsAdmin())
        {
            if($bot->addFilament($_POST['name'],$_POST['price']))
                header("Location: ../views/admin/filaments.php?add_filament=OK");
            else
                header("Location: ../views/admin/filaments.php?add_filament=BAD");
        }
    }
?>