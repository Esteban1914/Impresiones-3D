<?php
    include_once "../includes/bot.php";
    $bot=new Bot();
    $update=$bot->reciveMessage();
    $chatID = $update["message"]["chat"]["id"];
    $username=$update['message']['from']['username'];
    $usernameid=$update['message']['from']['id'];
    function get_msg_default()
    {   return "Bot @eacb2_bot%0AComandos válidos:%0A/vincular%0A/ingresar"; }
    switch($update["message"]['text'])
    {
        case "/vincular":
            if($bot->existUser($usernameid))
            {
                $message="Hola @".$username.". Ya este usuario se encuentra registrado en [impresiones3d](https://eacb2.duckdns.org/impresiones3d/impresiones3d.php)";
            }
            else
            {
                $message="Hola @".$username.". Usuario no registrado. /ingresar al sistema?";
                session_start();
                $_SESSION['last_msg']="/vincular";
            }
            break;
        case "/ingresar":
            session_start();
            if(isset($_SESSION['last_msg']) && $_SESSION['last_msg']=="/vincular")
            {
                $message="Vinculando";
            }
            else
                $message= "Primero debe ser ejecutado el comando /vincular%0A%0A".get_msg_default();
            break;
        default:
            $message= get_msg_default();
            break;
    }
    $bot->sendMessage($chatID,$message);
/*
ok	true
result	
    0	
        update_id	481154846
        message	
            message_id	72
            from	
                id	1033479354
                is_bot	false
                first_name	"Esteban"
                last_name	"Acevedo"
                username	"EstebanACB2"
                language_code	"es"
            chat	
                id	1033479354
                first_name	"Esteban"
                last_name	"Acevedo"
                username	"EstebanACB2"
                type	"private"
            date	1703978825
            text	"/start_link"
            entities	
            0	
                offset	0
                length	11
                type	"bot_command"
*/
?>
