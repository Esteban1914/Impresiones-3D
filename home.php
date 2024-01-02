<?php
    include_once 'includes/login.php';
?>
<?php require('views/_head.html'); ?>
<body class="text-center bg-dark">
    <?php require('views/_navbar.php'); ?>
    <div class="container text-light mt-5 pt-5">
        <?php 
            include_once 'includes/bot.php';
            $bot=new Bot();
            $files=$bot->getFileIDsByUserTelegram($_SESSION['usertelegram']);
            foreach ($files as $row) {
                $message .= pathinfo($bot->getFileInfo($row['file_id'])['result']['file_path'], PATHINFO_FILENAME)."\n";
            }
        ?>
        
        
    </div>
</body>
<?php require 'views/_footer.html'; ?>