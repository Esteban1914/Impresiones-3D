<?php 
    include_once "includes/user.php";
    $user= new User();
    if($user->existSessionUser())
        header("Location: impresiones3d.php")
?>
<?php require('views/_head.html'); ?>
<body class="text-center bg-dark text-light">
    <?php  require('views/_navbar.php');    ?>
    <div class="container h-100 d-flex flex-column pt-5">
        <div class="row p-5"></div>
        <div class="row justify-content-center">
            <div class="col-auto col-md-8">
                <div class="card text-center opacity-translation">
                    <div class="card-body">
                        <div class="row justify-content-center mb-2">
                            <div class="col-2">
                            </div>
                            <div class="col-8">
                                <div class="card-title display-6 ">Inscripción</div>
                            </div>
                            <div class="col-2">
                                <div class="d-none spinner-border" id="spiner_loaduser" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            </div>
                            
                        </div>
                        
                        <form action="includes/register.php" method="post" >
                            <div class="row justify-content-center">
                                <div class="input-group mb-3">
                                    <span class="input-group-text"><i class="bi bi-person"></i></span>
                                    <div class="form-floating">
                                        <input  autocomplete="new-password" required oninput="findUserNameExist()" name="username" type="text" class="form-control" id="inputusername" placeholder="Nombre de usuario">
                                        <label for="inputusername">Nombre de usuario</label>
                                        <div class="invalid-tooltip">
                                            Nombre de usuario en uso, utilize otro
                                        </div>
                                    </div>  
                                </div> 
                                <div class="input-group mb-3">
                                    <span class="input-group-text"><i class="bi bi-file-lock"></i></span>
                                    <div class="form-floating">
                                        <input  autocomplete="new-password" required oninput="confirmPasswords()" name="password" type="password" class="form-control" id="inputpassword" placeholder="Contraseña">
                                        <label for="inputpassword">Contraseña</label>
                                    </div>
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text"><i class="bi bi-file-lock"></i></span>
                                    <div class="form-floating">
                                        <input  required oninput="confirmPasswords()" type="password" class="form-control" id="inputconfirmpassword" placeholder="Confirmar Contraseña">
                                        <label for="inputconfirmpassword">Confirmar Contraseña</label>
                                        <div class="invalid-tooltip">
                                            Las contraseñas no coiniden
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="input-group mb-3">
                                    <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                    <div class="form-floating">
                                        <input oninput="validateEmail()" required  name="email" type="email" class="form-control" id="inputemail" placeholder="Correo">
                                        <label for="inputemail">Correo</label>
                                        <div class="invalid-tooltip">
                                            El correo no es válido
                                        </div>
                                    </div>
                                    
                                </div> -->
                            </div>
                            <button disabled id="btnRegister" class="btn btn-outline-secondary my-3"type="submit">Registrar</button>
                        </form>
                        <div class="row justify-content-center mt-3">
                            <div class="col-auto">
                                <p >
                                    Ya posee una cuenta ? <a class="link" href="./home.php">Iniciar Sesión</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<?php require 'views/_footer.html'; ?>