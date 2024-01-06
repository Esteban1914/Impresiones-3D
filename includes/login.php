<?php
    include_once 'user.php';
    $user=new User();
    if($user->existSessionUser())
        return;
    else if(isset($_POST['username']) && isset($_POST['password']))
    {
        if($user->userExistForLogin($_POST['username'],$_POST['password']))
        {
            $usernametelegram=$user->getUserNameTelegram($_POST['username']);
            $user->setUserSession($_POST['username'],$usernametelegram);
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