<?php
    include_once 'db_manager';
    $userManager=new DB_Manager();
    if(isset($_SESSION['user']))
    {
        return; 
    }
    else if(isset($_POST['username']) && isset($_POST['password']))
    {
        if($userManager->userExistForLogin($_POST['username'],$_POST['password']))
        {
            $usernametelegram=$userManager->getUserNameTelegram($_POST['username']);
            $userManager->setUserSession($_POST['username'],$usernametelegram);
            header("Location: ");
            return;
        }
        else
        {
            $errorLogin=true;
        }
    }
    include_once "views/_login.php";
    exit;
?>