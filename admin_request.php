<?php
    include_once 'includes/login.php';
?>
<?php 
    include_once './includes/bot.php';
    $bot=new Bot();

    if(!$bot->existSessionUser() || !$bot->userIsAdmin())
        die("Session Error");
?>
<?php require('views/_head.html'); ?>
<body class="text-center bg-dark text-light">
    
    <?php require('views/_navbar.php'); ?>
    <div class="container pt-5 opacity-translation text-light">
        <?php $url="./admin_solicitation.php";require_once "./views/back_url.php"?>
        <div class="row">
            <div class="display-5">Panel de Peticiones</div>
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
        <div id="id_data">
            
        </div> 
    </div>
    <script>
        
        fetch("./views/ajax/_admin_request.php")
        .then(response => response.text())
        .then(html => {   
            document.getElementById('id_placeholder').className="d-none";
            document.getElementById('id_data').className="d-block";
            document.getElementById('id_data').innerHTML = html;
        })
        .catch(error => {
            console.warn(error);
            document.getElementById('id_placeholder').className="d-none";
            document.getElementById('id_data').className="d-block";
        });
    </script>    
    
</body>
<?php require 'views/_footer.html'; ?>
