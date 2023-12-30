<?php
    include_once 'includes/login.php';
?>
<?php require('views/_head.html'); ?>
<body class="text-center bg-dark">
    <?php require('views/_navbar.php'); ?>
    <div class="container mt-5 pt-5">
        <div class="row justify-content-center">
            <div class="col-2"></div>
            <div class="col-auto">
                <div class="card text-white bg-danger">
                    <div class="card-body">
                        <h4 class="card-title">
                            <div class="card text-white bg-primary">
                                <div class="card-body">
                                    <h4 class="card-title"><i class="bi bi-telegram h1 "></i></h4>
                                </div>
                            </div>
                        </h4>
                        
                        <p class="h4 mt-5">No se ha vindulado a
                            <a href="https://t.me/eacb2_bot" target="_blank" data-bs-placement="right" data-bs-toggle="tooltip" data-bs-title="@eacb2_bot" target="_blank" class="link-warning link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">
                                eacb2_bot
                            </a>
                        </p>
                        <p lead >
                            Conecte al Bot y escriba el comando <span class="badge bg-light cursor-select "><a data-bs-container="body"  data-bs-toggle="popover" data-bs-placement="bottom" data-bs-content="Comando Copiado" class=" link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover h6" id="texto-copiable" onclick="copiarAlPortapapeles()">/vincular</a></span> y siga las intrucciones
                        </p>
                        
                    </div>
                </div>
            </div>
            <div class="col-2"></div>
        </div>
    </div>

   
</body>
<?php require 'views/_footer.html'; ?>