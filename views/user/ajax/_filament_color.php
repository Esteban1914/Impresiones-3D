<?php 
    if(!isset($_POST['filament']))
        exit;
    include_once "../../../includes/bot.php";
    $bot=new Bot();
    $filament_colors=$bot->getFilamentColors($_POST['filament']);
?>
<?php foreach ($filament_colors as $filament_color):?>
    <option data-R="<?php echo $filament_color['R']?>" data-G="<?php echo $filament_color['G']?>" data-B="<?php echo $filament_color['B']?>" value="<?php echo $filament_color['id']?>"><?php echo $filament_color['color']?></option>
<?php endforeach;?>
<option value="" disabled  selected></option>
