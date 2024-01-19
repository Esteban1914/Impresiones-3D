<?php
    include_once "user.php";
    $user=new User;
    $user->closeSession();
    header("Location: /impresiones3d/impresiones3d.php");
?>