<?php
    include_once "bot.php";
    session_start();
    $bot=new Bot();
    if (isset($_POST['confirm']))
    {
        if($bot->userIsConfirmated($_SESSION['user'])===false)
        {
            if($bot->userConfirm($_SESSION['usernametelegram']))
            {
                $chatID=$bot->getChatIDByUsernametelegram($_SESSION['usernametelegram']);
                $message="Has sido vinculado correctamente a la cuenta @".$_SESSION['user'];
                $message=str_replace("\n", rawurlencode("\n"), $message);
                
                $bot->sendMessage($chatID,$message);
            }
        }
    } 
    else if (isset($_POST['cancel']))
    {
        if($bot->userIsConfirmated($_SESSION['user'])===false)
        {
            $chatID=$bot->getChatIDByUsernametelegram($_SESSION['usernametelegram']);
            if($bot->userDeleteConfirm($_SESSION['usernametelegram']))
            {
                $message="Has ha cancelado la vinculación con la cuenta @".$_SESSION['user'];
                $message=str_replace("\n", rawurlencode("\n"), $message);
                $bot->sendMessage($chatID,$message);
                $_SESSION['usernametelegram']="";
            }
        }
    }
    else if (isset($_POST['desv']))
    {
        if($bot->userIsConfirmated($_SESSION['user'])===true)
        {
            $chatID=$bot->getChatIDByUsernametelegram($_SESSION['usernametelegram']);
            if($bot->userDeleteConfirm($_SESSION['usernametelegram']))
            {
                $message="Se ha desvinculado al usuario @".$_SESSION['user'];
                $message=str_replace("\n", rawurlencode("\n"), $message);
                $bot->sendMessage($chatID,$message);
                $_SESSION['usernametelegram']="";
            }
        }
    }
    header("Location: ../telegram.php");
?>