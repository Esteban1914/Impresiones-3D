<?php
    include_once 'includes/login.php';
?>
<?php require('views/_head.html'); ?>
<body class="text-center bg-dark">
    <?php require('views/_navbar.php'); ?>
    <div class="container text-light mt-5 pt-5">
        <?php 
            include_once 'includes/bot.php';
            $bot=new Bot();
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
                            <div class="col-8 col-md-2 my-md-0 my-2">
                                <div class="card text-white bg-success "> 
                                    <p class="card-text">OK</p>
                                </div>
                            </div>
                        </div>
                            
                    </div>
                    <div class="col-4">
                        <div class="row justify-content-center">
                            <div class="col-auto my-2 m-md-0">
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
</body>
<?php require 'views/_footer.html'; ?>