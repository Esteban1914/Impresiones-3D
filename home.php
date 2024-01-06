<?php
    include_once 'includes/login.php';
?>
<?php require('views/_head.html'); ?>
<body class="text-center bg-dark text-light">
    <?php require('views/_navbar.php'); ?>
    <div class="contanier opacity-translation pt-5">
        
        <div class="row justify-content-center ">
            <div class="col-auto ">
                <?php if (isset($_GET['upload_file']) && $_GET['upload_file']=="OK" ): ?>
                    <div class="pe-5 alert alert-success alert-dismissible fade show" role="alert">
                        Fichero STL agregado
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php elseif(isset($_GET['upload_file']) && $_GET['upload_file']=="BAD" ):?>
                    <div class="pe-5 alert alert-danger alert-dismissible fade show" role="alert">
                        Error al agregar el fichero STL
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php endif;?>
                <?php if (isset($_GET['delete_file']) && $_GET['delete_file']=="OK" ): ?>
                    <div class="pe-5 alert alert-success alert-dismissible fade show" role="alert">
                        Eliminado fichero STL
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php elseif(isset($_GET['delete_file']) && $_GET['delete_file']=="BAD" ):?>
                    <div class="pe-5 alert alert-danger alert-dismissible fade show" role="alert">
                        Error al eliminar el fichero STL
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php endif;?>
                <?php if (isset($_GET['request_file']) && $_GET['request_file']=="OK" ): ?>
                    <div class="pe-5 alert alert-success alert-dismissible fade show" role="alert">
                        Solicitado fichero STL
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php elseif(isset($_GET['request_file']) && $_GET['request_file']=="BAD" ):?>
                    <div class="pe-5 alert alert-danger alert-dismissible fade show" role="alert">
                        Error al solicitar el fichero STL
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php endif;?>
                
            </div>
        </div>
        <div class="row justify-content-start">
            <div class="col-auto">
                <div class="card bg-dark text-light border border-0">
                    <div class="card-body">
                        <h4 class="display-4">Impresiones 3D</h4>
                        <p class="card-text text-start"><small>Empezando en la plataforma? <a class="badge bg-info text-dark" href="learn.php">Aprende aquí!</a></small></p>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    
    <div id="id_placeholder">
        <div class="row justify-content-center text-light opacity-translation">
            <hr>
            <span class="h3 text-center ">Cargando Datos</span>
            <br>
            <div class="m-3 spinner-border" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            
        </div>
        
        <div class="contanier opacity-translation">
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
        </div>
        <div class="contanier opacity-translation">
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
                                    <span class="placeholder col-12 bg-warning"></span>
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
        </div>
        <div class="contanier opacity-translation">
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
                                    <span class="placeholder col-12 bg-success"></span>
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
        </div>
    </div>
    <script>
        <?php
            include_once "includes/user.php";
            $user=new User();        
        ?>
        fetch('./views/<?php if($user->userIsUser()) echo "_files_user.php"; else if($user->userIsAdmin()) echo "_files_admin.php"; else if($user->userIsDev()) echo "_files_dev.php";?> ')
        .then(response => response.text())
        .then(html => {
            document.getElementById('id_placeholder').innerHTML = html;
        })
        .catch(error => console.warn(error));
    </script>    
</body>
<?php require 'views/_footer.html'; ?>