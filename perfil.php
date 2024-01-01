<?php
    include_once 'includes/login.php';
?>
<?php require('views/_head.html'); ?>
<body class="text-center bg-dark">
    <?php require('views/_navbar.php'); ?>
    <div class="container mt-5 pt-5">
        <div class="row justify-content-center">
            <div class="col-auto">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-2">

                            </div>
                            <div class="col-8">
                                <h4 class="card-title">Perfil de Usuario</h4>
                            </div>
                            <div class="col-2">
                                <a class="badge bg-warning text-dark" href=""><i class="bi bi-pencil h6 "></i></a>
                            </div>
                        </div>
                        
                        <div class="row m-2 mt-4">
                            <div class="col-6">
                                <div class="h6 text-start">
                                    Nombre de Usuario
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="h6 text-end">
                                   @<?php echo $_SESSION['user'];?>
                                </div>
                                <br>
                            </div>
                        </div>
                        <div class="row m-2 mt-4">
                            <div class="col-6">
                                <div class="h6 text-start">
                                    Contraseña
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="h6 text-end">
                                    Cifrada 
                                </div>
                                <br>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
   
</body>
<?php require 'views/_footer.html'; ?>