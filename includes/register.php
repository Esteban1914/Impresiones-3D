<?php 
    if($_SERVER["REQUEST_METHOD"]=== 'POST')
    {
        if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['validation_type']) && isset($_POST['validation_data']))
        {
            
            include_once "bot.php";
            $bot=new Bot();
            if($_POST['validation_type']=="email")
            {    
                $apiKey = "cd0f40e95d6843abb188225988c17314"; 
                $response = file_get_contents("https://emailvalidation.abstractapi.com/v1?api_key=$apiKey&email=".$_POST['validation_data']);
                if($response!==false)
                {    
                    $data = json_decode($response, true);
                    if (!$data['is_smtp_valid']['value']) 
                    {
                        header ("Location: ../signin.php?signin=BAD_VALIDATION&method=".$_POST['validation_type']."&data=".$_POST['validation_data']);
                        exit();
                    }
                }
                else
                {
                    header ("Location: ../signin.php?signin=BAD");
                    exit();
                }
            }
            else
            {
                $apiKey = "96286f6055f84305b74a85b6c264c082"; 
                $response = file_get_contents("https://phonevalidation.abstractapi.com/v1/?api_key=$apiKey&phone=".$_POST['validation_data']);
                if($response!==false)
                {
                    $data = json_decode($response, true);
                    if (!$data['valid']) 
                    {
                        header ("Location: ../signin.php?signin=BAD_VALIDATION&method=".$_POST['validation_type']."&data=".$_POST['validation_data']);
                        exit();
                    }
                }
                else
                {
                    header ("Location: ../signin.php?signin=BAD");
                    exit();
                }
            }
            
            if($bot->registerUser($_POST["username"],$_POST["password"],$_POST['validation_type'],$_POST['validation_data']))
            {
                
                $bot->setUserSession($_POST["username"]);
                $bot->sendMessage(
                    $bot->getGroupUploadFiles(),
                    "Nuevo usuario registrado\nUsername: @"
                    .$bot->getDataSession('user')
                    ."\nContacto: ".$bot->getDataSession('validation_data'));    
                header ("Location: ../home.php?signin=OK");
                exit;
            }
            else{
                header ("Location: ../signin.php");
                exit;
            }

        }
    }
?>