<?php require('views/_head.html'); ?>

<body class="text-center bg-dark">
    <?php require('views/_navbar.php'); ?>
        
    <div class="container h-100 d-flex flex-column mt-5 pt-5 opacity-translation">
        <div class="row my-5 justify-content-center">
            <div class="display-5 text-light">
                <strong>Impresiones 3D</strong>
            </div>
            <div class="h3 text-light lead my-3 w-50">
                Transforma tu imaginación en realidad y descubre el fascinante mundo de la impresión 3D
            </div>
        </div>
        <div class="row justify-content-center my-3">
            <div class="col-auto">
                <a type="button" href="home.php"class="btn btn-outline-secondary btn-lg ">Comenzar</a>
            </div>
            <div class="col-auto">
                <a type="button" data-bs-toggle="modal" data-bs-target="#ModalTelegram" class="btn btn-outline-primary btn-lg"><i class="bi bi-telegram"></i> Telegram</a>
            </div>
        </div>
        



        <!-- <div class="row align-self-end">
            footer
        </div> -->

    </div>
    <div class="modal fade " id="ModalTelegram" tabindex="-1" aria-labelledby="ModalTelegramLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content bg-dark text-light">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="ModalTelegramLabel"><i class="bi bi-telegram h3 mx-3"></i> Telegram</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body h5 lead">
                <p class="my-3">
                    Para acceder a nuestros servicios puede utilizar plataforma 
                    <a href="https://telegram.org/" target="_blank" data-bs-placement="right" data-bs-toggle="tooltip" data-bs-title="telegram.org" class="text-primary">
                        Telegram
                    </a>
                    <br>
                </p>
                <p class="my-3">
                    Puede comunicarse mediante nuestro 
                    <a href="https://t.me/eacb2_bot" data-bs-placement="right" data-bs-toggle="tooltip" data-bs-title="@eacb2_bot" target="_blank" class="link-info link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">
                        Bot
                    </a>
                
                </p>
            </div>
            
            </div>
        </div>
    </div>
</body>




<?php require 'views/_footer.html'; ?>