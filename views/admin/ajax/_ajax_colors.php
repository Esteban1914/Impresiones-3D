<?php 
    include_once '../../../includes/bot.php';
    $bot=new Bot();

    if(!$bot->existSessionUser() || !$bot->userIsAdmin())
        die("Session Error");
    if(!isset($_GET['filter_filament_color']))
        exit;
    $filter_filament_color=$_GET['filter_filament_color'];
    $filament_id=$_GET['$filament_id'];
?>

<?php $fliament_colors_ajax=$bot->getFiltredFilamentColorsAjax($filament_id,$filter_filament_color); ?>
<?php if(empty($fliament_colors_ajax)):?>
    <div class="row mt-4 p-2 justify-content-center">
    <div class="col-auto">
        Sin información para mostrar
    </div>
    </div>
<?php else:?>
    <div class="row mt-4 p-2 justify-content-center">       
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Nombre</th>
                    <th scope="col">Color</th>
                    <th scope="col"></th>
                </tr>
            </thead>  
            <tbody >
            
                <?php foreach($fliament_colors_ajax as $color): ?>
                    <tr>
                        <th ><?php echo $color['name']?></th>
                        <th><div class="btn "style="background-color: <?php echo $color['color']?>;">  </div></th>
                        <th>
                            <form action="../../includes/add_filament_color.php" method="post">
                                <input type="hidden" name="filament_id" value="<?php echo $filament_id?>">
                                <input type="hidden" name="color_id" value="<?php echo $color['id']?>">
                                <button type="submit" class="btn m-0 px-2 p-0 btn-success"><i class="bi bi-plus-circle-dotted" style="font-size: 110%;" ></i></button>
                            </form>
                        </th>
                    </tr>
                    
                <?php endforeach ?>    
            </tbody>
        </table>
    </div>  

<?php endif?>