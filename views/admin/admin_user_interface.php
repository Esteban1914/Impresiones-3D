<?php 
    include_once '../../includes/login.php';
    include_once "../../includes/user.php";
    $user=new User();
    if($user->userIsAdmin())
        include "../_home_user.php";
?>