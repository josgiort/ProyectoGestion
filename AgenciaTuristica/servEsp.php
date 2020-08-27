<?php
session_start();
include 'iniciarConexionBD.php';
$nmeCntaUs = $_SESSION['nombreCuentaUsuario'];
$ubicacion = array('img/serv/1.png', 'img/serv/2.jpg', 'img/serv/3.png', 'img/serv/4.jpg', 'img/serv/5.jpg');

try {
    $query = 'SELECT * FROM ServEspecial';
    $queryOutput = $mbd->prepare($query);
    $queryOutput->execute();
    $result = $queryOutput->fetchAll(PDO::FETCH_ASSOC);
    $queryOutput = null;

    $mbd = null;
} catch (PDOException $e) {
        print "¡Error!: " . $e->getMessage() . "<br/>";
        die();
    }
?>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="css/estilo.css">
        <title>Servicios turisticos especiales</title>
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
                <h3 class="container text-center">¡Disfruta aun mas tu ruta contratando uno de nuestros servicios especiales turisticos!</h3>
            </div>
            <div class="card-columns">
                <?php
                for ($i = 0; $i < count($ubicacion); $i++) {
                    echo '<div class="card" style="height:40em">';
                        echo '<img class="card-img-top" src="'.$ubicacion[$i].'" alt="Card image" style="height:20em">';
                        echo '<div class="card-body">';
                            echo '<h4 class="card-title">'.$result[$i]['Nombre'].'</h4>';
                            echo '<h5 class="card-text">Precio:</h5>';
                            echo '<p class="card-text">$'.$result[$i]['Precio'].' MXN</p>';
                            echo '<h5 class="card-text">Disponibles:</h5>';
                            echo '<p class="card-text">'.$result[$i]['Disponibles'].'</p>';
                            echo '<a href="contratarServicio.php?idserv='.$result[$i]['IDServEspecial'].'&img='.$ubicacion[$i].'" class="btn btn-primary stretched-link">Contratar</a>';
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