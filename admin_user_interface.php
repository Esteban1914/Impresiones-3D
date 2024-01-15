<?php 
    include_once 'includes/login.php';
    include_once "includes/user.php";
    $user=new User();
    if($user->userIsAdmin())
        include "views/_home_user.php";
?>