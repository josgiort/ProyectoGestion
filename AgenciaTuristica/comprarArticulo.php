<?php
session_start();
include 'iniciarConexionBD.php';
$nmeCntaUs = $_SESSION['nombreCuentaUsuario'];
$idart = $_GET['idart'];
$img = $_GET['img'];

try {
    $query = 'SELECT * FROM Articulo WHERE IDArticulo = :ida';
    $queryOutput = $mbd->prepare($query);
    $queryOutput->bindParam(':ida',$idart, PDO::PARAM_INT);
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
        <script>
            function calcularTotal(precio) {
                var cantidad = document.getElementById("cantidad").value;
                var total = precio * cantidad; 
                document.getElementById("compraTotal").innerHTML= "$ " + total + " MXN";
                document.getElementById("escondido").value= total;
            }
        </script>
        <link rel="stylesheet" href="css/estilo.css">
        <title>Detalles de articulo turistico</title>
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
            
                <?php
                 echo '<img src="'.$img.'" class="rounded-circle mx-auto d-block" width="500em" height="500em"> ';
                ?>
            <span class="badge badge-pill badge-info">Informacion del articulo</span>
            <div class="jumbotron jumbotron-fluid">
                <h4 class="container text-center">Marca:</h4>          
                <h3 class="container text-center font-weight-bold"><?php echo $result['Marca'];?></h3>
                <h4 class="container text-center">Cantidad disponible:</h4>          
                <h3 class="container text-center font-weight-bold"><?php echo $result['Disponibles'];?></h3>
                <h4 class="container text-center">Precio individual:</h4>          
                <h3 class="container text-center font-weight-bold">$ <?php echo $result['Precio'];?> MXN</h3>
                
            </div>    
            <div class="jumbotron jumbotron-fluid">    
                <h3 class="container-fluid text-center font-weight-bold">Seleccione la cantidad deseada</h3>
                <form action="verificarQArt.php" method="post">
                    <div class="form-group">
                     <?php   
                        echo '<input type="hidden" name="total" value="'.$result['Precio'].'" id="escondido">';
                        echo '<input type="hidden" name="idart" value="'.$idart.'">';
                        echo '<label class="container text-center">Cantidad de articulos:</label>';
                        echo '<select class="mx-auto d-block" name="cantidad" id="cantidad" onclick="calcularTotal('.$result['Precio'].')">';
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
                    <h3 class="container text-center font-weight-bold" id="compraTotal">$ <?php echo $result['Precio'];?> MXN</h3>
                    <button type="submit" class="btn btn-primary mx-auto d-block">Comprar</button>
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