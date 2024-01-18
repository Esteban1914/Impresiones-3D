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
            <div class="display-5">Panel de Solicitudes</div>
        </div>
        <div class="row mt-4 p-2 justify-content-center">
            <div class="col m-2 focus-transition">
                <?php $_requests=$bot->getCountRequest(); ?>
                <a href="<?php if($_requests>0) echo "request.php"?>"  class="h-100" style="text-decoration: none;">
                    <div class="card h-100 text-dark bg-info">
                        <div class="card-body">
                            <h4 class="card-title"><i class="bi bi-list-stars" style="font-size: 500%;"></i></h4>
                            <p class="card-text h3">Peticiones</p>
                        </div>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-primary border border-dark">
                            <?php echo $_requests ?>
                        </span>       
                    </div>
                </a>
            </div>
            <div class="col m-2 focus-transition">
                <?php $_accepts=$bot->getCountAccept(); ?>
                <a href="<?php if($_accepts > 0) echo "accept.php"?>"  class="h-100" style="text-decoration: none;">
                    <div class="card h-100 text-dark bg-warning">
                        <div class="card-body">
                            <h4 class="card-title"><i class="bi bi-card-checklist" style="font-size: 500%;"></i></h4>
                            <p class="card-text h3">Aceptados</p>
                        </div>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-primary border border-dark">
                            <?php echo $_accepts ?>
                        </span>       
                    </div>
                </a>
            </div>
            <div class="col m-2 focus-transition">
                <a href=""  class="h-100" style="text-decoration: none;">
                    <div class="card h-100 text-dark bg-danger">
                        <div class="card-body">
                            <h4 class="card-title"><i class="bi bi-x-octagon-fill" style="font-size: 500%;"></i></h4>
                            <p class="card-text h3">Denegados</p>
                        </div>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-primary border border-dark">
                            <?php echo $bot->getCountDenied() ?>
                        </span>       
                    </div>
                </a>
            </div>
            
            <div class="col m-2 focus-transition">
                <a  href=""  class="h-100" style="text-decoration: none;">
                    <div class="card h-100 text-dark bg-success ">
                        <div class="card-body">
                            <h4 class="card-title"><i class="bi bi-bookmark-check-fill"  style="font-size: 500%;"></i></h4>
                            <p class="card-text h3">Completados</p>
                        </div>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-primary border border-dark">
                            <?php echo $bot->getCountCompleted() ?>
                        </span>       
                    </div>
                </a>
            </div>
        </div>
        
    </div>
</body>
<?php require '../_footer.html'; ?>
