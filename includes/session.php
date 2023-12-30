<?php
    include_once 'user.php';
    $userManager=new User();
    if(isset($_SESSION['user']))
    {
        return; 
    }
    else if(isset($_POST['username']) && isset($_POST['password']))
    {
        if($userManager->userExist($_POST['username'],$_POST['password']))
        {
            $userManager->setCurrentUser($_POST['username']);
        }
        else
        {
            $errorLogin=true;
        }
    }
    include_once "views/_login.php";
    exit;
    
?>