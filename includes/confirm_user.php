<?php
    include_once "includes/bot";
    $bot=new Bot();
    if (isset($_POST['confirm']))
    {
        if($bot->userIsConfirmated($_SESSION['user'])===false)
        {
            if($bot->userConfirm($_SESSION['usernametelegram']))
            {
                $chatID=$bot->getChatIDByUsernametelegram($_SESSION['usernametelegram']);
                $bot->sendMessage($chatID,"Has sido vinculado correctamente a la cuanta @".$_SESSION['usernametelegram']."\nhttps://eacb2.duckdns.org/impresiones3d/telegram.php");
            }
        }
    } 
    else if (isset($_POST['cancel']))
    {
        if($bot->userIsConfirmated($_SESSION['user'])===false)
        {
            if($bot->userNoConfirm($_SESSION['usernametelegram']))
            {
                $chatID=$bot->getChatIDByUsernametelegram($_SESSION['usernametelegram']);
                $bot->sendMessage($chatID,"Has ha cancelado la vinculación con la cuanta @".$_SESSION['usernametelegram']."\nhttps://eacb2.duckdns.org/impresiones3d/telegram.php");
                $_SESSION['usernametelegram']="";
            }
        }
    }
?>