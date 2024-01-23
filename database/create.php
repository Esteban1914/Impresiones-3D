<?php
    $servername="localhost";
    $username="root";
    $password= "";

    ///////////////////////CONNECT///////////////////////
    // try {
    //     $conn = new PDO("mysql:host=$servername;", $username, $password);
    //     $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //     echo "CONNECTED -> OK<br>";
    // } catch(PDOException $e) {
    //     die ("Error:" . $e->getMessage());
    // }
    
    // // ///////////////////////CREATE DB///////////////////////
    // try {
    //     $sql = "CREATE DATABASE impresiones3D";
    //     $conn->exec($sql);
    //     echo "CREATED DB -> OK<br>";
    // } catch(PDOException $e) {
    //     die ("Error:" . $e->getMessage());
    // }
    

    // // ///////////////////////CONNECT DB///////////////////////
    // $conn->exec("USE impresiones3D");
    // echo "SELECT -> OK<br>";
    
    // // ///////////////////////CREATE TABLE///////////////////////
    
    
    "CREATE TABLE users (
        id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(10) UNIQUE NOT NULL,
        password VARCHAR(255) NOT NULL,
        role ENUM('dev','admin','user') NOT NULL DEFAULT 'user',
        date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";
       
    "CREATE TABLE user_validation (
        id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        type ENUM('email','phone') NOT NULL,
        data VARCHAR(254) NOT NULL UNIQUE,
        user_id INT(11) UNSIGNED NOT NULL UNIQUE,
        FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
    )";

    "CREATE TABLE user_telegram (
        id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(20) NOT NULL,
        chat_id INT(11) NOT NULL,
        registered BOOLEAN DEFAULT FALSE,
        date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        user_id INT(11) UNSIGNED NOT NULL UNIQUE,
        FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
    )"; 

    "CREATE TABLE files (
        id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        file_id CHAR(100) UNIQUE NOT NULL,
        file_name CHAR(20) NOT NULL,
        date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        user_id INT(11) UNSIGNED NOT NULL,
        FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
    )";
           
    "CREATE TABLE file_requests (
        id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        message TEXT,
        state ENUM('ACCEPT','DENIED','COMPLETED'),
        date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        file_id INT(11) UNSIGNED UNIQUE,
        FOREIGN KEY (file_id) REFERENCES files(id) ON DELETE CASCADE,
        user_admin INT(11) UNSIGNED,
        FOREIGN KEY (user_admin) REFERENCES users(id) ON DELETE CASCADE
        filament_id INT(11) UNSIGNED NOT NULL,
        FOREIGN KEY (filament_id) REFERENCES filament(id) ON DELETE CASCADE
        filament_color_id INT(11) UNSIGNED NOT NULL,
        FOREIGN KEY (filament_color_id) REFERENCES filament_color(id) ON DELETE CASCADE
    )";
    
    "CREATE TABLE filament (
        id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(30) NOT NULL UNIQUE,
        active BOOLEAN DEFAULT FALSE,
        price DECIMAL(8,3) 
    )";
    "CREATE TABLE filament_color (
        id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(20) NOT NULL,
        -- R DECIMAL(3,3) NOT NULL,
        -- G DECIMAL(3,3) NOT NULL,
        -- B DECIMAL(3,3) NOT NULL 
        color VARCHAR(8) DEFAULT '#000000'
    )";
    "CREATE TABLE filament_color_relation (
        filament_id INT(11) UNSIGNED,
        color_id INT(11) UNSIGNED,
        active BOOLEAN DEFAULT FALSE,
        PRIMARY KEY (filament_id, color_id),
        FOREIGN KEY (filament_id) REFERENCES filament(id) ON DELETE CASCADE,
        FOREIGN KEY (color_id) REFERENCES filament_color(id) ON DELETE CASCADE
     );"
            

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