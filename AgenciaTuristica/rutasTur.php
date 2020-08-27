<?php
session_start();
$nmeCntaUs = $_SESSION['nombreCuentaUsuario'];
$resumenRT = $_SESSION['resumenRT'];
$r1 = 'Miguel Colorado - Palizada - El Tigre - Champoton';
$r2 = 'Balamku - Chicanna - Becan - Xpuhil - Calakmul';
$r3 = 'Edzna - Xtampak - Hopelchen - Grutas Xtacumbilxunaan - Xcalumkin - Hecelchakan';
$r = array($r1, $r2, $r3);
$ubicacion = array('img/1.jpg', 'img/2.jpg', 'img/3.jpg');
?>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="css/estilo.css">
        <title>Rutas turisticas</title>
    </head>
    <body style="margin-top:80px">
        <header>
            <nav class="navbar navbar-expand-sm bg-primary navbar-dark justify-content-center fixed-top">
                <a class="navbar-brand" href="#">iTourCamp</a>
                <ul class="navbar-nav">
                    <li class="nav-item">
                      <a class="nav-link" href="inicioCuentaUsuario.php">Inicio</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="rutasTur.php">Rutas turisticas</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="servEsp.php">Servicios turisticos especiales</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="artiTur.php">Articulos turisticos</a>
                    </li>

                     <!-- Dropdown -->
                    <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                        Mi cuenta
                      </a>
                      <div class="dropdown-menu">
                        <h2 class="container">Bienvenido <?php echo $nmeCntaUs;?></h2>
                        <a class="dropdown-item" href="editCnta.php">Editar datos de la cuenta</a>
                        <a class="dropdown-item" href="myBookings.php">Mis reservas de rutas turisticas</a>
                        <a class="dropdown-item" href="myArticles.php">Mis articulos turisticos comprados</a>
                        <a class="dropdown-item" href="mySpecialServices.php">Mis servicios especiales contratados</a>
                        <a class="dropdown-item" href="cerrarSesion.php">Cerrar sesion</a>
                      </div>
                    </li>

                </ul>
            </nav>
        </header>
        
        <main class="container">
            <div class="jumbotron jumbotron-fluid">'
                <h3 class="container text-center">¡Saca el maximo provecho de tu estancia en Campeche con nuestras rutas turisticas!</h3>
            </div>
            <div class="card-columns">
                <?php
                for ($i = 0; $i < count($r); $i++) {
                    echo '<div class="card" style="height:45em">';
                        echo '<img class="card-img-top" src="'.$ubicacion[$i].'" style="height:20em">';
                        echo '<div class="card-body">';
                            echo '<h4 class="card-title">'.$resumenRT[$i]['Nombre'].'</h4>';
                            echo '<h5 class="card-text">Recorrido:</h5>';
                            echo '<p class="card-text">'.$r[$i].'</p>';
                            echo '<h5 class="card-text">Fecha y hora de inicio:</h5>';
                            echo '<p class="card-text">'.$resumenRT[$i]['FechaRealizacion'].'</p>';
                            echo '<p class="card-text">Cupos disponibles: '.$resumenRT[$i]['Cupo'].'</p>';
                            echo '<p class="card-text">Precio por persona: $'.$resumenRT[$i]['PrecioPersona'].' MXN</p>';
                            echo '<a href="detallesRT.php?idruta='.$resumenRT[$i]['IDRuta'].'" class="btn btn-primary stretched-link">Ver detalles</a>';
                        echo '</div>';
                    echo '</div>';
                }
                ?>
            </div>    
        </main>
        
        <footer class="container-fluid">
            <p><p/>
            <h3 class="container-fluid text-center">Elaborado por:</h3>
            <p><p/>
            <h4 class="container-fluid text-center">Jose Manuel Gil</h4>
            <p><p/>
            <h4 class="container-fluid text-center">Santos Noe Huchin</h4>
            <p><p/>
            <h2 class="container-fluid text-center">&copy; Universidad Autónoma De Campeche</h2>
             <p><p/>
        </footer>
    </body>
</html>

