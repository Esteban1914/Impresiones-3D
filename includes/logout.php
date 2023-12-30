<?php
    include_once "user.php";
    $userManager=new User;
    $userManager->close();
    echo "O";
    header("Location: ../impresiones3d.php");
?>