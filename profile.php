<?php
    include_once 'includes/login.php';
?>
<?php require('views/_head.html'); ?>
<body class="text-center bg-dark">
    <?php require('views/_navbar.php'); ?>
    <div class="container mt-5 pt-5">
        <div class="row justify-content-center ">
            <div class="col-auto ">
                <?php if (isset($_GET['edit_user']) && $_GET['edit_user']=="OK" ): ?>
                    <div class="pe-5 alert alert-success alert-dismissible fade show" role="alert">
                        Usuario actualizado
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php elseif(isset($_GET['edit_user']) && $_GET['edit_user']=="BAD" ):?>
                    <div class="pe-5 alert alert-danger alert-dismissible fade show" role="alert">
                        Error al actualizar el usuario
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php endif;?>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-auto">
                <div class="card">
                    <div class="card-body">
                        <div class="px-5 row justify-content-center">
                            <div class="col-auto">
                                <h4 class="display-5">Perfil de Usuario</h4>
                            </div>
                        </div>
                        
                        <div class="row m-2 mt-4 align-items-center ">
                            <div class="col-5">
                                <div class="h6 text-start">
                                    Usuario
                                </div>
                            </div>
                            <div class="col-5">
                                <span class="h6 text-end">
                                   @<?php echo $_SESSION['user'];?>
                                </span>
                                <br>
                            </div>
                            <div class="col-2">
                            <a data-bs-toggle="modal" data-bs-target="#editUserModal" class="badge bg-info text-dark" href=""><i class="bi bi-pencil h6 "></i></a>   
                            </div>
                        </div>
                        <div class="row m-2 mt-4 align-items-center">
                            <div class="col-5">
                                <div class="h6 text-start">
                                    Contraseña
                                </div>
                            </div>
                            <div class="col-5">
                                <span class="h6 text-end">
                                    Cifrada 
                                </span>
                                <br>
                            </div>
                            <div class="col-2">
                                <a data-bs-toggle="modal" data-bs-target="#editPassModal" class="badge bg-warning text-dark" href=""><i class="bi bi-pencil h6 "></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    <div class="modal fade" id="editPassModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel"></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <div class="row justify-content-center mb-2">
                    <div class="col-2">
                    </div>
                    <div class="col-8">
                        <div class="card-title display-6 ">Editar Contraseña</div>
                    </div>
                    <div class="col-2">
                        <div class="d-none spinner-border" id="spiner_loaduser" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                    
                </div>
                <form action="includes/edit_user.php" method="post" >
                    <div class="row justify-content-center">
                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="bi bi-person"></i></span>
                            <div class="form-floating">
                                <input  autocomplete="new-password" required oninput="findPassWrodExistEdit()" name="last_password" type="password" class="form-control" id="inputlastpassword" placeholder="Contraseña actual">
                                <label for="inputlastpassword">Contraseña Actual</label>
                                <div class="invalid-tooltip">
                                    Contraseña incorrecta
                                </div>
                            </div>  
                        </div> 
                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="bi bi-file-lock"></i></span>
                            <div class="form-floating">
                                <input  autocomplete="new-password" required oninput="confirmPasswordsEdit  ()" name="password" type="password" class="form-control" id="inputpassword" placeholder="Contraseña">
                                <label for="inputpassword">Contraseña Nueva</label>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="bi bi-file-lock"></i></span>
                            <div class="form-floating">
                                <input  required oninput="confirmPasswordsEdit()" type="password" class="form-control" id="inputconfirmpassword" placeholder="Confirmar Contraseña">
                                <label for="inputconfirmpassword">Confirmar Contraseña Nueva</label>
                                <div class="invalid-tooltip">
                                    Las contraseñas no coiniden
                                </div>
                            </div>
                        </div>
                     
                    </div>
                    <div class="row justify-content-around m-2">
                    <div class="col-auto">
                        <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Cancelar</button>
                    </div>
                    <div class="col-auto">
                        <button disabled id="btnRegister" type="submit" class="btn btn-success">Confirmar</button>
                    </div>        
                </div>
                </form>
                </div>
                
            </div>
        </div>
    </div>
    <div class="modal fade" id="editUserModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel"></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <div class="row justify-content-center mb-2">
                    <div class="col-2">
                    </div>
                    <div class="col-8">
                        <div class="card-title display-6 ">Editar Usuario</div>
                    </div>
                    <div class="col-2">
                        <div class="d-none spinner-border" id="spiner_loaduser_1" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                    
                </div>
                <form action="includes/edit_user.php" method="post" >
                    <div class="row justify-content-center">
                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="bi bi-person"></i></span>
                            <div class="form-floating">
                                <input  autocomplete="new-password" required oninput="findUserNameExistEdit()" name="username" type="text" class="form-control" id="inputusername" placeholder="Usuario Nuevo">
                                <label for="inputlastpassword">Usuario Nuevo</label>
                                <div class="invalid-tooltip">
                                    Nombre de usuario en uso, utilize otro
                                </div>
                            </div>  
                        </div> 
                    </div>
                    <div class="row justify-content-around m-2">
                    <div class="col-auto">
                        <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Cancelar</button>
                    </div>
                    <div class="col-auto">
                        <button disabled id="btnRegister_1" type="submit" class="btn btn-success">Confirmar</button>
                    </div>        
                </div>
                </form>
                </div>
                
            </div>
        </div>
    </div>

</body>
<?php require 'views/_footer.html'; ?>