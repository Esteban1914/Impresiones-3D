<div class="container text-light">
    <?php 
        include_once '../../../includes/bot.php';
        $bot=new Bot();
       
        if(!$bot->existSessionUser())
            die("Session Error");
        $files=$bot->getFilesInfoByUser($bot->getDataSession('user'));
    ?>
    <?php if(!$bot->userIsFullFilesByUserName($bot->getDataSession('user'))):?>
        <div class="row justify-content-center m-2">
            <div class="col-auto focus-transition">
                <a href="./add_model.php" class="btn btn-primary">Agregar Modelo</a>
            </div>
        </div>
    <?php endif;?>
    <?php if (!empty($files)): ?>
        <hr>
        <div class="row justify-content-center">
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
                    <?php $count+=1;/*$row['state']=$bot->getFilestate($row['id']);*/?>
                    <div class="col col-md-3 mx-4 focus-transition my-3 border p-2 border border-<?php echo getColorByIndex($seleccionados[$count]) ?>p-2">
                        <div class="card bg-<?php echo getColorByIndex($seleccionados[$count])?>">
                            <div class="card-body">
                                <h4 class="card-title"><i class="<?php 
                                                                    if($row['state'] == null ) 
                                                                    echo "bi bi-question-circle";
                                                                    else if($row['state']== "DENIED" ) 
                                                                        echo "bi bi-x-circle";
                                                                    else if($row['state'] == "ACCEPT" )  
                                                                        echo "bi bi-check-circle";
                                                                    else if($row['state'] == "COMPLETED" )  
                                                                        echo "bi bi-c-circle";
                                                                    else
                                                                        echo "bi bi-exclamation-circle"
                                                                    ?>"  
                                                                    style="font-size: 400%;"></i></h4>
                                <p class="card-text h3"><?php echo $row['file_name']?></p>
                            </div>       
                        </div>
                        
                        <div class="row justify-content-center mt-3">
                            <?php if($row['state'] == null):?>
                                
                            <?php endif; ?>
                            
                            <div class="col-auto m-1">
                                <a title="Visualizar Modelo" href="./visualice.php?model_id=<?php echo $row['id'] ?>" class="btn btn-outline-<?php echo getColorByIndex($seleccionados[$count],false)?>"><i class="bi bi-eye-fill"></i></a>
                            </div>
                            <div class="col-auto m-1">
                                <a href="<?php echo $bot->getFileURLDownload($row['id'],"../../../")?>" title="Descargar" class="btn btn-outline-<?php echo getColorByIndex($seleccionados[$count],false)?>"><i class="bi bi-download"></i></a>
                            </div>
                            <div class="col-auto m-1">
                                <a title="Eliminar" href=""  data-bs-toggle="modal" data-bs-target="#modalDelete<?php echo $row['id']?>" class="btn btn-outline-<?php echo getColorByIndex($seleccionados[$count],false)?>"> <i class="bi bi-trash"></i></a>                
                            </div>

                            
                        </div>
                        <div class="row">
                        <div class="mt-2 card-title  text-<?php echo getColorByIndex($seleccionados[$count],false)?> mx-auto">
                                <span class="h5  ">
                                    <?php 
                                        if($row['state'] == null ) 
                                            echo "Pendiente"; 
                                        else if($row['state']== "DENIED" ) 
                                            echo "Denegado";
                                        else if($row['state'] == "ACCEPT" )  
                                            echo "Aceptado";
                                        else if($row['state'] == "COMPLETED" )  
                                            echo "Completado";
                                        else
                                            echo ""
                                    ?>
                                </span>
                            </div>
                        </div>
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
                                    <form action="../../includes/delete_file.php" method="post">
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





