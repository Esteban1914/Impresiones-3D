<?php require('views/_head.html'); ?>
<body class="text-center bg-dark text-light">
    <?php require('views/_navbar.php'); ?>
    <div class="contanier opacity-translation pt-5">
        <div class="row justify-content-center ">
            <div class="col-auto ">
                <?php
                function getOKMessage($key)
                {
                    switch ($key) {
                        case 'delete_file':
                            return "Eliminado fichero STL";
                        case "request_file":
                            return "Solicitado fichero STL";
                        case "cancel_file":
                            return "Cancelada solicitud fichero STL";
                        case "upload_file":
                            return "Subido fichero STL";
                        case "signin":
                            return "<span class='h2'>Bienvendio a impresiones3d</span>";
                        default:
                            return "Realizada operación";
                    }
                }
                ?>
                <?php foreach ($_GET as $key => $value): ?>    
                    <?php if ($value=="OK" ): ?>
                        <div class="pe-5 alert alert-success alert-dismissible fade show" role="alert">
                            <?php echo getOKMessage($key); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php elseif($value =="BAD" ):?>
                        <div class="pe-5 alert alert-danger alert-dismissible fade show" role="alert">
                            Error al realizar operación
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <?php endif;?>
                <?php endforeach;?>
            </div>
        </div>
        <div class="row justify-content-start">
            <div class="col-auto">
                <div class="card bg-dark text-light border border-0">
                    <div class="card-body">
                        <h4 class="display-5">Impresiones 3D</h4>
                        <p class="card-text text-start"><small>Empezando en la plataforma? <a class="badge bg-info text-dark" href="learn.php">Aprende aquí!</a></small></p>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    
    <div id="id_data">
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
        fetch('./views/ajax/_user_data.php')
        .then(response => response.text())
        .then(html => {
            document.getElementById('id_data').innerHTML = html;
        })
        .catch(error => console.warn(error));
    </script>    
</body>
<?php require 'views/_footer.html'; ?>