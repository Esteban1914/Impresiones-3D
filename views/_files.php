<div class="container text-light">
    <?php 
        include_once '../includes/bot.php';
        $bot=new Bot();
       
        if(!isset($_SESSION['user']))
            die("Session Error");
        $files=$bot->getFilesIDNameByUser($_SESSION['user']);
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
                                    <?php echo $row['file_name']
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
                            <a href="./visualice.php?model_id=<?php echo $row['id'] ?>" class="btn btn-outline-warning">Visualizar</a>
                        </div>
                        <div class="col-auto">
                            <a href=""  data-bs-toggle="modal" data-bs-target="#modalDelete" class="btn btn-outline-danger"> Eliminar <?php echo $row['id']; ?></a>                
                        </div>
                       
                        <div class="modal fade" id="modalDelete" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body  text-dark">
                                        <h3 class="m-3">Eliminar fichero <?php echo $row['file_name'] ?></h3>
                                        <hr>
                                        <form action="/includes/delete_file" method="post">
                                            <input type="hidden" name="delete_id" value="<?php echo $row['id']?>">
                                            <div class="row justify-content-around">
                                                <div class="col-auto">
                                                    <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Cancelar</button>
                                                </div>
                                                <div class="col-auto">
                                                    <button  type="submit" class="btn btn-danger">Eliminar</button>
                                                </div>
                                            </div>   
                                        </form>
                                    </div>
                                </div>
                            </div>
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
            <div data-bs-toggle="modal" data-bs-target="#editUploadSTLModal" class="btn btn-primary">Agregar Fichero STL</div>
        </div>
    </div>
<?php endif;?>


<div class="modal fade" id="editUploadSTLModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel"></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <form action="includes/upload_file.php" method="post" enctype="multipart/form-data">
                    <input type="file" name="file" id="file_id">
                    <button type="submit">ENVIAR</button>
                </form>
                </div>
                
            </div>
        </div>
    </div>
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