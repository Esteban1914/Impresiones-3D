<?php
    $servername="localhost";
    $username="root";
    $password= "";

    ///////////////////////CONNECT///////////////////////
    try {
        $conn = new PDO("mysql:host=$servername;", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "CONNECTED -> OK<br>";
    } catch(PDOException $e) {
        die ("Error:" . $e->getMessage());
    }
    
    // // ///////////////////////CREATE DB///////////////////////
    // try {
    //     $sql = "CREATE DATABASE impresiones3D";
    //     $conn->exec($sql);
    //     echo "CREATED DB -> OK<br>";
    // } catch(PDOException $e) {
    //     die ("Error:" . $e->getMessage());
    // }
    

    // // ///////////////////////CONNECT DB///////////////////////
    $conn->exec("USE impresiones3D");
    echo "SELECT -> OK<br>";
    
    
    // // ///////////////////////CREATE TABLE///////////////////////
    // try {
    // $sql = "CREATE TABLE users (
    //     id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    //     username VARCHAR(10) UNIQUE NOT NULL,
    //     password VARCHAR(255) NOT NULL,
    //     count_files INT UNSIGNED DEFAULT 0,
    //     role ENUM('dev','admin','user') NOT NULL DEFAULT 'user',
    //     date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    // )";
    //     $conn->exec($sql);
    //     echo "TABLE users CREATED -> OK<br>";
    // } catch(PDOException $e) {
    //     die ("Error:" . $e->getMessage());
    // }
    
    //     try {
    //     $sql = "CREATE TABLE user_telegram (
    //         id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    //         username VARCHAR(20) NOT NULL,
    //         chatid INT(11) NOT NULL,
    //         registered BOOLEAN DEFAULT FALSE,
    //         date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    //         user_id INT(11) UNSIGNED NOT NULL UNIQUE,
    //         FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
    //     )";
    //     $conn->exec($sql);
    //     echo "TABLE user_telegram CREATED -> OK<br>";
    // } catch(PDOException $e) {
    //     die ("Error:" . $e->getMessage());
    // }

    // try {
    //         $sql = "CREATE TABLE files (
    //             id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    //             file_id CHAR(100) UNIQUE NOT NULL,
    //             file_name CHAR(20) NOT NULL,
    //             date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    //             user_id INT(11) UNSIGNED NOT NULL,
    //             FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
    //         )";
    //         $conn->exec($sql);
    //         echo "TABLE files CREATED -> OK<br>";
    //     } catch(PDOException $e) {
    //         die ("Error:" . $e->getMessage());
    //     }

    // try {
    //     $sql = "CREATE TABLE files_users_requests (
    //         id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    //         message TEXT,
    //         date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    //         completed BOOLEAN NOT NULL DEFAULT FALSE,
    //         file_id INT(11) UNSIGNED UNIQUE,
    //         FOREIGN KEY (file_id) REFERENCES files(id) ON DELETE SET NULL ON UPDATE CASCADE,
    //         user_id INT(11) UNSIGNED NOT NULL,
    //         FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
    //     )";
    //     $conn->exec($sql);
    //     echo "TABLE files_users_requests CREATED -> OK<br>";
    // } catch(PDOException $e) {
    //     die ("Error:" . $e->getMessage());
    // }
    // try {
    //         $sql = "CREATE TABLE files_requests (
    //             id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    //             message TEXT,
    //             state ENUM('a','d','c') NOT NULL,
    //             completed BOOLEAN NOT NULL DEFAULT FALSE,
    //             date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    //             user_admin INT(11) UNSIGNED,
    //             FOREIGN KEY (user_admin) REFERENCES users(id) ON DELETE SET NULL ON UPDATE CASCADE,
    //             user_request_id INT(11) UNSIGNED UNIQUE,
    //             FOREIGN KEY (user_request_id) REFERENCES files_users_requests(id) ON DELETE CASCADE,
    //             UNIQUE (user_request_id, state)
    //         )";
    //         $conn->exec($sql);
    //         echo "TABLE files_requests CREATED -> OK<br>";
    //     } catch(PDOException $e) {
    //         die ("Error:" . $e->getMessage());
    //     }

    // // ///////////////////////INSERT TABLE///////////////////////
    // $sql="INSERT INTO users (username,password) VALUES (:u,:p)";
    // $query=$conn->prepare($sql);
    // if($query->execute([":u"=> "ernesto","p"=> "12345678"]))
    //     echo "CREATED ESTEBAN -> OK<br>";
    // else
    //     echo "NO CREATED ESTEBAN -> X<br>";
    
    // $sql="INSERT INTO user_telegram (username,user_id) VALUES (:un,:ui)";
    // $query=$conn->prepare($sql);
    // if($query->execute([":un"=> "@EstebanACB2","ui"=> 1]))
    //     echo "INSERT USER TELEGRAM -> OK<br>";
    // else
    //     echo "NO USER TELEGRAM -> X<br>";

    // $sql="INSERT INTO telegram_code (code,user_id) VALUES (:c,:ui)";
    // $query=$conn->prepare($sql);
    // if($query->execute([":c"=> "AC4RT","ui"=> 1]))
    //     echo "INSERT CODE -> OK<br>";
    // else
    //     echo "NO INSERT CODE -> X<br>";

    // ///////////////////////SELECT///////////////////////
    // $sql="SELECT id,username FROM users ";
    // $query=$conn->prepare($sql);
    // $query->execute([":u"=> "esteban"]);
    // if ($query->rowCount()> 0) {
    //     while($row=$query->fetch(PDO::FETCH_ASSOC)){
    //         echo $row['id'];
    //         echo $row['username'];
    //     }
    // }

    // ///////////////////////DELETE///////////////////////
    // $sql="DELETE FROM telegram_code WHERE user_id=:ui";
    // $query=$conn->prepare($sql);
    // if($query->execute(["ui"=> 1]))
    //     echo "DELETE  TELEGRAM CODE -> OK<br>";
    // else
    //     echo "NO DELETE TELEGRAM CODE -> X<br>";
    
    // ///////////////////////UPDATE///////////////////////
    // $sql="UPDATE users SET count = 0 WHERE id=:i";
    // $query=$conn->prepare($sql);
    // if($query->execute([":i"=> $file_id]))
    //     echo "UPDATE  -> OK<br>";
    // else
    //     echo "NO UPDATE  -> X<br>";
    
    // ///////////////////////ALLTER///////////////////////
    // $sql="ALTER TABLE files ADD state ENUM('Ninguno','Pendiente','Aceptado','Denegado','Terminado') NOT NULL DEFAULT 'Ninguno';";
    // $sql="ALTER TABLE files CHANGE state ENUM('Ninguno','Pendiente','Aceptado','Denegado','Terminado') NOT NULL DEFAULT 'Ninguno';";
    // $sql="ALTER TABLE nombre_tabla MODIFY file_id CHAR(100) UNIQUE NOT NULL;"
    // $sql="ALTER TABLE user_telegram ADD date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP;";
    // $sql=" ALTER TABLE files DROP FOREIGN KEY files_telegram_ibfk_1 ;";
    //$sql=" ALTER TABLE user_telegram DROP user_id ;";
    
    // $sql="ALTER TABLE user_telegram
    //         ADD CONSTRAINT user_id
    //         FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE;
    // ";
    //$sql="DROP TABLE user_telegram";
    //$sql="SHOW CREATE TABLE user_telegram";
    // $query=$conn->prepare($sql);
    // if($query->execute())
    // {
    //     echo "ALLTER -> OK<br>";
    //     while($row=$query->fetch(PDO::FETCH_ASSOC))
    //     {
    //         foreach($row as $r)
    //             echo $r."<br>"; 
    //     }
    // }
    // else
    //     echo "NO ALLTER -> X<br>";



    
?>