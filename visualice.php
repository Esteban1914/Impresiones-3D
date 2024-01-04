<?php
    include_once 'includes/login.php';
?>
<?php 
    if(!isset($_GET['model_id']))
    {
        header('Location: home.php');
        exit;
    }
    $model_id=$_GET['model_id'];
    header("Access-Control-Allow-Origin: *");
?> 
<?php require('views/_head.html'); ?>
<body class="text-center bg-dark text-light">
    <?php require('views/_navbar.php'); ?>
       
    <div class="container-fluid h-100 pt-5">
        <div class="row h-100">
            <div class="col-3">
                    <?php 
                        include_once './includes/bot.php';
                        $bot=new Bot();
                    
                        if(!isset($_SESSION['user']))
                            die("Session Error");
                        $files=$bot->getFilesIDNameByUser($_SESSION['user']);
                    ?>
                    <?php if (!empty($files)): ?>
                        <div class="row h-100 align-items-center">
                            <div class="row"></div>
                            <?php foreach ($files as $row): ?>
                                <div class="row ms-2 my-2 ">
                                    <a href="?model_id=<?php echo $row['id'] ?>" class=" btn  btn-<?php if($row['id']==$model_id ) echo "success"; else echo "secondary" ?>">
                                        <span class="card-text h4">
                                            <?php echo $row['file_name']; ?>
                                        </span>
                                    </a>
                                </div>
                            <?php endforeach;?>
                            <div class="row"></div>
                        </div>
                    <?php else:?>
                        Nada
                    <?php endif;?>
            </div>
            <div class="col-9 p-5">
                <div style="position: relative; top: 40%;">   
                    <div id="load_id" class="text-dark" style="position: absolute; left: 50%;transform: translateX(-50%)">
                        <div class="container">
                            <div class="row" id="row_load_id">
                                <div class="col-auto" >
                                    <span class="h2">Cargando Modelo</span>
                                    <br>
                                    <div id="color_load_id" >
                                        <div class="spinner-border" style="width: 3rem; height: 3rem;" role="status">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                        <br>
                                        <span id="span_load_id" class="h5">0</span><span class="h5">%</span>
                                    </div>
                                </div>
                            </div>
                        </div> 
                    </div>       
                    
                </div>
                <div id="id_scene" class="h-100"></div>
            </div>
        </div>
    </div>




<script type="module">

    import * as THREE from './libs/threejs/three.module.js';
    /*Is Neceesary Change modeule/
        import {
            ...,
            ...,
        } from './three.module.js';
    */
    import { OrbitControls } from './libs/threejs/OrbitControls.js';
    import { STLLoader } from './libs/threejs/STLLoader.js';

    var scene = new THREE.Scene();

    var renderer = new THREE.WebGLRenderer();
    
    var container=document.getElementById("id_scene");
    container.appendChild(renderer.domElement);
    renderer.setSize(container.clientWidth, container.clientHeight);    
    renderer.setClearColor(0xC0C0C0);

    //var camera = new THREE.OrthographicCamera(-1000, 10000, 10000, -10000, -10000, 10000);
    var camera = new THREE.PerspectiveCamera(75, container.clientWidth / container.clientHeight, 0.1, 1000);
    camera.position.x = 50;
    camera.position.y = 50;
    camera.position.z = 50;

    var controls = new OrbitControls(camera, renderer.domElement);
    
    var loader = new STLLoader();
    loader.setCrossOrigin('anonymous');
    loader.load(
        '<?php echo $bot->getFileURLDownload($model_id) ?>', 
        function (geometry) 
        {
            document.getElementById("load_id").className="d-none";
            var material = new THREE.MeshPhongMaterial({color: 0xaaaaaa, specular: 0x111111, shininess: 200});
            var mesh = new THREE.Mesh(geometry, material);
            scene.add(mesh);
        },
        function (xhr) 
        {
            document.getElementById("span_load_id").innerHTML=(xhr.loaded / xhr.total) * 100;
            if((xhr.loaded / xhr.total) > 0.75)
                document.getElementById("color_load_id").className="text-success";
            else if((xhr.loaded / xhr.total) > 0.50)
                document.getElementById("color_load_id").className="text-warning";
            else if((xhr.loaded / xhr.total )> 0.25)
                document.getElementById("color_load_id").className="text-secondary";
            else
                document.getElementById("color_load_id").className="text-dark";
        },
        function (error) 
        {
            
            document.getElementById("row_load_id").innerHTML="<div class='badge bg-danger'><span class='h4'>Error<br><span class='h6'>Error al cargar modelo</span></span></div>";
        }
        
    );
    var ambientLight = new THREE.AmbientLight(0xffffff, 0.5);
    scene.add(ambientLight);
    
    var directionalLight3 = new THREE.DirectionalLight(0xffffff, 0.5);
    directionalLight3.position.set(0, -1, 0);
    scene.add(directionalLight3);

    var directionalLight = new THREE.DirectionalLight(0xffffff, 1);
    directionalLight.position.set(-1, -1, -1);
    scene.add(directionalLight);
    
    var directionalLight = new THREE.DirectionalLight(0xffffff, 1);
    directionalLight.position.set(1, 1, 1);
    scene.add(directionalLight);
    
    // Función de animación
    function animate() 
    {
        requestAnimationFrame(animate);
        controls.update();
        renderer.render(scene, camera);
    }
    
    //Iniciar la animación
    animate();
    window.addEventListener(
        'resize',
        function() 
        {
            renderer.setSize(container.clientWidth, container.clientHeight);    
            camera.aspect = container.clientWidth / container.clientHeight;
            camera.updateProjectionMatrix();
        }
    );

</script> 


</body>
<?php require 'views/_footer.html'; ?>
