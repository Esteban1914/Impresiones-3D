<?php 
    if($_SERVER["REQUEST_METHOD"]=== 'POST')
    {
        include_once "user.php";
        $user=new User();
        if(!isset($_POST['username']) && isset($_POST['password']))
        {
            $user->log("A".$_POST["password"]);
            if($user->updatePassWUser($_SESSION["user"],$_POST["password"]))
            {
                $user->log("A".$_POST["password"]);
                $user->closeSession();
                header ("Location: ../profile.php?edit_user=OK");
            }
            else
                header ("Location: ../profile.php?edit_user=BAD");
            exit;
        }
        else if(isset($_POST['username']) && !isset($_POST['password']))
        {
            
            if($user->updateUserName($_SESSION['user'],$_POST["username"]))
            {
                $user->closeSession();
                header ("Location: ../profile.php?edit_user=OK");
            }
            else
                header ("Location: ../profile.php?edit_user=BAD");
            exit;
            
        }
    }
    header ("Location: ../profile.php?edit_user=BAD");
?>