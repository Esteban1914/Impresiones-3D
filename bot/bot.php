<?php
    include_once "../includes/bot.php";
    $bot=new Bot();
    $update=$bot->reciveMessage();
    $chatID = $update["message"]["chat"]["id"];
    $username=$update['message']['from']['username'];
    $usernameid=$update['message']['from']['id'];
    
    switch($update["message"]['text'])
    {
        case "/vincular":
            if($bot->existUser($usernameid))
            {
                $message="Ya este usuario se encuentra registrado en 
                [impresiones3d](https://eacb2.duckdns.org/impresiones3d/impresiones3d.php)
                 como
                ";
            }
            else
            {
                
                //$bot->registerUser($username,$chatID,);
                $message="";
            }
            break;
        default:
            $message= "Hola @".$username.". Bot @eacb2_bot%0AComandos válidos:%0A/vincular";
            break;
    }
    $t="";
    if (isset($_COOKIE["nombre_cookie"])) {
        $t=$_COOKIE["nombre_cookie"];
    } else {
        setcookie("nombre_cookie", "valor_cookie", time()+3600, "/");
    }
    
    $bot->sendMessage($chatID,$message."%0ALAST:".$t);
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
