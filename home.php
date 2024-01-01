<?php
    include_once 'includes/login.php';
?>
<?php require('views/_head.html'); ?>
<body class="text-center bg-dark">
    <?php require('views/_navbar.php'); ?>
    <div class="container text-light mt-5 pt-5">
        <div class="row justify-content-center">
            <div class="col-auto">
                <div class="display-4">
                    Hola @<?php echo $_SESSION['user'];?>
                </div>
            </div>
        </div>
    </div>
</body>
<?php require 'views/_footer.html'; ?>