<?php
    $dir = "/var/www/html/impresiones3d/tem_data";

    $files = glob($dir."/*");

    foreach($files as $file)
    {
    if(is_file($file))
        unlink($file);
}
?>