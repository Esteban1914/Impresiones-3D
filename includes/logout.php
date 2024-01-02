<?php
    include_once "db_manager.php";
    $userManager=new DB_Manager;
    $userManager->closeSession();
    echo "O";
    header("Location: ../impresiones3d.php");
?>