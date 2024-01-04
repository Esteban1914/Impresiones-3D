<?php require('views/_head.html'); ?>
<?php 
    include_once "includes/session.php";
    $session=new Session();
?>
<body class="text-center bg-dark text-light">
    <?php require('views/_navbar.php'); ?>
    <div class="contanier pt-5 ">
    <div class="row p-5"></div>
        <div class="row justify-content-center">
            <div class="col-auto">
                <div class="card bg-light mb-3" >
                    <div class="card-header display-5">Impresioes 3D</div>
                    <div class="card-body text-start">
                        <h5 class="card-title text-center">Desarollador</h5>
                        <p class="card-text text-center">Ing. Esteban Acevedo Santana</p>
                        <hr>    
                        <h5 class="card-title text-center">Conctacto</h5>
                        <p class="card-text"><strong>Email:</strong>   acevedoesteban999@gmail.com</p>
                        <p class="card-text"><strong>Telegram:</strong><a class="link-dark link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover"  href="https://t.me/EstebanACB2">   @EstebanACB2</a></p>
                        <p class="card-text"><strong>Linkedin:</strong><a class="link-dark link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover" href="https://linkedin.com/in/esteban-acevedo-santana-a73630288">  Esteban Acevedo Santana</a> </p>
                        <hr>
                    </div>
                </div>
            </div>
        </div>
    </div>
    


</body>




<?php require 'views/_footer.html'; ?>