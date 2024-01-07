<div class="container text-light">
    <?php 
        include_once '../includes/bot.php';
        $bot=new Bot();
       
        if(!$bot->existSessionUser())
            die("Session Error");
        $files=$bot->getFilesInfoByUser($_SESSION['user']);
    ?>
    <div class="contanier text-light">
        <div class="row">
            <div class="display-5">Panel de Administracion</div>
        </div>
        <div class="row mt-4 p-2 justify-content-center">
            <div class="col m-2">
                <a onclick="userAjax()" href="" class="focus-transition" style="text-decoration: none;">
                    <div class="card text-dark bg-primary">
                        <div class="card-body">
                            <h4 class="card-title"><i class="bi bi-people-fill" style="font-size: 500%;"></i></h4>
                            <p class="card-text text-dark h3">Usuarios</p>
                        </div>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-primary border border-dark">
                            <?php echo $bot->getCountUsers() ?>
                        </span>
                    </div>
                </a>
            </div>
            <div class="col m-2">
                <a href="" class="focus-transition" style="text-decoration: none;">
                    <div class="card text-dark bg-info">
                        <div class="card-body">
                            <h4 class="card-title"><i class="bi bi-list-stars" style="font-size: 500%;"></i></h4>
                            <p class="card-text h3">Solicitudes</p>
                        </div>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-primary border border-dark">
                            <?php echo $bot->getCountRequest() ?>
                        </span>       
                    </div>
                </a>
            </div>
            <div class="col m-2">
                <a href="" class="focus-transition" style="text-decoration: none;">
                    <div class="card text-dark bg-warning">
                        <div class="card-body">
                            <h4 class="card-title"><i class="bi bi-card-checklist" style="font-size: 500%;"></i></h4>
                            <p class="card-text h3">Aceptados</p>
                        </div>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-primary border border-dark">
                            <?php echo $bot->getCountAccept() ?>
                        </span>       
                    </div>
                </a>
            </div>
            <div class="col m-2">
                <a href="" class="focus-transition" style="text-decoration: none;">
                    <div class="card text-dark bg-danger">
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
            
            <div class="col m-2">
                <a  href="" class="focus-transition" style="text-decoration: none;">
                    <div class="card text-dark bg-success">
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
    
