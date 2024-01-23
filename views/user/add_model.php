<?php
    include_once '../../includes/login.php';
?>
<?php 
    include_once '../../includes/bot.php';
    $bot=new Bot();

    if(!$bot->existSessionUser())
        die("Session Error");
?>
<?php require('../_head.html'); ?>
<body class="text-center bg-dark text-light">
    <?php require('../_navbar.php'); ?>
    <div class="container-fluid h-100 pt-5">
        <div class="row h-100">
            <div class="col-12 col-md-4 ">
                <div class="row h-100 align-items-center">
                    <form id="_form" action="../../includes/upload_file.php" method="post" enctype="multipart/form-data">
                            
                        <div class="row justify-content-center">
                            <div class="d-none" id="id_btn_upload">
                                <div class="col-auto">
                                        <input required type="file" accept=".stl" id="fileSTL" name="file" style="display: none;">
                                        <label for="fileSTL" id="label_load_file"class="text-dark p-3 bg-danger rounded-pill h4 focus-transition">Cargar fichero</label>                               
                                </div>
                            </div>
                        </div>
                        <div id="id_div_all_row" class="d-none">
                            <div class="row m-2" >
                                <div class="col">
                                    <?php $filaments=$bot->getFilaments()?>
                                    <label for="id_filament">Filamento</label>
                                    <select required id="id_filament" name="filament" class="form-select">
                                        <?php foreach ($filaments as $filament):?>
                                            <option data-price="<?php echo $filament['price']?>" value="<?php echo $filament['id']?>"><?php echo $filament['name']?></option>
                                        <?php endforeach;?>
                                        <option value="" disabled  selected></option>
                                    </select>
                                </div>
                            </div>
                            <div class="row m-2 d-none" id="id_div_spinner">
                                <div class="col">
                                    <div class="spinner-border text-primary h2" role="status">
                                        <span class="visually-hidden">Cargando...</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row m-2 d-none" id="id_div_color">
                                <div class="col">
                                    <?php $filament_colors=$bot->getFilamentColors($filaments[0]['id'])?>
                                    <label for="id_filament_color">Color</label>
                                    <select required name="filament_color" class="form-select" id="id_filament_color">
                                        <?php foreach ($filament_colors as $filament_color):?>
                                            <!-- <option value="<?php echo $filament_color['id']?>"><?php echo $filament_color['color']?></option> -->
                                        <?php endforeach;?>
                                    </select>
                                </div>
                            </div>
                            <div class="row text-center d-none mt-5 justify-content-center" id="id_div_price">
                                <div class="col-auto">
                                    <div class="text-dark bg-light rounded-pill h6 px-3">
                                        Precio por unidad de filamento<br><span class="text-success">
                                            $<span id="id_span_price">
                                                10
                                            </span>
                                        </span>
                                        </div>   
                                </div>
                            </div>
                            <div class="row d-none m-2 justify-content-center" id="id_btn_send">
                                <div class="col-auto">
                                    <button class=" btn btn-outline-secondary" type="submit">Enviar</button>   
                                </div>
                            </div>
                            
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-12 col-md-8 p-3">
                <div class="container h-100">
                    <div style="position: relative; top: 40%;">   
                        <div id="load_id" class="d-none text-dark" style="position: absolute; left: 50%;transform: translateX(-50%)">
                            <div class="container">
                                <div class="row" id="row_load_id_error">
                                    <div class='badge bg-danger'>
                                        <span class='h4'>
                                            Error<br>
                                            <span class='h6'>
                                                Error al cargar modelo
                                            </span>
                                        </span>
                                    </div>
                                </div>
                                <div class="row" id="row_load_id">
                                    <div class="col-auto d-block" >
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
                    <div style="position: relative;">
                        <div style="position: absolute; left: 50%;transform: translateX(-50%)">
                            
                        </div>
                    </div>
                    <div class="h-100" id="id_scene"></div>
                </div>
            </div>
        </div>
    </div>
    
    
<script>
    function updateClass(id,old_class,new_class)
    {
        document.getElementById(id).classList.remove(old_class);
        document.getElementById(id).classList.add(new_class);
    }
    function showElement(id)
    {
        document.getElementById(id).classList.remove("d-none");
    }
    function hideElement(id)
    {
        document.getElementById(id).classList.remove("d-block");
        document.getElementById(id).classList.add("d-none");
    }
    // function changeFilament()
    // {
    //     showElement("id_div_spinner");
    //     //document.getElementById("id_div_spinner").className="row my-4 d-block";
    //     //document.getElementById("id_div_color").className="row m-2 d-none";
    //     hideElement("id_div_color");
    //     fetch('./ajax/_colors.php', {
    //         method: 'POST',
    //         headers: {
    //             'Content-Type': 'application/x-www-form-urlencoded',
    //         },
    //         body: 'filament=' + document.getElementById("id_filament").value,
    //     })
    //     .then(response => response.text())
    //     .then(html => {
    //         let select = document.getElementById("id_filament");
    //         let price = select.options[select.selectedIndex].getAttribute("data-price");
    //         showElement("id_div_price");
    //         //document.getElementById("id_div_price").className="row text-light text-center justify-content-center mt-5 d-block";
    //         document.getElementById('id_span_price').innerHTML=price;
    //         document.getElementById('id_filament_color').innerHTML = html;
    //         hideElement("id_div_spinner");
    //         //document.getElementById("id_div_spinner").className="row my-4 d-none";
    //         showElement("id_div_color");
    //         //document.getElementById("id_div_color").className="row m-2 d-block";
    //         mesh.material.color.setHex(0xaaaaaa);
    //     })
    //     .catch(error => console.warn(error));
    // }
