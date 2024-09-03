<?php 

    $host = '';
    $dbname = '';
    $username = '';
    $password = '';

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8",
        $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //echo "conexion exitosa";
    } catch (PDOException $e) {
        die("Error de conexión: " . $e->getMessage());
    }    


    if (isset($_POST['nombre']) && isset($_POST['correo']) && isset($_POST['taller'])
        && isset($_POST['instit']) && isset($_POST['ciudad'])
        ){
        
        $stmt = $pdo->prepare("SELECT ast.nombre as asistente, ast.estado as estado, ast.correo as correo, 
            tll.taller as taller, tll.id as taller_id, tll.dia as taller_dia
        FROM asistentes as ast , talleres as tll
        WHERE ast.taller=tll.id and ast.correo = '".$_POST['correo']."'
        ");    

        $stmt->execute();
        $talleres = $stmt->fetchAll(PDO::FETCH_ASSOC);       
        
        $total = count($talleres);


        $stmt = $pdo->prepare("SELECT  talleres.id, talleres.taller, talleres.dia
        FROM  talleres  WHERE talleres.id = ".$_POST['taller']);    
        $stmt->execute();
        $taller_solicitado = $stmt->fetchAll(PDO::FETCH_ASSOC);      
        
        if($total ==0 || $total ==1) {

          if( $total ==1 && $talleres[0]['taller_dia']==3){
            $msg = [ "msg"=>"Usted ya ha sido apuntado a un taller de dos días, use el enlace que se le ha enviado durante su inscripción para darse de baja en el el taller donde está inscrito y reinscribase al taller de su preferencia. <br> También puede comunicarse a simposio@mixteco.utm.mx si existe algún problema.","type"=> "error"];            
          } 
          else if($total == 1 &&  $talleres[0]['taller_dia']==  $taller_solicitado[0]['dia'])
          {

            // jueves
            if ($taller_solicitado[0]['dia']==1){
              $msg = [ "msg"=>"Usted ya se inscribió a un taller el día jueves. Sólo puede inscribirse a un taller para el día viernes. <br> También puede comunicarse a simposio@mixteco.utm.mx si existe algún problema.","type"=> "error"];            
            } 
            // viernes
            elseif ($taller_solicitado[0]['dia']==2){
              $msg = [ "msg"=>"Usted ya se inscribió a un taller el día viernes. Sólo puede inscribirse a un taller para el día jueves. <br> También puede comunicarse a simposio@mixteco.utm.mx si existe algún problema.","type"=> "error"];                        
            } 
          }
          else if ( ($total == 0) ||  ($total == 1 &&  $talleres[0]['taller_dia'] !=  $taller_solicitado[0]['dia']) )
          {


            $stmt = $pdo->prepare("INSERT INTO asistentes (nombre, correo, taller, estado, institucion, ciudad) VALUES 
            ('".$_POST['nombre']."', 
            '".$_POST['correo']."', 
            ".$_POST['taller'].", 1, '".$_POST['instit']."','".$_POST['ciudad']."' )");

            $stmt->execute();


            $url = 'https://www.utm.mx/~simposio/enviar_correo.php';

            $clave = base64_encode($_POST['correo']."/".$_POST['taller']);            
            $link_conf = 'https://simposio.utm.mx/confirmar.php?clave='.$clave;
            $link_canc = 'https://simposio.utm.mx/cancelar.php?clave='.$clave;


            // Data to be sent in the POST request
            $data = [
                'correo' => $_POST['correo'],
                'nombre' => $_POST['nombre'],
                'mensaje' => "Estimada(o) ".$_POST['nombre']. "\n\n Hemos recibido su petición para asistir al taller ". $taller_solicitado[0]['taller']
                . "\n\n Le pedimos que haga click en el siguiente enlace para confirmar su solicitud $link_conf "
                . "\n\n En caso de querer cancelar su participación haga click en el siguiente  enlace: $link_canc "
                ."\n\nSi tiene algún problema con la inscripción a los talleres, favor de comunicarse a simposio@mixteco.utm.mx "
                ."\n\nAtentamente \n Comité Organizador del \nX Simposio de Software Libre y \nCódigo Abierto de la Mixteca."
            ];


            // Initialize cURL
            $ch = curl_init($url);

            // Set the cURL options
            curl_setopt($ch, CURLOPT_POST, 1); // Set method to POST
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data)); // Attach the data
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Return the response as a string
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Content-Type: application/x-www-form-urlencoded'
            ]);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);



            // Execute the POST request
            $response = curl_exec($ch);
            // Check for errors
            if ($response === false) {
              //echo 'Error: ' . curl_error($ch);
              echo "&nbsp;";
            } else {
            // Process the response
              //echo 'Response: ' . $response;
              echo "&nbsp;";
            }

            $msg = [ "msg"=>"Su petición ha sido recibida. Favor de revisar su correo electrónico. <br/>En su correo electrónico recibirá un enlace para confirmar su inscripción. ",
                    "type"=> "success"
                  ];
                  
          }
        }
        else {
            $msg = [ "msg"=>"No puede inscribirse a este taller ya que: se ha registrado a algún taller que 2 días o intenta inscribirse a un taller en el mismo día en que ya se ha registrado a otro.","type"=> "error"];
        }

       
    }

    
    $stmt = $pdo->prepare("SELECT 
              ast.nombre as asistente, ast.estado as estado, ast.institucion as institucion,
              tll.taller as taller, tll.id as taller_id
            FROM asistentes as ast , talleres as tll
            WHERE ast.taller=tll.id
            ORDER BY tll.id, ast.estado desc, ast.updated
            ");
    $stmt->execute();
    $talleres = $stmt->fetchAll(PDO::FETCH_ASSOC);            
    
    //print_r($talleres);

?>
<!doctype html>
<html lang="en" data-bs-theme="auto">
  <head><script src="assets/color-modes.js"></script>
  


    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.122.0">
    <title>UTM - X Simposio de Software Libre y Código Abierto de la Mixteca</title>  
    

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">
    
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Favicons -->
<link rel="apple-touch-icon" href="docs/apple-touch-icon.png" sizes="180x180">
<link rel="icon" href="docs/favicon-32x32.png" sizes="32x32" type="image/png">
<link rel="icon" href="docs/favicon-16x16.png" sizes="16x16" type="image/png">
<link rel="manifest" href="docs/manifest.json">
<link rel="mask-icon" href="docs/safari-pinned-tab.svg" color="#712cf9">
<link rel="icon" href="docs/favicon.ico">
<meta name="theme-color" content="#712cf9">


    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

      .b-example-divider {
        width: 100%;
        height: 3rem;
        background-color: rgba(0, 0, 0, .1);
        border: solid rgba(0, 0, 0, .15);
        border-width: 1px 0;
        box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
      }

      .b-example-vr {
        flex-shrink: 0;
        width: 1.5rem;
        height: 100vh;
      }

      .bi {
        vertical-align: -.125em;
        fill: currentColor;
      }

      .nav-scroller {
        position: relative;
        z-index: 2;
        height: 2.75rem;
        overflow-y: hidden;
      }

      .nav-scroller .nav {
        display: flex;
        flex-wrap: nowrap;
        padding-bottom: 1rem;
        margin-top: -1px;
        overflow-x: auto;
        text-align: center;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch;
      }

      .btn-bd-primary {
        --bd-violet-bg: #712cf9;
        --bd-violet-rgb: 112.520718, 44.062154, 249.437846;

        --bs-btn-font-weight: 600;
        --bs-btn-color: var(--bs-white);
        --bs-btn-bg: var(--bd-violet-bg);
        --bs-btn-border-color: var(--bd-violet-bg);
        --bs-btn-hover-color: var(--bs-white);
        --bs-btn-hover-bg: #6528e0;
        --bs-btn-hover-border-color: #6528e0;
        --bs-btn-focus-shadow-rgb: var(--bd-violet-rgb);
        --bs-btn-active-color: var(--bs-btn-hover-color);
        --bs-btn-active-bg: #5a23c8;
        --bs-btn-active-border-color: #5a23c8;
      }

      .bd-mode-toggle {
        z-index: 1500;
      }

      .bd-mode-toggle .dropdown-menu .active .bi {
        display: block !important;
      }

      .shadow {
        box-shadow: 5px 5px 10px 2px rgba(0,0,0,.8);
      }
      
      .carousel-control-prev-icon {        
        background-image: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='ffffff' viewBox='0 0 8 8'%3E%3Cpath d='M5.25 0l-4 4 4 4 1.5-1.5-2.5-2.5 2.5-2.5-1.5-1.5z'/%3E%3C/svg%3E") !important;
        height: 70px;
        width: 70px; 
       }
       
       .carousel-control-next-icon {
         background-image: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='%2ffff'  viewBox='0 0 8 8'%3E%3Cpath d='M2.75 0l-1.5 1.5 2.5 2.5-2.5 2.5 1.5 1.5 4-4-4-4z'/%3E%3C/svg%3E") !important;
         height: 70px;
         width: 70px; 
       }
       

       .oval-container {
        width: 200px; /* Adjust width as needed */
        height: 200px; /* Adjust height as needed */
        overflow: hidden;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
      }
      .oval-container img {
        width: 100%;
        height: auto;
      }

      .gray-background {
        background-color: #808080; /* Gray background color */
        padding: 20px; /* Optional padding for spacing */
        display: flex;
        justify-content: center;
        align-items: center;
        width: 500px;
        height: 500px;
      }
      .rounded-image {
        border-radius: 3%;
        opacity: 0.85;
      }


            
      .nextprev:hover {
        box-shadow: 0 0 15px rgba(133, 133, 133, 0.82); 
      }

            
      a:link {
        text-decoration: none;
      }

      a:visited {
        text-decoration: none;
      }

      a:hover {
        text-decoration: underline;
      }

      a:active {
        text-decoration: underline;
      }

      .nav-tabs>li.active>a, .nav-tabs>li.active>a:focus, .nav-tabs>li.active>a:hover{
        border-top: none;
        border-left: none;
        border-right: none;
        border-bottom: 3px solid #e9a39c;
        font-weight: bold;
        background-color: #d4d4d4 !important;
        /* NEW ADDED PART (START) */
        /*color: #3c5a78 !important; */
        /*font-family:  YOUR-FONT FAMILY !important;*/
        /* NEW ADDED PART (END) */
       
       }


              
        /* NEW ADDED PART (START) */
        .nav-tabs>li>a {
          color: #575757 !important;
          /*font-family:  YOUR-FONT FAMILY !important;*/
        }


        ul.nav > li > a:hover {
          background-color: #000000;
          color: #FFFFFF;
          border-style: none;
        }
  
    </style>

    
    <!-- Custom styles for this template -->
    <link href="css/carousel.css" rel="stylesheet">
  </head>
  <body>
    <svg xmlns="http://www.w3.org/2000/svg" class="d-none">
      <symbol id="check2" viewBox="0 0 16 16">
        <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z"/>
      </symbol>
      <symbol id="circle-half" viewBox="0 0 16 16">
        <path d="M8 15A7 7 0 1 0 8 1v14zm0 1A8 8 0 1 1 8 0a8 8 0 0 1 0 16z"/>
      </symbol>
      <symbol id="moon-stars-fill" viewBox="0 0 16 16">
        <path d="M6 .278a.768.768 0 0 1 .08.858 7.208 7.208 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277.527 0 1.04-.055 1.533-.16a.787.787 0 0 1 .81.316.733.733 0 0 1-.031.893A8.349 8.349 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.752.752 0 0 1 6 .278z"/>
        <path d="M10.794 3.148a.217.217 0 0 1 .412 0l.387 1.162c.173.518.579.924 1.097 1.097l1.162.387a.217.217 0 0 1 0 .412l-1.162.387a1.734 1.734 0 0 0-1.097 1.097l-.387 1.162a.217.217 0 0 1-.412 0l-.387-1.162A1.734 1.734 0 0 0 9.31 6.593l-1.162-.387a.217.217 0 0 1 0-.412l1.162-.387a1.734 1.734 0 0 0 1.097-1.097l.387-1.162zM13.863.099a.145.145 0 0 1 .274 0l.258.774c.115.346.386.617.732.732l.774.258a.145.145 0 0 1 0 .274l-.774.258a1.156 1.156 0 0 0-.732.732l-.258.774a.145.145 0 0 1-.274 0l-.258-.774a1.156 1.156 0 0 0-.732-.732l-.774-.258a.145.145 0 0 1 0-.274l.774-.258c.346-.115.617-.386.732-.732L13.863.1z"/>
      </symbol>
      <symbol id="sun-fill" viewBox="0 0 16 16">
        <path d="M8 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8zM8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0zm0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13zm8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5zM3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8zm10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0zm-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0zm9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707zM4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708z"/>
      </symbol>
    </svg>
    <div class="dropdown position-fixed bottom-0 end-0 mb-3 me-3 bd-mode-toggle">
      <button class="btn btn-bd-primary py-2 dropdown-toggle d-flex align-items-center"
              id="bd-theme"
              type="button"
              aria-expanded="false"
              data-bs-toggle="dropdown"
              aria-label="Cambiar tema (auto)">
        <svg class="bi my-1 theme-icon-active" width="1em" height="1em"><use href="#circle-half"></use></svg>
        <span class="visually-hidden" id="bd-theme-text">Cambiar tema</span>
      </button>
      <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="bd-theme-text">
        <li>
          <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="light" aria-pressed="false">
            <svg class="bi me-2 opacity-50" width="1em" height="1em"><use href="#sun-fill"></use></svg>
            Brillante
            <svg class="bi ms-auto d-none" width="1em" height="1em"><use href="#check2"></use></svg>
          </button>
        </li>
        <li>
          <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="dark" aria-pressed="false">
            <svg class="bi me-2 opacity-50" width="1em" height="1em"><use href="#moon-stars-fill"></use></svg>
            Oscuro
            <svg class="bi ms-auto d-none" width="1em" height="1em"><use href="#check2"></use></svg>
          </button>
        </li>
        <li>
          <button type="button" class="dropdown-item d-flex align-items-center active" data-bs-theme-value="auto" aria-pressed="true">
            <svg class="bi me-2 opacity-50" width="1em" height="1em"><use href="#circle-half"></use></svg>
            Auto
            <svg class="bi ms-auto d-none" width="1em" height="1em"><use href="#check2"></use></svg>
          </button>
        </li>
      </ul>
    </div>

    
<header data-bs-theme="dark">
  <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="http://www.utm.mx">UTM</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav me-auto mb-2 mb-md-0">
          <li class="nav-item">
            <a class="nav-link " aria-current="page" href="index.html">Conferencias</a>
          </li>          
          <li class="nav-item">
            <a class="nav-link" href="participantes.html">Participantes</a>
          </li> 
          <li class="nav-item">
            <a class="nav-link" href="talleres.html">Talleres</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="localizacion.html">Localización</a>
          </li>
          
          <li class="nav-item d-flex">
            <a class="nav-link text-warning active" href="inscripciones.php"> Inscripción a los talleres</a>
          </li>
          
        </ul>
        <!--form class="d-flex" role="search">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form-->
      </div>
    </div>
  </nav>
</header>

<main>




  <!-- Marketing messaging and featurettes
  ================================================== -->
  <!-- Wrap the rest of the page in another container to center all the content. -->

  <div class="container marketing">
          
    <br>
    <div class="row featurette my-2 p-2">
      <div class="col text-center">
        <h2>Inscripción a talleres</h2>
      </div>
    </div>
    
    <hr class="py-2">     

    <div class="row featurette my-2 p-2">

        <form method='post' action='inscripciones.php'>

        <div class="mb-3">

            <div class='container'>
                <div class='row justify-content-md-center'>

                    <div class="mb-3 col col-lg-8">
                        <h4>Proporciona los siguientes datos para inscribirte al taller: </h4>
                    </div>
                    

                    <div class="mb-3 col col-lg-8">
                        <label for="nombre" class="form-label">Nombre:</label>
                        <input type="text"  id="nombre" name="nombre" placeholder='Tu(s) nombre(s) y Apellido(s) - se generará constancia electrónica de participación a los asistentes.' class="w-100 form-control" maxlength="80" >
                    </div>
                    
                    <div class='mb-3 col col-lg-8'>
                        <label for="correo" class="form-label">Correo electrónico</label>
                        <input type="email" class="form-control" id="correo" name="correo" placeholder='tucorreo@servidor.com'  >
                    </div>

                    
                    <div class='mb-3 col col-lg-8'>
                        <label for="instit" class="form-label">Institución de procedencia</label>
                        <input type="text" class="form-control" id="instit" name="instit"  placeholder="Institución o centro educativo desde donde nos visitarás: COBAO 08, Universidad Tecnológica de la Mixteca, etc"  maxlength="90">
                    </div>


                    <div class='mb-3 col col-lg-8'>
                        <label for="ciudad" class="form-label">Ciudad o localidad desde donde nos visitarás</label>
                        <input type="text" class="form-control" id="ciudad" name="ciudad" placeholder='Tu ciudad o localidad de procedencia: Huajuapan de León, Oaxaca de Juárez, etc.'   maxlength="90">
                    </div>



                    <div class='mb-3 col col-lg-8'>
                        <label for="taller" class="form-label">Selecciona el taller de tu interés</label>
                        <select class="form-select" aria-label="Selecciona un taller" id="taller" name='taller' >
                            <option value="" selected>Selecciona un taller</option>
                            <option value="1">Programación básica en python (Jueves + Viernes).</option>
                            <option value="2">Hardware y software libre en la educación (Jueves).</option>
                            <option value="3">Algoritmos de Machine Learning en Python. (Jueves).</option>
                            <option value="4">Creación de un chatbot con LLama2 usando Langchain y desplegado usando Truss (Jueves + Viernes).</option>
                            <option value="5">FastAPI-Construcción de API’s con Python (Jueves + Viernes).</option>
                            <option value="6">Desarrollo de aplicaciones web con MODx CMS (Jueves + Viernes).</option>
                            <option value="7">Erlang: El paradigma funcional para resolver problemas concurrentes (Jueves + Viernes).</option>
                            <option value="8">Python una herramienta de apoyo en el aprendizaje del Cálculo (Jueves + Viernes).</option>
                            <option value="9">Uso del lenguaje SPARQL para generar y consultar datos abiertos (Viernes).</option>
                        </select>
                    </div>


                    <div class='mb-3 col col-lg-8 text-center'>
                    

                        <button type="submit" class='btn btn-primary w-50' id="enviar" disabled> Enviar solicitud </button>
                        <br>
                        
                            <?php 
                                //print_r($msg);
                                if (isset($msg))   {
                                    if ($msg['type'] =='success'){
                                        echo "\n\n<div id='mensaje' class='w-100 text-success'>&nbsp;".$msg['msg']."</div>";
                                    }
                                    else if ($msg['type']=='error'){
                                        echo "\n\n<div id='mensaje' class='w-100 text-warning'>&nbsp;".$msg['msg']."</div>";
                                    }

                                }
                                else{
                                    echo "<div id='mensaje' class='w-100'>\n&nbsp;</div>";
                                }
                                
                            ?>

                        
                    </div>

                    
                    
                </div>

            </div>
             
            
        </div>


        </form>

    
         
    </div>

    <div class="row featurette my-2 p-2">

        <div class="col text-center">
            <h2>Inscritos a talleres </h2>
        </div>

        
        <div class='container'>
            <div class='row justify-content-md-center'>

            
            <?php 
                $prev = "";
                $cont = 1;
                foreach ($talleres as $clave => $valor){

                    if($prev == "" || $prev != $valor['taller_id'] ){
                        if ( $prev != ""){
                            echo "\n</table>\n<br><br><br><br>\n\n";                                   
                        }                        
                        echo "\n<table class='table w-100'>\n <tr><th class='bg-success' colspan=5>".$valor['taller']."</th></tr>\n <tr><th>NP</th><th>Nombre</th><th>Estado</th><th>Instución de procedencia</th><th>&nbsp;</th> </tr>";                            
                        $cont = 1;
                    }
                    //echo "\n<tr><td>".$clave ."</td>";
                    echo "\n<tr><td>".$cont ."</td>";

                    echo "\n<td>"; 
                    echo strtoupper($valor['asistente']);
                    echo "</td>"; 

                    echo "<td>"; 
                    echo $valor['estado']==1? 'En espera de confirmación (revisar su correo electrónico para confirmar)': 'Confirmado';
                    echo "</td>"; 

                    //instit

                    echo "<td>"; 
                    echo $valor['institucion'];
                    echo "</td>"; 

                    if($cont>20){
                      $obs = "En cola de espera";
                    }else{
                      $obs = "&nbsp;";
                    }
                    $cont +=1;
                    
                    echo "<td>"; 
                    echo $obs;
                    echo "</td>"; 

                    echo "</tr>";

                    $prev = $valor['taller_id'];
                }

                echo "\n</table>\n\n";           
            
            ?>
            </table>
            </div>
        </div>

    </div>

  </div><!-- /.container -->

  <script>

        document.addEventListener('DOMContentLoaded', function () {
            const nombreInput = document.getElementById('nombre');
            const correoInput = document.getElementById('correo');
            const tallerSelect = document.getElementById('taller');
            const enviarBtn = document.getElementById('enviar');

            function validarFormulario() {
                // Verificar si hay un nombre ingresado y una opción seleccionada
                const nombreValido = nombreInput.value.trim() !== '';
                const correoValido = correoInput.value.trim() !== '';
                const tallerValido = tallerSelect.value !== '';

                // Habilitar o deshabilitar el botón de envío
                enviarBtn.disabled = !(nombreValido && tallerValido && correoValido);
            }

            // Agregar eventos para validar el formulario cada vez que se cambian los valores
            nombreInput.addEventListener('input', validarFormulario);
            correoInput.addEventListener('input', validarFormulario);
            tallerSelect.addEventListener('change', validarFormulario);
        });
  </script>

  <!-- FOOTER -->
  <footer class="container">
    <p class="float-end"><a href="#">Ir al inicio de la página</a></p>
    <p>&copy; 2024 Universidad Tecnológica de la Mixteca &middot; <!--a href="#">Privacy</!--a> &middot; <a-- href="#">Terms</a--></p>
  </footer>
</main>
<script src="js/bootstrap.bundle.min.js"></script>

    </body>
</html>
