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
        <div class="row justify-content-start">
            <div class="col-auto">
                <div class="card bg-dark text-light border border-0">
                    <div class="card-body">
                        <h4 class="display-5">Impresiones 3D</h4>
                    </div>
                </div>
                
            </div>
        </div>
        <div class="row">
            <div class="display-6">Panel de Usuarios</div>
        </div>
        <div class="row mt-4 p-2 justify-content-center">
            <table class="table table-dark table-striped">
                <thead>
                <tr>
                    <th scope="col"><i class="bi h2 bi-bookmark"></i></th>
                    <th scope="col"><i class="bi h2 bi-person-check-fill"></i></th>
                    <th scope="col"><i class="bi h2 bi-telegram"></i></th>
                    <th scope="col"><i class="bi h2 bi-ui-checks-grid"></i></th>
                </tr>
                </thead>
                <tbody>
                <tr class="table-success">
                    <td><strong><?php echo $bot->getDataSession('id')?></strong></th>
                    <td><strong>@<?php echo $bot->getDataSession('user')?></strong></td>
                    <td><strong><?php
                    $uer_telegram=$bot->getDataSession('usertelegram') ;
                    if($uer_telegram!==null)
                        echo "@".$uer_telegram;
                    else
                        echo "No asignado"
                    ?></strong></td>
                    <td><strong><?php echo $bot->getDataSession('role')?></strong></td>
                </tr>
                </tbody>
            </table>
        </div>
        <hr> 
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
    </div>
    <script>
        fetch('./views/ajax/_users_admin.php')
        .then(response => response.text())
        .then(html => {
            document.getElementById('id_placeholder').innerHTML = html;
        })
        .catch(error => console.warn(error));
    </script>    
</body>
<?php require 'views/_footer.html'; ?>
