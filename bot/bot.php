<?php
    include_once "../includes/bot.php";
    session_start();
    $bot=new Bot();
    $update=$bot->reciveMessage();
    $chatID = $update["message"]["chat"]["id"];
    $usernametelegram=$update['message']['from']['username'];
    $reply=$update['message']['reply_to_message'];
    $_json=json_encode($update);
    $array=explode(" ", $update["message"]['text']);
    $message="...";
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
                function regAndMess($bot,$usernametelegram,$chatID,$username)
                {
                    $resp=$bot->registerUser($usernametelegram,$chatID,$username);
                    if($resp===true)
                        return "Usuario confirmado. Continue en proceso de registro en la plataforma";
                    else if ($resp===null)
                        return "No existe el usuario: ".$username." en la paltaforma";
                    else    
                        return "Ha ocurrido un error en el proceso :(";
                }
                if(count($array)==2)
                    $message=regAndMess($bot,$usernametelegram,$chatID,$array[1]);   
                else if(isset($reply) && count(explode(" ",$reply['text']))===1)
                    $message=regAndMess($bot,$usernametelegram,$chatID,$reply['text']);
                else 
                    $message="Escriba el comando /vincular seguido del nombre de usuario de la paltaforma, o haga referencia al mismo en el chat \nEjemplo: /vincular usuario";
            }
            break;
        case "/stl":
            if(isset($update['message']['document']) || isset($reply) && isset($reply['document']))
            {
                $message="Documento STL Recibido";
            }
            else
                $message="Use el comando /stl cuando suba el fichero STL o haga referencia al mismo en el chat";
            break;
        default:
            if (isset($update['message']['text'])) 
                $message="Mensaje Recibido";
            elseif (isset($update['message']['document']))
                $message="Documento Recibido";
            else 
                $message="Recibido";
            
            break;
    }
    $message=str_replace("\n", rawurlencode("\n"), $message);
    $message=str_replace("[", rawurlencode("["), $message);
    $message=str_replace("]", rawurlencode("]"), $message);
    $message=str_replace("(", rawurlencode("("), $message);
    $message=str_replace(")", rawurlencode(")"), $message);
    $bot->sendMessage($chatID,$message.$_json);
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
