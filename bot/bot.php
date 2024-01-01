<?php
    include_once "../includes/bot.php";
    session_start();
    $bot=new Bot();
    $update=$bot->reciveMessage();
    $chatID = $update["message"]["chat"]["id"];
    $usernametelegram=$update['message']['from']['username'];
    $aa=json_encode($update);
    $array=explode(" ", $update["message"]['text']);
    switch($array[0])
    {
        case "/start":
            $message= "Hola @".$usernametelegram.". Soy el Bot @eacb2_bot de la plataforma \nhttps://eacb2.duckdns.org/impresiones3d/telegram.php\nPuede comununicarse utilizadno los comandos:\n/vincular";
            break;
        case "/vincular":
            if($bot->existUserTelegam($chatID)===true)
            {
                $uic=$bot->userIsConfirmatedUserTelegram($usernametelegram);
                $username=$bot->getUserNameByUserNameTelegram($usernametelegram);
                if($uic===true)
                    $message="Ya se encuentra registrado con el usuario @".$username;
                else
                    $message="Ya se encuentra en proceso de verificación el usuario @".$username;
            }
            else
            {
                if(count($array)==2)
                {
                    $username=$array[1];
                    $resp=$bot->registerUser($usernametelegram,$chatID,$username);
                    if($resp===true)
                        $message="Confirmada vinculación. Continue en proceso de registro en la plataforma";
                    else if ($resp===null)
                        $message="No existe el usuario: ".$username." en la paltaforma :|";
                    else    
                        $message="Ha ocurrido un error en el proceso :(";
                } 
                else 
                    $message="Escriba el comando /vincular seguido del nombre de usuario de la paltaforma, o haga referencia al mismo \nEjemplo: /vincular usuario";
            }
            break;
        default:
            $menssage="Recibido ".$aa;
            break;
    }
    $message=str_replace("\n", rawurlencode("\n"), $message);
    $message=str_replace("[", rawurlencode("["), $message);
    $message=str_replace("]", rawurlencode("]"), $message);
    $message=str_replace("(", rawurlencode("("), $message);
    $message=str_replace(")", rawurlencode(")"), $message);
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
