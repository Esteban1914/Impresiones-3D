<?php
    include_once "user.php";
    $user=new User;
    $user->closeSession();
    echo "O";
    header("Location: ../impresiones3d.php");
?>