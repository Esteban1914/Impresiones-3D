<div class="container text-light">
    <?php 
        include_once '../../includes/bot.php';
        $bot=new Bot();
       
        if(!$bot->existSessionUser())
            die("Session Error");
        $files=$bot->getFilesInfoByUser($bot->getDataSession('user'));
    ?>
    <?php if (!empty($files)): ?>
        <hr>
        <div class="row">
            <?php 
                $numeros = range(0,6);

                $seleccionados = [];

                for ($i = 0; $i < 5; $i++)
                {
                    $indice = array_rand($numeros);

                    $seleccionados[] = $numeros[$indice];

                    unset($numeros[$indice]);
                }
                function getColorByIndex($index,$text=true)
                {
                    switch ($index)
                    {
                        case 0:
                            return 'primary'.($text?' text-light':"");
                        case 1:
                            return 'info'.($text?' text-dark':"");
                        case 2:
                            return 'success'.($text?' text-light':"");
                        case 3:
                            return 'warning'.($text?' text-dark':"");
                        case 4:
                            return 'danger'.($text?' text-dark':"");
                        case 5:
                            return  "light".($text?' text-dark':"");
                        default:
                            return 'secondary'.($text?' text-light':"");
                    }
                }
                $count=0;
                foreach ($files as $row): ?>
                    <?php $count+=1;$status=$bot->getFileStatus($row['id']);?>
                    <div class="col mx-4 my-3 border p-2 border border-<?php echo getColorByIndex($seleccionados[$count]) ?>p-2">
                        <div class="card bg-<?php echo getColorByIndex($seleccionados[$count])?>">
                            <div class="card-body">
                                <h4 class="card-title"><i class="bi bi-<?php echo $count?>-circle-fill"  style="font-size: 400%;"></i></h4>
                                <p class="card-text h3"><?php echo $row['file_name']?></p>
                            </div>       
                        </div>
                        
                        <div class="row justify-content-center mt-3">
                            <?php if($status == 'n'):?>
                                <div class="col-auto m-1">
                                    <a href="" data-bs-toggle="modal" data-bs-target="#modalRequest<?php echo $row['id']?>" title="Solicitar" class="btn btn-outline-<?php echo getColorByIndex($seleccionados[$count],false)?>"><i class="bi bi-send"></i></a>
                                </div>
                                <div class="modal fade" id="modalRequest<?php echo $row['id']?>" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body  text-dark">
                                                <div class="m-3 h4">Solicitar revisión de fichero <br><?php echo $row['file_name'] ?></div>
                                                <hr>
                                                <form action="./includes/request.php" method="post">
                                                    <input type="hidden" name="request_id" value="<?php echo $row['id']?>">
                                                    <div class="mb-3">
                                                        <label for="exampleFormControlTextarea1" class="form-label h4">Mensaje adicional</label>
                                                        <textarea name="message" class="form-control" id="exampleFormControlTextarea1" rows="4">Solicitar modelo 3D.</textarea>
                                                    </div>
                                                    <div class="row justify-content-around my-3">
                                                        <div class="col-auto">
                                                            <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Cancelar</button>
                                                        </div>
                                                        <div class="col-auto">
                                                            <button  type="submit" class="btn btn-success">Solicitar</button>
                                                        </div>
                                                    </div>   
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php elseif($status == 'p'):?>
                                <!-- <div class="col-auto m-1">
                                    <a href="" data-bs-toggle="modal" data-bs-target="#modalCancel<?php echo $row['id']?>" title="Cancelar" class="btn btn-outline-<?php echo getColorByIndex($seleccionados[$count],false)?>"><i class="bi bi-x"></i></i></a>
                                </div>
                                <div class="modal fade" id="modalCancel<?php echo $row['id']?>" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body  text-dark">
                                                <h3 class="m-3">Cancelar revisión de fichero <br><?php echo $row['file_name'] ?></h3>
                                                <hr>
                                                <form action="./includes/cancel.php" method="post">
                                                    <input type="hidden" name="cancel_id" value="<?php echo $row['id']?>">
                                                    <div class="row justify-content-around">
                                                        <div class="col-auto">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                                        </div>
                                                        <div class="col-auto">
                                                            <button  type="submit" class="btn btn-warning">Cancelar</button>
                                                        </div>
                                                    </div>   
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->
                            <?php endif; ?>
                            
                            <div class="col-auto m-1">
                                <a title="Visualizar Modelo" href="./visualice.php?model_id=<?php echo $row['id'] ?>" class="btn btn-outline-<?php echo getColorByIndex($seleccionados[$count],false)?>"><i class="bi bi-eye-fill"></i></a>
                            </div>
                            <div class="col-auto m-1">
                                <a href="<?php echo $bot->getFileURLDownload($row['id'],TRUE)?>" title="Descargar" class="btn btn-outline-<?php echo getColorByIndex($seleccionados[$count],false)?>"><i class="bi bi-download"></i></a>
                            </div>
                            <div class="col-auto m-1">
                                <a title="Eliminar" href=""  data-bs-toggle="modal" data-bs-target="#modalDelete<?php echo $row['id']?>" class="btn btn-outline-<?php echo getColorByIndex($seleccionados[$count],false)?>"> <i class="bi bi-trash"></i></a>                
                            </div>

                            <div class="modal fade" id="modalDelete<?php echo $row['id']?>" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body  text-dark">
                                            <h3 class="m-3">Eliminar fichero <br><?php echo $row['file_name'] ?></h3>
                                            <hr>
                                            <form action="./includes/delete_file.php" method="post">
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
                        <div class="row">
                        <div class="mt-2 card-title  text-<?php echo getColorByIndex($seleccionados[$count],false)?> mx-auto">
                                <span class="h5  ">
                                    <?php 
                                        if($status == 'p' ) 
                                            echo "Pendiente"; 
                                        else if($status == 'd' ) 
                                            echo "Denegado";
                                        else if($status == 'a' )  
                                            echo "Aceptado";
                                        else if($status == 'c' )  
                                            echo "Completado";
                                        else
                                            echo ""
                                    ?>
                                </span>
                            </div>
                        </div>
                    </div>
            <?php endforeach;?>
        </div>
    <?php else:?>
        <div class="row justify-content-center mt-5">
            <div class="col-auto">
                <span class="h3">Aún no exiten ficheros STL vinculados</span>
            </div>
        </div>
    <?php endif;?>
        
</div>

<?php if(!$bot->userIsFullFilesByUserName($bot->getDataSession('user'))):?>
    <div class="row justify-content-center m-2">
        <div class="col-auto">
            <div data-bs-toggle="modal" data-bs-target="#editUploadSTLModal" class="btn btn-primary">Agregar Fichero STL</div>
        </div>
    </div>
    <div class="modal fade" id="editUploadSTLModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel"></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="includes/upload_file.php" method="post" enctype="multipart/form-data">
                    <div class="mb-3" >
                        <label for="formFile" class="text-dark text-start form-label h4">Subir Fichero</label>
                        <input required class="form-control" name="file" type="file" id="file_id">
                    </div>
                    <button class="btn btn-primary"type="submit">ENVIAR</button>
                </form>
            </div>
            </div>
        </div>
    </div>
<?php endif;?>



