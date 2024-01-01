<?php 
    if($_SERVER["REQUEST_METHOD"]=== 'POST')
    {
        if(isset($_POST['username']) && isset($_POST['password']))
        {
            include_once "db_manager.php";
            $db_manager=new DB_Manager();
            if($db_manager->registerUser($_POST["username"],$_POST["password"]))
            {
                $db_manager->setUserSession($_POST["username"]);
                header ("Location: ../home.php");
                exit;
            }
            else{
                header ("Location: ../signin.php");
                exit;
            }

        }
    }
?>