<?php
    include_once '../../includes/login.php';
?>
<?php 
    include_once '../../includes/bot.php';
    $bot=new Bot();

    if(!$bot->existSessionUser())
        die("Session Error");
    if(!isset($_GET['filament_id'])||!isset($_GET['filament_name']))
    {
        header('Location: /impresiones3d/home.php');
        exit;
    }
    $filament_id=$_GET['filament_id'];
    $filament_name=$_GET['filament_name'];
?>
<?php require('../_head.html'); ?>
<body class="text-center bg-dark text-light">
    <?php require('../_navbar.php'); ?>
    <div class="container opacity-translation pt-5">
        <div class="row justify-content-center">
            <div class="col-auto ">
                <?php
                    function getOKMessage($key)
                    {
                        switch ($key) {
                            case 'add_filament_color':
                                return "Creado color";
                            case "delete_filament_color":
                                return "Eliminado color";
                            default:
                                return "Realizada operación";
                        }
                    }
                    ?>
                    <?php foreach ($_GET as $key => $value): ?>    
                        <?php if (!($key=="filament_id"&&$key=="filament_name")): ?>
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
                        <?php endif;?>
                    <?php endforeach;?>
                </div>
            </div>
        </div>
        <div class="container">
            <?php $url="./filaments.php";require_once "../back_url.php"?>
            <div class="row m-5">
                <div class="display-5">Panel de Colores</div>
            </div>
            <div class="row m-5">
                <div class="display-6"><?php echo $filament_name?></div>
            </div>
            <div class="row justify-content-center">
                <div class="col-auto">
                    <a href="" data-bs-toggle="modal" data-bs-target="#modalAddFilament" class="btn btn-primary"><div class="h6">Nuevo Color</div></a>
                </div>
            </div>
            <div class="modal fade" id="modalAddFilament" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-dark">Nuevo Color</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body  text-dark">
                            <form action="../../includes/add_filament_color.php" method="post">
                                <input type="hidden" name="filament" value="<?php echo $filament_id?>">
                                <div class="row justify-content-center">
                                    <div class="input-group mb-3">
                                        <div class="form-floating">
                                            <input required class="form-control "  name="name" type="text"  id="input_filament_color" placeholder="Nombre del color">
                                            <label for="input_filament_color">Nombre del color</label>
                                            <div class="invalid-tooltip" id="id_inputusername_invalid">
                                                Nombre de color en uso 
                                            </div>
                                        </div>  
                                    </div> 
                                    <input class="form-control form-control-color" type="color" name="color">
                                   
                                </div>
                                <div class="row justify-content-around">
                                    <div class="col-auto">
                                        <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Cancelar</button>
                                    </div>
                                    <div class="col-auto">
                                        <button  type="submit" class="btn btn-success">Crear</button>
                                    </div>
                                </div>   
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row justify-content-center">
                <div class="col-auto">
                    <div class="d-flex" role="search">
                        <input oninput="getFilamentColorFilterTimer()" id="id_search" class=" text-center form-control me-2" type="search" placeholder="Filtrar por name" aria-label="Search">
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
        
    </div>
    <script>
        function getFilamentColorFilterTimer()
        {
            clearTimeout(timer);
            
            timer=setTimeout(()=>
            {
                getFilamentColorFilter();
            },500);
        }
        function getFilamentColorFilter()
        {
            document.getElementById('id_data').className="d-none";
            document.getElementById('id_placeholder').className="d-block";
            fetch("./ajax/_filament_color.php?filament_id=<?php echo $filament_id?>"+(document.getElementById("id_search").value?"&filter_filament_color="+document.getElementById("id_search").value:""))
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
        getFilamentColorFilter();
    </script>    
</body>
<?php require '../_footer.html'; ?>
