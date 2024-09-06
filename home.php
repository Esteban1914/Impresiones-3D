<?php
    include_once 'includes/login.php';
    include_once "includes/user.php";
    $user=new User();
    
    if($user->userIsUser())
        header("Location: ./views/user/home.php?".$_SERVER['QUERY_STRING']);
    else if($user->userIsAdmin())
        header("Location: ./views/admin/home.php?".$_SERVER['QUERY_STRING']);
?>