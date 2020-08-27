<?php
include 'iniciarConexionBD.php';
$idsitio = $_GET['idsitio'];

try {
    $query = 'SELECT Nombre,Descripcion FROM SitioTuristico WHERE IDSitioTuristico = :idsit';
    $queryOutput = $mbd->prepare($query);
    $queryOutput->bindParam(':idsit', $idsitio, PDO::PARAM_INT);
    $queryOutput->execute();
    $result = $queryOutput->fetch(PDO::FETCH_ASSOC);
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
        <title>Sitio turistico</title>
    </head>
    <body style="margin-top:80px">
        <header>
            <nav class="navbar navbar-expand-sm bg-primary navbar-dark justify-content-center fixed-top">
                <a class="navbar-brand" href="#">iTourCamp</a>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <span class="badge badge-success"><a class="nav-link" href="entrar.html">Iniciar Sesion</a></span>
                    </li>
                    <li class="nav-item">
                        <span class="badge badge-danger"><a class="nav-link" href="registro.html">Registrarse</a></span>
                    </li>
                </ul>
            </nav>
        </header>
        
        <main class="container">
            <div class="jumbotron jumbotron-fluid">
                <h1><?php echo $result['Nombre'];?></h1>          
            </div>
            
            <?php
             echo '<img src="img/sitios/'.$idsitio.'.jpg" class="img-thumbnail img-responsive mx-auto d-block"> ';
            ?>
            <p></p>
            <div class="jumbotron jumbotron-fluid">
                <h3 class="container text-justify"><?php echo $result['Descripcion'];?></h3>
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