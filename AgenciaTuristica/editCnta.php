<?php
session_start();
include 'iniciarConexionBD.php';
$nmeCntaUs = $_SESSION['nombreCuentaUsuario'];
$idCntaUs = $_SESSION['identificadorCuentaUsuario'];


try {
    $query = 'SELECT Nombre, Apellido, FechaNacimiento, Sexo, Telefono, CorreoElectronico, Contrasena FROM CuentaUsuario WHERE IDUsuario = :idcnta';
    $queryOutput = $mbd->prepare($query);
    $queryOutput->bindParam(':idcnta', $idCntaUs, PDO::PARAM_INT);
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
        <title>Datos personales de la cuenta</title>
    </head>
    <body style="margin-top:5em">
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
            <div class="jumbotron jumbotron-fluid">
                <h2 class="container text-center">Puede hacer modificaciones en los datos personales de su cuenta</h2>          
            </div>
           
            <div class="jumbotron jumbotron-fluid">
                <form action="actualizarDatosCnta.php" method="post">
    
                <h4 class="container text-center">Nombre:</h4>          
                <input type="text" name="d1" class="mx-auto d-block" value="<?php echo $result['Nombre'];?>" required>
                <p></p>
                <h4 class="container text-center">Apellido:</h4>          
                <input type="text" name="d2" class="mx-auto d-block" value="<?php echo $result['Apellido'];?>" required>
                <p></p>
                <h4 class="container text-center">Fecha de nacimiento:</h4>          
                <input type="date" name="d3" class="mx-auto d-block" value="<?php echo $result['FechaNacimiento'];?>" required>
                <p></p>
                <h4 class="container text-center">Sexo:</h4>          
                <select class="mx-auto d-block" name="d4" required>
                    <option value="Hombre">Hombre</option>
                    <option value="Mujer">Mujer</option>
                    <option value="Otro">Otro</option>
                </select>
                <p></p>
                <h4 class="container text-center">Telefono:</h4>          
                <input type="text" name="d5" class="mx-auto d-block" value="<?php echo $result['Telefono'];?>" required>
                <p></p>
                <h4 class="container text-center">Correo Electronico:</h4>          
                <input type="text" name="d6" class="mx-auto d-block" value="<?php echo $result['CorreoElectronico'];?>" required>
                <p></p>
                <h4 class="container text-center">Contrasena:</h4>          
                <input type="password" name="d7" class="mx-auto d-block" value="<?php echo $result['Contrasena'];?>" required>
                <p></p>
                <button type="submit" class="btn btn-primary mx-auto d-block">Modificar</button>
                </form>
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