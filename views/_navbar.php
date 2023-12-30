<?php if(session_status() === PHP_SESSION_NONE) session_start();?>
<nav class="navbar navbar-dark navbar-expand-md bg-dark p-0">
    <a class="navbar-brand p-0 mx-3" href="./impresiones3d.php"><i class="bi bi-badge-3d h1"></i></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-start" id="navbarScroll">
            <div class="mx-5"></div>
            <ul class='navbar-nav'>
                <?php if(isset($_SESSION['user'])):?>
                    <li class='nav-item mx-3'>
                        <a class='nav-link active p-0' aria-current='page' href='home.php'><i class='bi bi-house-door h2'></i></a>
                    </li>
                <?php endif ?>
                <li class="nav-item mx-3">
                    <a class="nav-link active p-0" aria-current="page" href="#"><i class="bi bi-envelope-at h2"></i></a>
                </li>
            </ul>
        
        <ul class="navbar-nav justify-content-end w-100">
        <?php if(isset($_SESSION['user'])):?>
            <li class="nav-item mx-3">
                <a class="nav-link active  p-0" href="./telegram.php"  role="button"><i class="bi bi-telegram h1"></i></a>
            </li>

            <li class="nav-item dropdown mx-3">
                <a class="nav-link active dropdown-toggle  p-0" href="#" data-bs-toggle="dropdown" aria-expanded="false" role="button"><i class="bi bi-person-circle h1"></i></a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" ><?php echo "@".$_SESSION['user'] ?></a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="#">Perfil</a></li>
                    <li>
                        <form action="./includes/logout.php" method="post">
                            <button class="dropdown-item" type="submit">Desconectar</button>
                        </form>
                    </li>
                </ul>

            </li>

        <?php else: ?>
            <li class="nav-item mx-3">
                <a class="nav-link active p-0" href="./home.php"  role="button"><i class="bi bi-person-circle h1"></i></a>
            </li>
        <?php endif ?>
        </ul>
    </div>
</nav>

