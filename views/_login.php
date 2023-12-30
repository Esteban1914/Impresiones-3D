<?php require('views/_head.html'); ?>
<body class="text-center bg-dark">
    <?php  require('views/_navbar.php');    ?>
    <div class="container h-100 d-flex flex-column justify-content-center">
        <div class="row justify-content-center">
            <div class="col-6">
                <div class="card text-center opacity-translation">
                    <div class="card-body">
                        <div class="card-title display-6 mb-4">Inicio de sesión</div>
                        <form action="" method="post">
                        <div class="row justify-content-center ">
                            <div class="col-8 mb-3">
                                <input <?php if(isset($errorLogin)){echo "oninput='RemoveError()'";}?> class="text-center form-control <?php if(isset($errorLogin)){echo "is-invalid";}?>" required type="text" placeholder="Nombre de Usuario" maxlength="20" name="username"  id="usernameinput" aria-describedby="emailHelp">
                            </div>  
                            <div class="col-8 mb-3">
                                <input <?php if(isset($errorLogin)){echo "oninput='RemoveError()'";}?> required type="password" placeholder="Contraseña" class="text-center form-control <?php if(isset($errorLogin)){echo "is-invalid";}?>" maxlength="20" name="password" id="passwordinput">
                                <div class="invalid-feedback">
                                    Nombre de usuario o contraseña incorrecto
                                </div>
                            </div>
                            
                        </div>
                            <button class="btn btn-outline-secondary my-3"type="submit">Ingresar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    
    
</body>
<?php require 'views/_footer.html'; ?>