<?php 
    if($_SERVER["REQUEST_METHOD"]=== 'POST')
    {
        include_once "db_manager.php";
        $db_manager=new DB_Manager();
        if(!isset($_POST['username']) && isset($_POST['password']))
        {
            header ("Location: ../profile.php?s=BAD");
            // if($db_manager->updatePassWUser($_POST["username"],$_POST["password"]))
            // {
            //     $db_manager->closeSession();
            //     header ("Location: ../profile.php?s=OK");
            // }
            // else
            //     header ("Location: ../profile.php?s=BAD");
            exit;
        }
        else if(isset($_POST['username']) && !isset($_POST['password']))
        {
            
            if($db_manager->updateUserName($_SESSION['user'],$_POST["username"]))
            {
                $db_manager->closeSession();
                header ("Location: ../profile.php?s=OK");
            }
            else
                header ("Location: ../profile.php?s=BAD");
            exit;
            
        }
    }
    header ("Location: ../profile.php?s=BAD");
?>