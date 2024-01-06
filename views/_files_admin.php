<div class="container text-light">
    <?php 
        include_once '../includes/bot.php';
        $user=new Bot();
       
        if(!$bot->existSessionUser())
            die("Session Error");
        $files=$bot->getFilesInfoByUser($_SESSION['user']);
    ?>
    <div class="contanier">
        <div class="row">
            <div class="col">
                
            </div>
            <div class="col">

            </div>
        </div>
    </div>
        
</div>

