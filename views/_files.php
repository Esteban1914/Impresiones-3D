<div class="container text-light">
    <?php 
        include_once '../includes/bot.php';
        $bot=new Bot();
        session_start();
        if(!isset($_SESSION['user']))
            die("Session Error");
        $files=$bot->getFileIDsByUser($_SESSION['user']);
    ?>
    <?php if (!empty($files)): ?>
        <hr>
        <?php foreach ($files as $row): ?>
            <div class="row m-2 align-items-center">
                <div class="col-8">
                    <div class="row justify-content-center align-items-center">
                        <div class="col-10">
                            <div class="card card-secondary text-light bg-secondary py-2">
                                <p class="card-text h4">
                                    <?php echo pathinfo($bot->getFileInfo($row['file_id'])['result']['file_path'], PATHINFO_FILENAME)
                                    ?>
                                </p>
                            </div>
                        </div>
                        <div class="col-8 col-md-2 mt-md-0 mt-2">
                            <div class="card text-white bg-success "> 
                                <p class="card-text">OK</p>
                            </div>
                        </div>
                    </div>
                        
                </div>
                <div class="col-4">
                    <div class="row justify-content-around">
                        <div class="col-auto mb-2">
                            <a href="" class="btn btn-outline-info">Solicitar</a>
                        </div>
                        <div class="col-auto mb-2   ">
                            <a href="" class="btn btn-outline-warning">Visualizar</a>
                        </div>
                        <div class="col-auto">
                            <a href="" class="btn btn-outline-danger"> Eliminar <?php $row['id']; ?></a>                
                        </div>
                    </div>
                </div>
            </div>
            <hr>
        <?php endforeach;?>
        
    <?php else:?>
        <div class="row justify-content-center">
            <div class="col-auto">
                Aún no exiten ficheros STL vinculados
            </div>
        </div>
    <?php endif;?>
        
</div>
<div class="row justify-content-center text-light mt-4">
    <div class="col-auto">
        <?php echo $bot->getCountFilesByUserName($_SESSION['user'])."/".$bot->getMaxCountFiles();?> ficheros STL almacenados
    </div>
</div>
<?php
    if(!$bot->userIsFullFilesByUserName($_SESSION['user'])):
?>
    <div class="row justify-content-center m-2">
        <div class="col-auto">
            <div class="btn btn-primary">Agregar Fichero STL</div>
        </div>
    </div>
<?php endif;?>
<!-- <div class="contanier ">
    <div class="row m-2 align-items-center">
        <div class="col-8"> 
            <div class="row justify-content-center align-items-center">
                <div class="col-10">
                    <p class="placeholder-glow">
                        <span class="placeholder col-12 bg-secondary"></span>
                    </p>
                    
                </div>
                <div class="col-8 col-md-2 mt-md-0 mt-2">
                        <p class="placeholder-glow">
                            <span class="placeholder col-12 bg-secondary"></span>
                        </p>
                </div>
            </div>
                
        </div>
        <div class="col-4">
            <div class="row justify-content-around">
                <div class="col-auto mb-2">
                    <a href="" class="btn btn-info  text-info disabled placeholder">NULL</a>
                </div>
                <div class="col-auto mb-2   ">
                    <a href="" class="btn btn-warning text-warning disabled placeholder">NULL</a>
                </div>
                <div class="col-auto mb-2">
                    <a href="" class="btn btn-danger text-danger disabled placeholder"> NULL</a>                
                </div>
            </div>
        </div>
    </div>
</div> -->