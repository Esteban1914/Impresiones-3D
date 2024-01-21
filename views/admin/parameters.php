<?php
    include_once '../../includes/login.php';
?>
<?php 
    include_once '../../includes/bot.php';
    $bot=new Bot();

    if(!$bot->existSessionUser())
        die("Session Error");
?>
<?php require('../_head.html'); ?>
<body class="text-center bg-dark text-light">
    <?php require('../_navbar.php'); ?>
    <div class="container opacity-translation pt-5">
        <?php $url="./home.php";require_once "../back_url.php"?>
        <div class="row m-5">
            <div class="display-5">Panel de Parámetros</div>
        </div>
        <div class="row mt-4 p-2 justify-content-center">
            <div class="col m-2 focus-transition">
                <a href="filaments.php"  class="h-100" style="text-decoration: none;">
                    <div class="card h-100 text-dark bg-info">
                        <div class="card-body">
                            <h4 class="card-title"><i class="bi bi-life-preserver" style="font-size: 500%;"></i></h4>
                            <p class="card-text h3">Filamentos</p>
                        </div>     
                    </div>
                </a>
            </div>
            <!-- <div class="col m-2 focus-transition">
                <a href="filaments_colors.php"  class="h-100" style="text-decoration: none;">
                    <div class="card h-100 text-dark bg-warning">
                        <div class="card-body">
                            <h4 class="card-title"><i class="bi bi-card-checklist" style="font-size: 500%;"></i></h4>
                            <p class="card-text h3">Colores</p>
                        </div>       
                    </div>
                </a>
            </div> -->
        </div>
        
    </div>
</body>
<?php require '../_footer.html'; ?>
