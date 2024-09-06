<?php 
    //f12537211e7f274d4c9634f542f7c399
    include_once "includes/user.php";
    $user= new User();
    if($user->existSessionUser())
        header("Location: impresiones3d.php")
?>
<?php require('views/_head.html'); ?>
<body class="text-center bg-dark text-light">
    <?php  require('views/_navbar.php');    ?>
    <div class="container h-100 d-flex flex-column pt-5">
        <div class="row p-1"></div>
        <div class="row justify-content-center ">
            <div class="col-auto ">
                <?php if (isset($_GET['signin']) && $_GET['signin']=="BAD_VALIDATION" && isset($_GET['method']) && isset($_GET['data'])): ?>
                    <div class="px-5 alert alert-danger alert-dismissible fade show" role="alert">
                        Error, el <?php if ($_GET['method']=="email") echo "correo"; else if($_GET['method']=="phone") echo "teléfono"?> '<?php echo $_GET['data']?>' no es válido
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php elseif (isset($_GET['signin']) && $_GET['signin']=="BAD"): ?>
                    <div class="px-5 alert alert-danger alert-dismissible fade show" role="alert">
                        Error al acceder a estos servicios
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif;?>
                
            </div>
        </div>
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
                                        <div class="invalid-tooltip" id="id_inputusername_invalid">
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
                                <div class="btn-group px-5 mb-3" role="group">
                                    <input onclick="ChangeVaidation(true)" type="radio" value="email" class="btn-check" name="validation_type" id="btnradioemail" autocomplete="off" checked>
                                    <label class="btn btn-outline-secondary" for="btnradioemail"><i class="bi bi-envelope"></i></label>

                                    <input onclick="ChangeVaidation(false)" type="radio" value="phone" class="btn-check" name="validation_type" id="btnradiophone" autocomplete="off">
                                    <label class="btn btn-outline-secondary" for="btnradiophone"><i class="bi bi-telephone"></i></label>

                                </div>
                                <div class="input-group mb-3" >
                                    <span class="input-group-text" id="validation_icon_input"><i class="bi bi-envelope"></i></span>
                                    <div class="form-floating">
                                        <input required oninput="validateEmail()" name="validation_data" type="text" class="form-control" id="inputvalidation" placeholder="Validación">
                                        <label for="inputvalidation" id="validation_label_input_id">Correo</label>
                                        <div class="invalid-tooltip" id="validation_invalid_id">
                                            El correo no es válido
                                        </div>
                                    </div>  
                                </div>
                            </div>
                            <button disabled id="btnRegister" class="btn btn-outline-secondary my-3"type="submit">Registrar <i class="bi h5 m-1 bi-box-arrow-right"></i></button>
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
    <script>
        var timer,timer1;
        var disabled_username=true;
        var disabled_password=true;
        var disabled_validation=true;
        var validation="email";
        function ChangeVaidation(bool)
        {
            if(bool==true)
            {
                validation="email";
                document.getElementById("inputvalidation").value=""
                document.getElementById("inputvalidation").oninput=validateEmail;
                document.getElementById("validation_invalid_id").innerHTML="El correo no es válido";
                document.getElementById("validation_icon_input").innerHTML="<i class='bi bi-envelope'></i>"
                document.getElementById("validation_label_input_id").innerHTML="Correo"
            }
            else
            {
                validation="phone";
                document.getElementById("inputvalidation").value="+53";
                document.getElementById("inputvalidation").oninput=validatePhone;
                document.getElementById("validation_invalid_id").innerHTML="El teléfono no es válido";
                document.getElementById("validation_icon_input").innerHTML="<i class='bi bi-telephone'></i>"
                document.getElementById("validation_label_input_id").innerHTML="Teléfono"
            }
        }
        
        function canEnableButton()
        {
            return disabled_username||disabled_password||disabled_validation;
        }

        function findUserNameExist()
        {
            document.getElementById("inputusername").className="form-control ";
            document.getElementById("spiner_loaduser").className="d-block spinner-border";
            document.getElementById("btnRegister").disabled=true;
            clearTimeout(timer);
            if(document.getElementById("inputusername").value==="")
            {
                document.getElementById("spiner_loaduser").className="d-none spinner-border";
            }
            else if(! /^[a-zA-Z0-9_]+$/.test(document.getElementById("inputusername").value))
            {
                document.getElementById("inputusername").className="form-control is-invalid";
                document.getElementById("spiner_loaduser").className="d-none spinner-border";
                document.getElementById("btnRegister").disabled=true;
                disabled_username=true;
                document.getElementById("id_inputusername_invalid").innerHTML="Formato de nombre de usuario no válido";
            }
            else
            {
                document.getElementById("id_inputusername_invalid").innerHTML="Nombre de usuario en uso, utilize otro";
                timer=setTimeout(()=>{
                    
                    fetch('./includes/ajax.php', {
                    method: 'POST',
                    headers: {
                    'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({"action":"findUser", "username": document.getElementById("inputusername").value}),
                    })
                    .then(response => response.json())
                    .then(data => {
                        if(data.result==false)
                        {
                            document.getElementById("inputusername").className="form-control is-valid";
                            document.getElementById("spiner_loaduser").className="d-none spinner-border";
                            disabled_username=false;
                            document.getElementById("btnRegister").disabled=canEnableButton();  
                        }
                        else
                        {
                            document.getElementById("inputusername").className="form-control is-invalid";
                            document.getElementById("spiner_loaduser").className="d-none spinner-border";
                            document.getElementById("btnRegister").disabled=true;
                            disabled_username=true;
                        }
                        

                    })
                    .catch(error => {
                        console.log("error:",error)
                        document.getElementById("inputusername").className="form-control is-invalid";
                        document.getElementById("spiner_loaduser").className="d-none spinner-border";
                        document.getElementById("btnRegister").disabled=true;
                        disabled_username=true;
                    });
                },1000);
            }
        }

        function confirmPasswords()
        {
            if(document.getElementById("inputpassword").value !="" && document.getElementById("inputpassword").value === document.getElementById("inputconfirmpassword").value)
            {
                document.getElementById("inputpassword").className="form-control is-valid";
                document.getElementById("inputconfirmpassword").className="form-control is-valid";
                disabled_password=false;
                document.getElementById("btnRegister").disabled=canEnableButton();
            }
            else
            {
                if (document.getElementById("inputpassword").value==="" && document.getElementById("inputconfirmpassword").value==="")
                {
                    document.getElementById("inputpassword").className="form-control";
                    document.getElementById("inputconfirmpassword").className="form-control";
                }
                else
                {
                    document.getElementById("inputpassword").className="form-control is-invalid";
                    document.getElementById("inputconfirmpassword").className="form-control is-invalid";
                }
                document.getElementById("btnRegister").disabled=true;
                disabled_password=true;
            }
            
        }
        function findValidation()
        {
            document.getElementById("inputvalidation").className="form-control ";
            document.getElementById("spiner_loaduser").className="d-block spinner-border";
            document.getElementById("btnRegister").disabled=true;
            clearTimeout(timer1);
            if(validation==="email")
                document.getElementById("validation_invalid_id").innerHTML="Correo en uso, utilize otro";
            else if(validation==="phone")
                document.getElementById("validation_invalid_id").innerHTML="Teléfono en uso, utilize otro";
            else
                document.getElementById("validation_invalid_id").innerHTML="Metódo de validación en uso, utilize otro";
            //var _validation=document.getElementById("btnradioemail").checked;
            timer1=setTimeout(()=>{
            
                fetch('./includes/ajax.php', {
                method: 'POST',
                headers: {
                'Content-Type': 'application/json',
                },
                body: JSON.stringify({"action":"findValidation","data":document.getElementById("inputvalidation").value}),
                })
                .then(response => response.json())
                .then(data => {
                    if(data.result==false)
                    {
                        document.getElementById("inputvalidation").className="form-control is-valid";
                        document.getElementById("spiner_loaduser").className="d-none spinner-border";
                        disabled_validation=false;
                        document.getElementById("btnRegister").disabled=canEnableButton();  
                    }
                    else
                    {
                        document.getElementById("inputvalidation").className="form-control is-invalid";
                        document.getElementById("spiner_loaduser").className="d-none spinner-border";
                        document.getElementById("btnRegister").disabled=true;
                        disabled_validation=true;
                    }
                })
                .catch(error => {
                    console.log("error:",error)
                    document.getElementById("validation_invalid_id").innerHTML="Error al conectar al servidor";
            
                    document.getElementById("inputvalidation").className="form-control is-invalid";
                    document.getElementById("spiner_loaduser").className="d-none spinner-border";
                    document.getElementById("btnRegister").disabled=true;
                    disabled_validation=true;
                });
            },1000);
        }
        function validateEmail() 
        {
            let regex = /^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,10})+$/;
            if (document.getElementById("inputvalidation").value==="")
            {
                document.getElementById("inputvalidation").className="form-control";
            }
            else if(regex.test(document.getElementById("inputvalidation").value))
            {
                findValidation()
            }
            else
            {
                document.getElementById("validation_invalid_id").innerHTML="Formato de correo no válido";
                document.getElementById("inputvalidation").className="form-control is-invalid";
                disabled_validation=true;
                document.getElementById("btnRegister").disabled=true;
            }
        }
        function validatePhone() 
        {
            let re = /^\+?\d{10,15}$/;
            if (document.getElementById("inputvalidation").value==="")
            {   
                document.getElementById("inputvalidation").className="form-control";
            }
            else if(re.test(document.getElementById("inputvalidation").value))
            {
                findValidation();
            }
            else
            {
                document.getElementById("validation_invalid_id").innerHTML="Formato de teléfono no válido";
                document.getElementById("inputvalidation").className="form-control is-invalid";
                disabled_validation=true;
                document.getElementById("btnRegister").disabled=true;
            }
        }
    </script>
</body>
<?php require 'views/_footer.html'; ?>