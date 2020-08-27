<?php
session_start();
include 'iniciarConexionBD.php';
$nmeCntaUs = $_SESSION['nombreCuentaUsuario'];
$idruta = $_GET['idruta'];

try {
    $query = 'SELECT * FROM Ruta WHERE IDRuta = :idr';
    $queryOutput = $mbd->prepare($query);
    $queryOutput->bindParam(':idr',$idruta, PDO::PARAM_INT);
    $queryOutput->execute();
    $result = $queryOutput->fetch(PDO::FETCH_ASSOC);
    $queryOutput = null;

    $query2 = 'SELECT Secuencia,Tipo,Denominativo,Duracion FROM ParteRuta WHERE IDRuta = :idr ORDER BY Secuencia';
    $queryOutput = $mbd->prepare($query2);
    $queryOutput->bindParam(':idr',$idruta, PDO::PARAM_INT);
    $queryOutput->execute();
    $numeroPartes = $queryOutput->rowCount();
    $result2 = $queryOutput->fetchAll(PDO::FETCH_ASSOC);
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
        <script>
            function calcularTotal(precio) {
                var cantidad = document.getElementById("cantidad").value;
                var total = precio * cantidad; 
                document.getElementById("reservaTotal").innerHTML= "$ " + total + " MXN";
                document.getElementById("escondido").value= total;
            }
        </script>
        <link rel="stylesheet" href="css/estilo.css">
        <title>Detalles de una ruta turistica</title>
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
                <h1><?php echo $result['Nombre'];?></h1>          
            </div>
            <span class="badge badge-pill badge-info">Itinerario de la ruta</span>
            
            <ul class="list-group">
                <?php
                for ($i = 0; $i < $numeroPartes; $i++) {
                    if ($result2[$i]['Tipo'] == '1') {
                        echo '<li class="list-group-item list-group-item-secondary">';
                            echo '<ul class="list-inline">';
                                echo '<li class="list-inline-item">'.$result2[$i]['Secuencia'].'</li>';
                                echo '<li class="list-inline-item"><p>'.$result2[$i]['Denominativo'].'</p></li>';
                                echo '<li class="list-inline-item"><p>Duracion: '.$result2[$i]['Duracion'].'</p></li>';
                            echo '</ul>';
                        echo '</li>';
                    } else {
                        echo '<li class="list-group-item list-group-item-primary">';
                            echo '<ul class="list-inline">';
                                echo '<li class="list-inline-item">'.$result2[$i]['Secuencia'].'</li>';
                                echo '<li class="list-inline-item"><h3>'.$result2[$i]['Denominativo'].'</h3></li>';
                                echo '<li class="list-inline-item"><h5>Duracion: '.$result2[$i]['Duracion'].'</h5></li>';
                            echo '</ul>';
                        echo '</li>';
                    }
                }
                 echo '<img src="img/'.$idruta.'.jpg" class="container rounded-circle mx-auto d-block" width="600em" height="600em"> ';
                ?>
            </ul>
            <span class="badge badge-pill badge-success">Informacion de la ruta</span>
            <div class="jumbotron jumbotron-fluid">
                <h4 class="container text-center">Fecha y hora de inicio:</h4>          
                <h3 class="container text-center font-weight-bold"><?php echo $result['FechaRealizacion'];?></h3>
                <h4 class="container text-center">Cupo disponible:</h4>          
                <h3 class="container text-center font-weight-bold"><?php echo $result['Cupo'];?></h3>
                <h4 class="container text-center">Precio por persona:</h4>          
                <h3 class="container text-center font-weight-bold">$ <?php echo $result['PrecioPersona'];?> MXN</h3>
                <h4 class="container text-center">Guia asignado:</h4>          
                <h3 class="container text-center font-weight-bold"><?php echo $result['Guia'];?></h3>
                <br>
                <!-- Button to Open the Modal -->
                <button type="button" class="btn btn-primary mx-auto d-block" data-toggle="modal" data-target="#myModal">
                  Reservar
                </button>

                <!-- The Modal -->
                <div class="modal fade" id="myModal">
                  <div class="modal-dialog">
                    <div class="modal-content">

                      <!-- Modal Header -->
                      <div class="modal-header">
                        <h4 class="modal-title">Realizar una reserva</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                      </div>

                        <div class="modal-body">
                            <form action="verificarCupo.php" method="post">
                                <div class="form-group">
                                 <?php   
                                    echo '<input type="hidden" name="total" value="'.$result['PrecioPersona'].'" id="escondido">';
                                    echo '<input type="hidden" name="idruta" value="'.$idruta.'">';
                                    echo '<label>Numero de personas:</label>';
                                    echo '<select class="form-control" name="cupo" id="cantidad" onclick="calcularTotal('.$result['PrecioPersona'].')">';
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
                                <h3 class="container text-center font-weight-bold" id="reservaTotal">$ <?php echo $result['PrecioPersona'];?> MXN</h3>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Reservar</button>
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                                </div>
                            </form> 
                        </div>
                    </div>

                    </div>
                  </div>
                </div>
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