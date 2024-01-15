<?php
    include_once "../includes/bot.php";
    $bot=new Bot();
    $update=$bot->reciveMessage();
    $chatID = $update["message"]["chat"]["id"];
    $usernametelegram=$update['message']['from']['username'];
    $reply=$update['message']['reply_to_message'];
    $_json=json_encode($update);
    $array=explode(" ", $update["message"]['text']);
    $message="";
    if($update["message"]['chat']['type']==="private")
    {
        switch($array[0])
        {
            case "/start":
                $message= "Hola @".$usernametelegram.". Soy el Bot @impresiones3d_bot de la plataforma \nhttps://eacb2.duckdns.org/impresiones3d/telegram.php\nPuede comununicarse utilizadno los comandos:\n/vincular\n/stl\n";
                break;
            case "/vincular":
                if($bot->existUserTelegam($chatID)===true)
                {
                    $uic=$bot->userIsConfirmatedUserTelegram($usernametelegram);
                    $username=$bot->getUserNameByUserNameTelegram($usernametelegram);
                    if($uic===true)
                        $message="Ya se encuentra registrado con el usuario ".$username;
                    else
                        $message="Ya se encuentra en proceso de verificación el usuario ".$username;
                }
                else
                {
                    function regAndMess($bot,$usernametelegram,$chatID,$username)
                    {
                        $resp=$bot->registerUserTelegram($usernametelegram,$chatID,$username);
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
            case "/add_stl":
                if($bot->existUserTelegam($chatID)===true)
                {
                    if(isset($reply) && isset($reply['document']))
                    {
                        
                        if(pathinfo($reply['document']['file_name'], PATHINFO_EXTENSION ) == "stl")
                        {
                            if(!$bot->userIsFullFilesByChatID($chatID))
                            {
                                if($bot->existFile($reply['document']['file_id']))
                                    $message="Ya este fichero ha sido vinculado a una cuenta";
                                else if($bot->addFileByChatID($chatID,$reply['document']['file_id'],$reply['document']["file_name"]))
                                    $message="Agregado fichero STL Correctamente\n".$bot->getCountFilesByChatID($chatID)."/".$bot->getMaxCountFiles();
                                else
                                    $message="No se ha agregado el fichero";
                            }
                            else
                                $message="Ha superado el máximo de ficheros, libere alguno\n\n /eliminar_stl";
                            
                        }
                        else
                            $message="Documento no recibido, utilize extensión STL";
                    }
                    else
                        $message="Use el comando /add_stl cuando suba el fichero STL y haga referencia al mismo en el chat";
                }
                else
                    $message="Primero debe vincular la cuenta \n\n/vincular";
                break;
            case "/stl":
                $message= "Comandos para trabajar con ficheros STL\n/add_stl\n/show_stl\n";
                break;
            case "/show_stl":
                if($bot->existUserTelegam($chatID)===true)
                {
                    $message="Ficheros STL\n";
                    $files=$bot->getFilesNameByChatID($chatID);
                    foreach ($files as $row)
                        $message .= $row['file_name']."\n";
                    
                    
                }
                else
                    $message="Primero debe vincular la cuenta \n\n/vincular";
                break;
            default:
                // if(strpos($array[0],"/del")!==false)
                // {
                //     $id=explode("/del_", $array[0])[0];
                //     if(is_numeric($id) && $bot->deleteFile($id))
                //     {
                //         $message="Eliminando fichero correctamente";
                //         break;
                //     }
                // }
                if (isset($update['message']['text'])) 
                    $message="Mensaje Recibido";
                elseif (isset($update['message']['document']))
                    $message="Documento Recibido";
                else 
                    $message="Recibido";
                
                break;
        }
    }
    else if($update["message"]['chat']['type']==="group")
    {
        if($chatID==$bot->getGroupUploadFiles())
            $message="Admin Group";
        else
        $message="Solo se puede interactuar con el bot en chats privados";
    }
    else
        $message="Solo se puede interactuar con el bot en chats privados";
    Bot::log($_json);
    $bot->sendMessage($chatID,$message);
?>
