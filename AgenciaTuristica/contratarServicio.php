<?php
session_start();
include 'iniciarConexionBD.php';
$idusr = $_SESSION['identificadorCuentaUsuario'];
$nmeCntaUs = $_SESSION['nombreCuentaUsuario'];

$query = 'SELECT Reserva.IDReserva,Reserva.Personas,Reserva.Total,Reserva.Confirmacion,Ruta.Nombre FROM Reserva INNER JOIN Ruta ON Reserva.IDRuta = Ruta.IDRuta WHERE Reserva.IDUsuario = :idusr';
$queryOutput = $mbd->prepare($query);
$queryOutput->bindParam(':idusr',$idusr, PDO::PARAM_INT);
$queryOutput->execute();
$numeroReservas = $queryOutput->rowCount();
$result = $queryOutput->fetchAll(PDO::FETCH_ASSOC);
$queryOutput = null;

if ($numeroReservas > 0) {
    $idserv = $_GET['idserv'];
    $img = $_GET['img'];

    try {
        $query2 = 'SELECT * FROM ServEspecial WHERE IDServEspecial = :idserv';
        $queryOutput = $mbd->prepare($query2);
        $queryOutput->bindParam(':idserv',$idserv, PDO::PARAM_INT);
        $queryOutput->execute();
        $result2 = $queryOutput->fetch(PDO::FETCH_ASSOC);
        $queryOutput = null;

        $mbd = null;
    } catch (PDOException $e) {
        print "¡Error!: " . $e->getMessage() . "<br/>";
        die();
    }
} else {
    $mbd = null;
    header('Location: inicioCuentaUsuario.php');
}
?>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
        <script>
            function calcularTotal(precio) {
                var cantidad = document.getElementById("cantidad").value;
                var total = precio * cantidad; 
                document.getElementById("compraTotal").innerHTML= "$ " + total + " MXN";
                document.getElementById("escondido").value= total;
            }
        </script>
        <link rel="stylesheet" href="css/estilo.css">
        <title>Detalles del servicio especial turistico</title>
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
                <h1><?php echo $result2['Nombre'];?></h1>          
            </div>
            
                <?php
                 echo '<img src="'.$img.'" class="rounded-circle mx-auto d-block" width="500em" height="500em"> ';
                ?>
            <span class="badge badge-pill badge-info">Informacion del servicio especial turistico</span>
            <div class="jumbotron jumbotron-fluid">
                <h4 class="container text-center">Cantidad disponible:</h4>          
                <h3 class="container text-center font-weight-bold"><?php echo $result2['Disponibles'];?></h3>
                <h4 class="container text-center">Precio por servicio:</h4>          
                <h3 class="container text-center font-weight-bold">$ <?php echo $result2['Precio'];?> MXN</h3>
            </div>    
            
            <div class="jumbotron jumbotron-fluid">    
                <form action="verificarQServ.php" method="post">
                    
                <div class="jumbotron jumbotron-fluid">
                    <h4 class="container text-center font-weight-bold">Selecciona una de tus reservaciones para el servicio especial:</h4>          
                    <select class="mx-auto d-block" name="idreserva">
                        <?php   
                            for ($i = 0; $i < $numeroReservas; $i++) {
                                echo '<option value="'.$result[$i]['IDReserva'].'">'.$result[$i]['Nombre'].' | Personas:'.$result[$i]['Personas'].' | Numero de confirmacion:'.$result[$i]['Confirmacion'].'     </option>';
                            }
                        ?>
                    </select>
                </div> 
                    
                <h3 class="container-fluid text-center font-weight-bold">Seleccione la cantidad deseada</h3>
                
                    <div class="form-group">
                     <?php
                        echo '<input type="hidden" name="total" value="'.$result2['Precio'].'" id="escondido">';
                        echo '<input type="hidden" name="idserv" value="'.$idserv.'">';
                        echo '<label class="container text-center">Cantidad de servicios:</label>';
                        echo '<select class="mx-auto d-block" name="cantidad" id="cantidad" onclick="calcularTotal('.$result2['Precio'].')">';
                          echo '<option value="1">1</option>';
                          echo '<option value="2">2</option>';
                          echo '<option value="3">3</option>';
                          echo '<option value="4">4</option>';
                          echo '<option value="5">5</option>';
                          echo '<option value="6">6</option>';
                          echo '<option value="7">7</option>';
                          echo '<option value="8">8</option>';
                          echo '<option value="9">9</option>';
                          echo '<option value="10">10</option>';
                        echo '</select>';
                    ?>
                    </div> 

                    <h4 class="container text-center">Total:</h4>          
                    <h3 class="container text-center font-weight-bold" id="compraTotal">$ <?php echo $result2['Precio'];?> MXN</h3>
                    <button type="submit" class="btn btn-primary mx-auto d-block">Contratar</button>
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