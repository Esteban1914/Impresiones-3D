<?php 
    if($_SERVER["REQUEST_METHOD"]=== 'POST')
    {
        if(isset($_POST['username']) && isset($_POST['password']))
        {
            include_once "user.php";
            $user=new User();
            if($user->registerUser($_POST["username"],$_POST["password"]))
            {
                $user->setUserSession($_POST["username"]);
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