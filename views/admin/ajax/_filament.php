<?php 
    include_once '../../../includes/bot.php';
    $bot=new Bot();
    
    if(!$bot->existSessionUser() || !$bot->userIsAdmin())
        die("Session Error");
    if(isset($_GET['filter_filament']))
        $filter_filament=$_GET['filter_filament'];
?>

<?php 
    if(isset($filter_filament))
        $fliaments=$bot->getFiltredFilements($filter_filament);
    else
        $fliaments = $bot->getLastFilements()?>
<?php if(empty($fliaments)):?>
    <div class="row mt-4 p-2 justify-content-center">
    <div class="col-auto">
        Sin información para mostrar
    </div>
    </div>
<?php else:?>

    <div class="row mt-4 p-2 justify-content-center">       
        <table class="table table-dark table-striped">
            <thead>
                <tr>
                    <th scope="col">Nombre</th>
                    <th scope="col">Precio</th>
                    <th scope="col"></th>
                </tr>
            </thead>  
            <tbody >
            
                <?php foreach($fliaments as $filament): ?>
                    <tr>
                        <th ><?php echo $filament['name']?></th>
                        <th ><?php echo $filament['price']?></th>
                        <th >
                            <!-- <a title="Editar" class="bg-warning mx-2 text-dark p-1 rounded-pill" href=""><i class="bi bi-pencil"></i></a> -->
                            <a title="Colores" class="bg-primary mx-2 text-light p-1 rounded-pill" href="filament_colors.php?filament_id=<?php echo $filament['id']?>"><i class="bi bi-droplet"></i></a>
                            <a data-bs-toggle="modal" data-bs-target="#modalDelteFilament<?php echo $filament['id']?>" title="Eliminar" class="bg-danger mx-2 text-light p-1 rounded-pill"href=""><i class="bi bi-trash"></i></a>
                        </th>
                        
                    
                    </tr>
                    
                <?php endforeach ?>    
            </tbody>
        </table>
        <?php foreach($fliaments as $filament): ?>
            <div class="modal fade" id="modalDelteFilament<?php echo $filament['id']?>" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body  text-dark">
                            <form action="../../includes/delete_filament.php" method="post"> 
                                <h3 class="m-3">Eliminar filamento <br><?php echo $filament['name'] ?></h3>
                                <hr>
                                <input type="hidden" name="delete_id" value="<?php echo $filament['id']?>">
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
        <?php endforeach ?>  
    </div>  
<?php endif?>
