<?php
    include_once 'includes/login.php';
?>
<?php require('views/_head.html'); ?>
<body class="text-center bg-dark text-light">
    <?php require('views/_navbar.php'); ?>
    <div class="container pt-5 opacity-translation">
        <div class="row p-5"></div>
        <div class="row justify-content-center">
            <div class="col-2"></div>
            <div class="col-auto">
                <?php
                    include_once 'includes/bot.php';
                    $bot=new Bot();
                    $uic=$bot->userIsConfirmated($_SESSION['user']);  
                ?>
                <div class="card text-white bg-<?php if($uic===true) echo "success"; else if($uic===false) echo "warning"; else echo "danger";?>">
                    <div class="card-body">
                        <h4 class="card-title mb-3">
                            <div class="card text-white bg-primary">
                                <div class="card-body">
                                    <h4 class="card-title"><i class="bi bi-telegram h1 "></i></h4>
                                </div>
                            </div>
                        </h4>
                        <?php if($uic === true):?>
                            <p  class="my-3 h4" lead>
                                Cuenta vinculada con @<?php echo $_SESSION['usernametelegram']?>
                            </p>
                        <?php elseif($uic === false): ?>
                            <p lead class="text-dark h5">
                                Se quire vincular con @<?php 
                                    include_once "includes/db_manager.php";
                                    if($_SESSION['usernametelegram']=="")
                                    {
                                        $db_manager=new DB_Manager();
                                        $_SESSION['usernametelegram']=$db_manager->getUserNameTelegram($_SESSION['user']);
                                    }
                                    echo $_SESSION['usernametelegram'];
                                ?>
                                <br>
                            </p>
                            <p class="my-3 text-dark h4">Aceptar?</p>
                            <div class="row justify-content-around">
                                <div class="col-auto">
                                    <form action="includes/confirm.php" method="post" id="form_confirm">
                                        <a onclick="document.getElementById('form_confirm').submit();" class="btn">
                                            <div class="badge bg-success">
                                                <i class="bi bi-check-circle h3"></i>
                                            </div>
                                        </a>
                                        <input type="hidden" name="confirm">
                                    </form>
                                </div>
                                <div class="col-auto">
                                    <form action="includes/confirm.php" method="post" id="form_cancel">
                                        <a onclick="document.getElementById('form_cancel').submit();" class="btn">
                                            <div class="badge bg-danger">
                                            <i class="bi bi-x-circle h3"></i>
                                            </div>
                                        </a>
                                        <input type="hidden" name="cancel">
                                    </form>
                                </div>
                            </div>
                            
                        <?php else: ?>
                            <p class="h3 mt-5">No se ha vinculado a
                            <a href="https://t.me/impresiones3d_bot" target="_blank" data-bs-placement="right" data-bs-toggle="tooltip" data-bs-title="@impresiones3d_bot" target="_blank" class="link-warning link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">
                                impresiones3d_bot
                            </a>
                            </p>
                            <p lead >
                                Conecte con el Bot para inicar la inscripción.
                                <!-- Conecte al Bot y escriba el comando <span class="badge bg-light cursor-select "><a data-bs-container="body"  data-bs-toggle="popover" data-bs-placement="bottom" data-bs-content="Comando Copiado" class=" link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover h6" id="texto-copiable" onclick="copiarAlPortapapeles()">/vincular</a></span> y siga las intrucciones -->
                            </p>
                        <?php endif; ?>
                        
                    </div>
                </div>
                
                <?php if($uic === true):?>
                    <div class="row justify-content-center mt-5">
                        <div class="col-auto mt-5">
                            <form action="includes/confirm.php" method="post" id="form_desv">
                                <a onclick="document.getElementById('form_desv').submit();" class="btn btn-sm btn-danger p-2 mt-5">
                                        Desvincular Cuenta
                                </a>
                                <input type="hidden" name="desv">
                            </form>
                        </div>
                    </div>
                <?php endif;?>
                
            </div>
            <div class="col-2"></div>
        </div>
    </div>

   
</body>
<?php require 'views/_footer.html'; ?>