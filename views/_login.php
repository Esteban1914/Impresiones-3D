<?php require('views/_head.html'); ?>
<body class="text-center bg-dark">
    <?php  require('views/_navbar.php');    ?>
    <div class="container h-100 d-flex flex-column mt-5 pt-5">
        <div class="row justify-content-center">
            <div class="col-auto">
                <div class="card text-center opacity-translation">
                    <div class="card-body">
                        <div class="card-title display-6 mb-4">Inicio de Sesión</div>
                        <form action="" method="post">
                        <div class="row justify-content-center ">
                            <div class="input-group  mb-3">
                                <span class="input-group-text"><i class="bi bi-person"></i></span>
                                <div class="form-floating">
                                <input <?php if(isset($errorLogin)){echo "oninput='RemoveError()'";}?> class="form-control <?php if(isset($errorLogin)){echo "is-invalid";}?>" required type="text" placeholder="Nombre de Usuario" maxlength="20" name="username"  id="usernameinput">
                                    <label for="inputusername">Usuario</label>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text"><i class="bi bi-file-lock"></i></span>
                                <div class="form-floating">
                                    <input <?php if(isset($errorLogin)){echo "oninput='RemoveError()'";}?> required type="password" placeholder="Contraseña" class="form-control <?php if(isset($errorLogin)){echo "is-invalid";}?>" maxlength="20" name="password" id="passwordinput">
                                    <label for="inputconfirmpassword">Contraseña</label>
                                    <div class="invalid-tooltip">
                                        Nombre de usuario o contraseña incorrecto
                                    </div>
                                </div>
                            </div>
                        </div>
                            <button class="btn btn-outline-secondary my-3"type="submit">Ingresar</button>
                        </form>
                        <div class="row justify-content-center mt-3">
                            <div class="col-auto">
                                <p >
                                    No tiene cuenta ? <a class="link" href="./signin.php">Registrarse</a>
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