</script>
<script type="module">
    import * as THREE from '../../libs/threejs/three.module.js';
    /*Is Neceesary Change modeule/
        import {
            ...,
            ...,
        } from './three.module.js';
    */
    import { OrbitControls } from '../../libs/threejs/OrbitControls.js';
    import { STLLoader } from '../../libs/threejs/STLLoader.js';

    var scene = new THREE.Scene();

    var renderer = new THREE.WebGLRenderer();
    
    var container=document.getElementById("id_scene");
    container.appendChild(renderer.domElement);
    renderer.setSize(container.clientWidth, container.clientHeight);    
    renderer.setClearColor(0xC0C0C0);

    //var camera = new THREE.OrthographicCamera(-1000, 10000, 10000, -10000, -10000, 10000);
    var camera = new THREE.PerspectiveCamera(75, container.clientWidth / container.clientHeight, 0.1, 1000);
    

    var controls = new OrbitControls(camera, renderer.domElement);
    var loader = new STLLoader();
    var mesh,mesh_bool=false;
    loader.setCrossOrigin('anonymous');

    
    document.getElementById('id_filament').addEventListener('change', (event)=>{
        showElement("id_div_spinner");
        hideElement("id_div_color");
        fetch('./ajax/_colors.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'filament=' + document.getElementById("id_filament").value,
        })
        .then(response => response.text())
        .then(html => {
            let select = document.getElementById("id_filament");
            let price = select.options[select.selectedIndex].getAttribute("data-price");
            showElement("id_div_price");
            document.getElementById('id_span_price').innerHTML=price;
            document.getElementById('id_filament_color').innerHTML = html;
            hideElement("id_div_spinner");
            showElement("id_div_color");
            mesh.material.color.setHex(0xaaaaaa);
        })
        .catch(error => console.warn(error));
    });

    document.getElementById('id_filament_color').addEventListener('change', (event)=>{
        let select = document.getElementById("id_filament_color");
        
        let color = select.options[select.selectedIndex].getAttribute("data-color");
        try
        {
            mesh.material.color.setHex(parseInt(color.replace("#", ""), 16));
        }catch(e){}
        showElement("id_btn_send")
        //document.getElementById("id_btn_send").className="row d-block";
    });
    document.getElementById('fileSTL').addEventListener('change', (event)=>
    {
        //document.getElementById("row_load_id").className="row d-block";
        showElement("row_load_id");
        hideElement("row_load_id_error");
        showElement("load_id");
        hideElement("id_div_price");
        hideElement("id_btn_send");
        //document.getElementById("row_load_id_error").className="row d-none";
        //document.getElementById("load_id").className="d-block text-dark";
        //document.getElementById("id_div_price").classList.remove("d-block");
        //document.getElementById("id_div_price").classList.add("d-none");//className="row text-light text-center justify-content-center mt-5 d-none";
        //document.getElementById("id_btn_send").classList.remove("d-block");
        //document.getElementById("id_btn_send").classList.add("d-none");//className="row  d-none";
            
        scene.children.forEach(
            function(object)
            {
                if (object instanceof THREE.Mesh) 
                {
                    if (object.geometry) 
                        object.geometry.dispose();
                    
                    if (object.material) {
                        if (!Array.isArray(object.material))
                            object.material.dispose();
                        else 
                        {
                            for (var i = 0; i < object.material.length; i++) 
                                object.material[i].dispose();
                        }
                    }
                    scene.remove(object);
                }
            }
        )
        var reader = new FileReader();
        reader.readAsArrayBuffer(event.target.files[0]);
        
        reader.onload = function(event) {
            var arrayBuffer = event.target.result;
            try{
                var base64 = btoa(String.fromCharCode.apply(null, new Uint8Array(arrayBuffer)));
            }catch(e){}
            var url = 'data:application/octet-stream;base64,' + base64;
            loader.load(
                url, 
                function (geometry) 
                {   
                    showElement("id_div_all_row");
                    hideElement("id_div_color");
                    //document.getElementById("id_div_all_row").className="d-block";
                    //document.getElementById("id_div_color").className="row m-2 d-none";
                    let select = document.getElementById("id_filament");
                    let ultimaOpcionIndice = select.options.length - 1;
                    select.selectedIndex = ultimaOpcionIndice;
                    hideElement("load_id");
                    //document.getElementById("load_id").className="d-none text-dark";
                    updateClass("label_load_file","bg-danger","bg-success");
                    //document.getElementById("label_load_file").className="text-dark p-3 bg-success rounded-pill h4 focus-transition"
                    var material = new THREE.MeshPhongMaterial({color: 0xaaaaaa, specular: 0x111111, shininess: 200});
                    mesh = new THREE.Mesh(geometry, material);
                    mesh_bool=true;
                    var box = new THREE.Box3().setFromObject(mesh);
                    var center = box.getCenter(new THREE.Vector3());
                    var size = box.getSize(new THREE.Vector3()).length();
                    camera.lookAt(center);
                    mesh.position.sub(center);
                    
                    camera.position.copy(center);
                    camera.position.x = size /1.5 ;
                    camera.position.y = size /1.5 ;
                    camera.position.z = size /1.5  ;
                    camera.lookAt(center);
                    scene.add(mesh);
                },
                function (xhr) 
                {
                    document.getElementById("span_load_id").innerHTML=((xhr.loaded / xhr.total) * 100).toFixed(2);
                    if((xhr.loaded / xhr.total) > 0.75)
                        document.getElementById("color_load_id").className="text-success";
                    else if((xhr.loaded / xhr.total) > 0.50)
                        document.getElementById("color_load_id").className="text-warning";
                    else if((xhr.loaded / xhr.total )> 0.25)
                        document.getElementById("color_load_id").className="text-dark";
                    else
                        document.getElementById("color_load_id").className="text-secondary";
                },
                function (error) 
                {
                    hideElement("id_div_all_row");
                    updateClass("label_load_file","bg-success","bg-danger");
                    hideElement("row_load_id");
                    showElement("row_load_id_error")
                    //document.getElementById("id_div_all_row").className="d-none";
                    //document.getElementById("label_load_file").className="text-dark p-3 bg-danger rounded-pill h4 focus-transition"
                    //document.getElementById("row_load_id").className="row d-none";
                    //document.getElementById("row_load_id_error").className="row d-block";
                }
                
            );
        }
        
    });
    
    // Luz arriba
    var directionalLightUp = new THREE.DirectionalLight(0xffffff, 0.5);
    directionalLightUp.position.set(0, 1, 0);
    scene.add(directionalLightUp);

    // Luz abajo
    var directionalLightDown = new THREE.DirectionalLight(0xffffff, 0.5);
    directionalLightDown.position.set(0, -1, 0);
    scene.add(directionalLightDown);

    // Luz derecha
    var directionalLightRight = new THREE.DirectionalLight(0xffffff, 0.5);
    directionalLightRight.position.set(1, 0, 0);
    scene.add(directionalLightRight);

    // Luz izquierda
    var directionalLightLeft = new THREE.DirectionalLight(0xffffff, 0.5);
    directionalLightLeft.position.set(-1, 0, 0);
    scene.add(directionalLightLeft);

    // Luz frente
    var directionalLightFront = new THREE.DirectionalLight(0xffffff, 0.5);
    directionalLightFront.position.set(0, 0, 1);
    scene.add(directionalLightFront);

    // Luz atrás
    var directionalLightBack = new THREE.DirectionalLight(0xffffff, 0.5);
    directionalLightBack.position.set(0, 0, -1);
    scene.add(directionalLightBack);

    // Luz indirecta superior derecha
    var directionalLightIndirectTopRight = new THREE.DirectionalLight(0xffffff, 0.5);
    directionalLightIndirectTopRight.position.set(1, 1, 0);
    scene.add(directionalLightIndirectTopRight);

    // Luz indirecta inferior derecha
    var directionalLightIndirectBottomRight = new THREE.DirectionalLight(0xffffff, 0.5);
    directionalLightIndirectBottomRight.position.set(1, -1, 0);
    scene.add(directionalLightIndirectBottomRight);

    // Luz indirecta inferior izquierda
    var directionalLightIndirectBottomLeft = new THREE.DirectionalLight(0xffffff, 0.5);
    directionalLightIndirectBottomLeft.position.set(-1, -1, 0);
    scene.add(directionalLightIndirectBottomLeft);


    

    
    // Función de animación
    function animate() 
    {
        requestAnimationFrame(animate);
        controls.update();
        //if(mesh_bool==true)
            //mesh.rotateOnAxis(new THREE.Vector3(0, 1, 0), 0.0005);
        
   
        renderer.render(scene, camera);
    }
    
    //Iniciar la animación
    animate();
    document.getElementById("id_btn_upload").classList.remove("d-none")
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
<?php require '../_footer.html'; ?>