<?php
    include_once "db_manager.php";
    $userManager=new DB_Manager;
    $userManager->close();
    echo "O";
    header("Location: ../impresiones3d.php");
?>