<?php
    session_start();
    $nmeCntaUs = $_SESSION['nombreCuentaUsuario'];
    if (isset($_GET['lugaresSol'])) {
        $total = $_GET['total'];
        $id = $_GET['idruta'];
        $numS = $_GET['lugaresSol'];
        $numD = $_GET['cupoAct'];
    } else if (isset($_GET['idart'])) {
        $total = $_GET['total'];
        $id = $_GET['idart'];
        $numS = $_GET['cantidad'];
        $numD = $_GET['qAct'];
    } else if (isset($_GET['idserv'])) {
        $total = $_GET['total'];
        $id = $_GET['idserv'];
        $numS = $_GET['cantidad'];
        $numD = $_GET['qAct'];
        $idreserva = $_GET['idreserva'];
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
        <title>Pago</title>
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
            <div class="alert alert-info">
                <strong>A continuacion, realiza el pago con tarjeta</strong>
            </div>
                    <?php
                    if (isset($_GET['lugaresSol'])) {
                        echo '<form action="procesarPago.php" method="post">';
                    } else if (isset($_GET['idart'])) {
                        echo '<form action="procesarPagoArt.php" method="post">';
                    } else if (isset($_GET['idserv'])) {
                        echo '<form action="procesarPagoServ.php" method="post">';
                    }
                  echo '<div class="form-group">';  
                  echo '<input type="hidden" name="total" value="'.$total.'">';
                  echo '<input type="hidden" name="id" value="'.$id.'">';
                  echo '<input type="hidden" name="numS" value="'.$numS.'">';
                  echo '<input type="hidden" name="numD" value="'.$numD.'">';
                  if (isset($_GET['idserv'])) {
                      echo '<input type="hidden" name="idreserva" value="'.$idreserva.'">';
                  }
                  ?>
                  <label>Numero de tarjeta:</label>
                  <input type="text" name="nt" class="form-control" placeholder="85250000643700007653" required>
                </div>
                <div class="form-group">
                  <label>Titular:</label>
                  <input type="text" name="t" class="form-control" placeholder="Miguel Perez Gomez" required>
                </div>
                <div class="form-group">
                  <label>Fecha de vencimiento:</label>
                  <input type="text" name="fv" class="form-control" placeholder="01/29" required>
                </div>
                <div class="form-group">
                  <label>Codigo de seguridad:</label>
                  <input type="text" name="cs" class="form-control" placeholder="263" required>
                </div>
                
                 <div class="alert alert-primary">
                    Total: <strong>$ <?php echo $total;?> MXN</strong>
                </div>
                
                <button type="submit" class="btn btn-primary">Pagar</button>
            </form> 
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