<?php
    // $servername="localhost";
    // $username="root";
    // $password= "";

    ///////////////////////CONNECT///////////////////////
    // try {
    //     $conn = new PDO("mysql:host=$servername;", $username, $password);
    //     $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //     echo "CONNECTED -> OK<br>";
    // } catch(PDOException $e) {
    //     die ("Error:" . $e->getMessage());
    // }

    ///////////////////////CREATE DB///////////////////////
    // try {
    //     $sql = "CREATE DATABASE impresiones3D";
    //     $conn->exec($sql);
    //     echo "CREATED DB -> OK<br>";
    // } catch(PDOException $e) {
    //     die ("Error:" . $e->getMessage());
    // }
    

    ///////////////////////CONNECT DB///////////////////////
    // $conn->exec("USE impresiones3D");
    // echo "SELECT -> OK";
    
    ///////////////////////ALTER DB///////////////////////
    // $conn->exec("ALTER TABLE users CHANGE user_name username VARCHAR(50)");
    // echo "ALTER -> OK<br>";

    ///////////////////////CREATE TABLE///////////////////////
    // try {
    //     $sql = "CREATE TABLE users (
    //         id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    //         user_name VARCHAR(10) NOT NULL,
    //         password VARCHAR(255) NOT NULL,
    //         date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    //     )";
    //     $conn->exec($sql);
    //     echo "TABLE CREATED -> OK<br>";
    // } catch(PDOException $e) {
    //     die ("Error:" . $e->getMessage());
    // }
    

    ///////////////////////INSERT TABLE///////////////////////
    // $sql="INSERT INTO users (username,password) VALUES (:u,:p)";
    // $query=$conn->prepare($sql);
    // if($query->execute([":u"=> "esteban","p"=> "123456"]))
    //     echo "CREATED ESTEBAN -> OK<br>";
    // else
    //     echo "NO CREATED ESTEBAN -> X<br>";

?>