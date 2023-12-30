<?php
    include_once "../includes/bot.php";
    $bot=new Bot();
    $update=$bot->reciveMessage();
    $chatID = $update["message"]["chat"]["id"];
    $username=$update['message']['from']['username'];
    $usernameid=$update['message']['from']['id'];
    switch($update["message"]['text'])
    {
        case "/start_link":
            if($bot->existUser($usernameid))
            {
                $message="Hola @".$username." con ID ".$usernameid.". Ya este usuario se encuentra registrado";

            }
            else
            {
                $message="Hola @".$username.", ID:".$usernameid.". Usuario no registrado";
            }
            break;
        default:
            $message= "Comando Inválido:".$update["message"]['text'];
            break;
    }
    $bot->sendMessage($chatID,$message);
?>
