<?php 
    include_once '../../../includes/bot.php';
    $bot=new Bot();

    if(!$bot->existSessionUser() || !$bot->userIsAdmin())
        die("Session Error");
    if(isset($_GET['filter_filament_color']))
        $filter_filament_color=$_GET['filter_filament_color'];
    if(!isset($_GET['filament_id']))
    {
        header('Location: /impresiones3d/home.php');
        exit;
    }
    $filament_id=$_GET['filament_id'];
?>

<?php
    if(isset($filter_filament_color))
        $fliament_colors=$bot->getFiltredFilamentColorsFilament($filament_id,$filter_filament_color);
    else
        $fliament_colors = $bot->getLastFilamentColorFilament($filament_id)
?>
<div class="row mt-4 p-2 justify-content-center">       
    <table class="table table-dark table-striped">
        <thead>
            <tr>
                <th scope="col">Nombre</th>
                <th scope="col">Color</th>
                <th scope="col"></th>
            </tr>
        </thead>  
        <tbody >
        
            <?php foreach($fliament_colors as $color): ?>
                <tr>
                    <th ><?php echo $color['name']?></th>
                    <th><div class="btn "style="background-color: <?php echo $color['color']?>;">  </div></th>
                    <th >
                        <a data-bs-toggle="modal" data-bs-target="#modalDelteFilamentColor<?php echo $color['id']?>" title="Eliminar" class="bg-danger mx-2 text-light p-1 rounded-pill"href=""><i class="bi bi-trash"></i></a>
                    </th>
                </tr>
            <?php endforeach ?>    
        </tbody>
    </table>
    <?php foreach($fliament_colors as $color): ?>
        <div class="modal fade" id="modalDelteFilamentColor<?php echo $color['id']?>" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body  text-dark">
                            <form action="../../includes/delete_filament_color.php" method="post"> 
                            
                                <h3 class="m-3">Eliminar color <br><?php echo $color['name'] ?></h3>
                                <hr>
                                <input type="hidden" name="delete_id" value="<?php echo $color['id']?>">
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
    <?php endforeach ?>  
</div>  
