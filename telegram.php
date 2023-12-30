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
                        
                        <p class="h4 mt-5">No se ha vindulado al 
                            <a href="https://t.me/eacb2_bot" target="_blank" data-bs-placement="right" data-bs-toggle="tooltip" data-bs-title="@eacb2_bot" target="_blank" class="link-warning link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">
                                Bot
                            </a>
                        </p>
                        <p lead >
                            Ingrese su nombre de usuario de Telegram
                        </p>
                        <form action="./bot/vinc.php" method="post">
                            <div class="row justify-content-center">
                                <div class="col-6 mb-3">
                                    <input oninput="Arroba()" id="Arroba_ID" value="@username"class="text-center form-control" required type="text"  placeholder="Nombre de Usuario" maxlength="20" name="telegramusername"  >
                                </div>
                            </div>    
                            <button type="submit" class="btn btn-primary">Enviar</button>
                              
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-2"></div>
        </div>
    </div>

   
</body>
<?php require 'views/_footer.html'; ?>