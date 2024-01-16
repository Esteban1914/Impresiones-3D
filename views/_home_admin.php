<?php
    include_once 'includes/login.php';
?>
<?php 
    include_once './includes/bot.php';
    $bot=new Bot();

    if(!$bot->existSessionUser())
        die("Session Error");
?>
<?php require('views/_head.html'); ?>
<body class="text-center bg-dark text-light">
    <?php require('views/_navbar.php'); ?>
    <div class="container opacity-translation pt-5">
    <div class="row justify-content-center ">
        <div class="col-auto ">
            <?php
                function getOKMessage($key)
                {
                    switch ($key) {
                        case 'delete_file':
                            return "Eliminado fichero STL";
                        case "request_file":
                            return "Solicitado fichero STL";
                        case "cancel_file":
                            return "Cancelada solicitud fichero STL";
                        case "upload_file":
                            return "Subido fichero STL";
                        case "signin":
                            return "<span class='h2'>Bienvendio a impresiones3d</span>";
                        default:
                            return "Realizada operación";
                    }
                }
                ?>
                <?php foreach ($_GET as $key => $value): ?>    
                    <?php if ($value=="OK" ): ?>
                        <div class="pe-5 alert alert-success alert-dismissible fade show" role="alert">
                            <?php echo getOKMessage($key); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php elseif($value =="BAD" ):?>
                        <div class="pe-5 alert alert-danger alert-dismissible fade show" role="alert">
                            Error al realizar operación
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <?php endif;?>
                <?php endforeach;?>
            </div>
        </div>
        <div class="row m-5">
            <div class="display-5">Panel de Administracion</div>
        </div>
        <div class="row mt-4 p-2 justify-content-center">  
            <div class="col m-2 focus-transition">
                <a href="admin_users.php"  style="text-decoration: none;">
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
            <div class="col m-2 focus-transition">
                <?php $_requests=$bot->getCountRequest(); ?>
                <a href="admin_request.php"  style="text-decoration: none;">
                    <div class="card text-dark bg-info">
                        <div class="card-body">
                            <h4 class="card-title"><i class="bi bi-list-stars" style="font-size: 500%;"></i></h4>
                            <p class="card-text h3">Solicitudes</p>
                        </div>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-primary border border-dark">
                            <?php echo $_requests ?>
                        </span>       
                    </div>
                </a>
            </div>
            <div class="col m-2 focus-transition">
                <a  href="./admin_user_interface.php"  style="text-decoration: none;">
                    <div class="card text-dark bg-secondary">
                        <div class="card-body">
                            <h4 class="card-title"><i class="bi bi-diagram-3"  style="font-size: 500%;"></i></h4>
                            <p class="card-text h5">Interfaz de Usuario</p>
                        </div>   
                    </div>
                </a>
            </div>
        </div> 
    </div>
</body>
<?php require 'views/_footer.html'; ?>
