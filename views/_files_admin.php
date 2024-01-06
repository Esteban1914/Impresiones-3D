<div class="container text-light">
    <?php 
        include_once '../includes/bot.php';
        $user=new Bot();
       
        if(!$bot->existSessionUser())
            die("Session Error");
        $files=$bot->getFilesInfoByUser($_SESSION['user']);
    ?>
    ADMIN
        
</div>

