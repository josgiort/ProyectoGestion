<?php
session_start();
$nmeCntaUs = $_SESSION['nombreCuentaUsuario'];
include 'aleatorioAT.php';
$aleatorioObjeto = new aleatorioAT();
$fotos = $aleatorioObjeto->generarFotos();
$nombreFotos = array(
    'img/sitios/1.jpg'=> 'Zona arqueologica de Calakmul',
    'img/sitios/2.jpg'=> 'Ciudad de Campeche',
    'img/sitios/3.jpg'=> 'Grutas de X’tacumbilxuna’an',
    'img/sitios/4.jpg'=> 'Isla Arena',
    'img/sitios/5.jpg'=> 'Palizada',
    'img/sitios/6.jpg'=> 'Champoton',
    'img/sitios/7.jpg'=> 'Zona arqueológica de Balamkú',
    'img/sitios/8.jpg'=> 'Zona arqueológica de Becán',
    'img/sitios/9.jpg'=> 'Zona arqueológica de Chicanná',
    'img/sitios/10.jpg'=> 'Zona arqueológica de Edzná',
    'img/sitios/11.jpg'=> 'Zona arqueológica del tigre',
    'img/sitios/12.jpg'=> 'Zona arqueológica de Santa Rosa Xtampak',
    'img/sitios/13.jpg'=> 'Zona arqueológica de Xpuhil',
    'img/sitios/14.jpg'=> 'Cenote Miguel Colorado',
    'img/sitios/15.jpg'=> 'Hopelchén',
    'img/sitios/16.jpg'=> 'Zona arqueológica de Xcalumkín',
    'img/sitios/17.jpg'=> 'Hecelchakán'
);

include 'iniciarConexionBD.php';
try {
    $query = 'SELECT * FROM SitioTuristico';
    $queryOutput = $mbd->prepare($query);
    $queryOutput->execute();
    $numeroSitios = $queryOutput->rowCount();
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
        
        <title>Inicio usuario</title>
    </head>
    <body style="margin-top:5em" data-spy="scroll" data-target="#myScrollspy" data-offset="1">
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
        
        <main>
            <div class="jumbotron jumbotron-fluid">'
                <h3 class="container text-center">¡Deleitate con los sitios turisticos mas legendarios de Campeche!</h3>
            </div>
            <div id="demo" class="carousel slide" data-ride="carousel">
                <ul class="carousel-indicators">
                  <li data-target="#demo" data-slide-to="0" class="active"></li>
                  <li data-target="#demo" data-slide-to="1"></li>
                  <li data-target="#demo" data-slide-to="2"></li>
                  <li data-target="#demo" data-slide-to="3"></li>
                </ul>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <?php echo '<img src="'.$fotos[0].'" width="1100" height="500">'?>
                      <div class="carousel-caption">
                        <h3><?php echo $nombreFotos[$fotos[0]]?></h3>
                      </div>   
                    </div>
                    <div class="carousel-item">
                        <?php echo '<img src="'.$fotos[1].'" width="1100" height="500">'?>
                        <div class="carousel-caption">
                          <h3><?php echo $nombreFotos[$fotos[1]]?></h3>
                        </div>   
                    </div>
                      <div class="carousel-item">
                        <?php echo '<img src="'.$fotos[2].'" width="1100" height="500">'?>
                        <div class="carousel-caption">
                          <h3><?php echo $nombreFotos[$fotos[2]]?></h3>
                        </div>   
                    </div>
                    <div class="carousel-item">
                        <?php echo '<img src="'.$fotos[3].'" width="1100" height="500">'?>
                        <div class="carousel-caption">
                          <h3><?php echo $nombreFotos[$fotos[3]]?></h3>
                        </div>   
                    </div>
                </div>
                <a class="carousel-control-prev" href="#demo" data-slide="prev">
                  <span class="carousel-control-prev-icon"></span>
                </a>
                <a class="carousel-control-next" href="#demo" data-slide="next">
                  <span class="carousel-control-next-icon"></span>
                </a>
            </div>
            
            <div class="jumbotron jumbotron-fluid">'
                <div class="progress">
                    <div class="progress-bar bg-success progress-bar-striped progress-bar-animated" style="width:100%"></div>
                </div>
            </div>
            <div class="jumbotron jumbotron-fluid" style="background-color: #FFFF33;">
                <h2 class="font-italic font-weight-bold" >¡Descubre los <span class="badge badge-primary">MARAVILLOSOS DESTINOS</span> que <span class="badge badge-success">Campeche</span> tiene para ti!</h2>      
            </div>
            <div class="card-columns">
                <?php
                for ($i = 0; $i < $numeroSitios; $i++) {
                    echo '<div class="card" style="height:10em">';
                        echo '<div class="card-body">';
                            echo '<h4 class="card-title">'.$result[$i]['Nombre'].'</h4>';
                            echo '<a href="infoSitioTuristico.php?idsitio='.$result[$i]['IDSitioTuristico'].'" class="btn btn-primary stretched-link mx-auto d-block">Ver informacion</a>';
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
    