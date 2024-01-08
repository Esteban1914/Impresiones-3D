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
        <div class="row">
            <div class="display-5">Panel de Usuarios</div>
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
                        $uer_telegram=$bot->getDataSession('usernametelegram') ;
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
        <div class="row justify-content-center">
            <div class="col-auto">
                <div class="d-flex" role="search">
                    <input oninput="getUserFilterTimer()" id="id_search" class=" text-center form-control me-2" type="search" placeholder="Filtrar por usuario" aria-label="Search">
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
        <div id="id_data">
            
        </div> 
    </div>
    <script>
        function getUserFilterTimer()
        {
            clearTimeout(timer);
            
            timer=setTimeout(()=>
            {
                getUserFilter();
            },500);
        }
        function getUserFilter()
        {
            document.getElementById('id_data').className="d-none";
            document.getElementById('id_placeholder').className="d-block";
            fetch("./views/ajax/_users_admin.php"+(document.getElementById("id_search").value?"?filter_username="+document.getElementById("id_search").value:""))
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
        }    
        getUserFilter();
    </script>    
</body>
<?php require 'views/_footer.html'; ?>
