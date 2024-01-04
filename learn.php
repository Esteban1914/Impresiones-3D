<?php
    include_once 'includes/login.php';
?>
<?php require('views/_head.html'); ?>
<body class="text-center bg-dark text-light">
    <?php require('views/_navbar.php'); ?>
    <div class="contanier text-light opacity-translation pt-5">
        <div class="row justify-content-start">
            <div class="col-auto">
                <div class="card bg-dark text-light border border-0">
                    <div class="card-body">
                        <h4 class="display-4">Impresiones 3D</h4>
                        <p class="card-text text-start"></p>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
           <div class="col-auto">    
                <h1>Conocer la plataforma <i class="bi bi-stars"></i></h1>
                <br>
                <p>Impresiones 3D es una plataforma destinada a recibir modelos STL para ser imrpesos en 3D</p>
                <br>
                <br>
                <h1>Telegram <i class="bi bi-telegram h3 mx-3"></i></h1>
                <br>
                <p>Poseemos un <a target="_blank" href="https://t.me/impresiones3d_bot" class="link-light link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">Bot de telegram</a>
                donde se podrá vincular la cuenta de esta plataforma a la cuenta de Telegram y asi poder mantener una comunicación directa con los clientes.
                <a href="telegram.php" class="badge bg-info text-dark">Donde vincular con Telegram?</a> 
            </p>
                

           </div>
       </div>
    </div>
</body>
<?php require 'views/_footer.html'; ?>