<?php
if (isset($_POST['t'])) {
    session_start();
    $idcntaUsr = $_SESSION['identificadorCuentaUsuario'];
    $idserv = $_POST['id'];
    $total = $_POST['total'];
    $cantidad = $_POST['numS'];
    $qAct = $_POST['numD'];
    $idreserva = $_POST['idreserva']; 
    $nt = $_POST['nt'];
    $t = $_POST['t'];
    $fv = $_POST['fv'];
    $cs = $_POST['cs'];
    
    if ($nt == '9876876576546543' && $t == 'Jose Santos Perez' && $fv == '11/22' && $cs == '123') {
        include 'aleatorioAT.php';
        include 'iniciarConexionBD.php';
        $nuevoSE = new aleatorioAT();
        $confirmacionSE = $nuevoSE->generarConfirmacionSE($idcntaUsr);
        
        try {
            $query = 'INSERT INTO ContratacionSE(IDServEspecial,IDReserva,Cantidad,Total,Confirmacion) VALUES (:idserv,:idreserva,:c,:tot,:conf)';
            $queryOutput = $mbd->prepare($query);
            $queryOutput->bindParam(':idserv',$idserv, PDO::PARAM_INT);
            $queryOutput->bindParam(':idreserva',$idreserva, PDO::PARAM_INT);
            $queryOutput->bindParam(':c',$cantidad, PDO::PARAM_INT);
            $queryOutput->bindParam(':tot',$total, PDO::PARAM_INT);
            $queryOutput->bindParam(':conf',$confirmacionSE, PDO::PARAM_STR, 12);
            $queryOutput->execute();
            $queryOutput = null;
            
            $nuevaCan = $qAct - $cantidad;

            $query2 = 'UPDATE ServEspecial SET Disponibles = :nvoCan WHERE IDServEspecial = :idserv';
            $queryOutput = $mbd->prepare($query2);
            $queryOutput->bindParam(':idserv',$idserv, PDO::PARAM_INT);
            $queryOutput->bindParam(':nvoCan',$nuevaCan, PDO::PARAM_INT);
            $queryOutput->execute();
            $queryOutput = null;
            
            $query3 = 'SELECT Nombre FROM ServEspecial WHERE IDServEspecial = :idserv';
            $queryOutput = $mbd->prepare($query3);
            $queryOutput->bindParam(':idserv',$idserv, PDO::PARAM_INT);
            $queryOutput->execute();
            $result = $queryOutput->fetch(PDO::FETCH_ASSOC);
            $queryOutput = null;
        
            $query4 = 'SELECT Reserva.Confirmacion,Ruta.Nombre FROM Reserva INNER JOIN Ruta ON Reserva.IDRuta = Ruta.IDRuta WHERE Reserva.IDReserva = :idreserva';
            $queryOutput = $mbd->prepare($query4);
            $queryOutput->bindParam(':idreserva',$idreserva, PDO::PARAM_INT);
            $queryOutput->execute();
            $result2 = $queryOutput->fetch(PDO::FETCH_ASSOC);
            $queryOutput = null;
            
            $mbd = null;
            echo '<html>';
                echo '<head>';
                    echo '<title>Comprobante de contratacion de servicio</title>';
                    echo '<meta charset="UTF-8">';
                    echo '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
                    echo '<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">';
                    echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>';
                    echo '<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>';
                    echo '<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>';
                    echo '<link rel="stylesheet" href="css/estilo.css">';
                echo '</head>';
                echo '<body>';
                    echo '<span class="badge badge-pill badge-success">Informacion de contratacion de servicio</span>';
                    echo '<div class="jumbotron jumbotron-fluid">';
                        echo '<h4 class="container text-center">Codigo de confirmacion de contratacion de servicio:</h4>';
                        echo '<h3 class="container text-center font-weight-bold">'.$confirmacionSE.'</h3>';
                        echo '<h4 class="container text-center">Servicio especial turistico:</h4>';
                        echo '<h3 class="container text-center font-weight-bold">'.$result['Nombre'].'</h3>';
                        echo '<h4 class="container text-center">Cantidad contratada:</h4>';          
                        echo '<h3 class="container text-center font-weight-bold">'.$cantidad.'</h3>';
                        echo '<h4 class="container text-center">Precio total pagado:</h4>';          
                        echo '<h3 class="container text-center font-weight-bold">$ '.$total.' MXN</h3>';
                        echo '<h4 class="container text-center">Reserva de ruta del servicio especial:</h4>';          
                        echo '<h3 class="container text-center font-weight-bold">'.$result2['Nombre'].' | Numero de confirmacion de reserva: '.$result2['Confirmacion'].'</h3>';
                    echo '</div>';
                    echo '<h2 class="container text-center font-weight-bolder">En breve seras redirigido a tu inicio...</h2>';
                    echo '<script>';
                        echo 'setTimeout(function(){';
                            echo 'window.location.href="inicioCuentaUsuario.php";';
                        echo '}, 30000);';
                    echo '</script>';
                echo '</body>';
                echo '<footer class="container-fluid">';
                    echo '<p><p/>';
                    echo '<h3 class="container-fluid text-center">Elaborado por:</h3>';
                    echo '<p><p/>';
                    echo '<h4 class="container-fluid text-center">Jose Manuel Gil</h4>';
                    echo '<p><p/>';
                    echo '<h4 class="container-fluid text-center">Santos Noe Huchin</h4>';
                    echo '<p><p/>';
                    echo '<h2 class="container-fluid text-center">&copy; Universidad Autónoma De Campeche</h2>';
                    echo '<p><p/>';
                echo '</footer>';
            echo '</html>';
        } catch (PDOException $e) {
            print "¡Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    } else {
        echo '<html>';
            echo '<head>';
                echo '<title>Error de pago de contratacion</title>';
                echo '<meta charset="UTF-8">';
                echo '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
                echo '<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">';
                echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>';
                echo '<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>';
                echo '<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>';
                echo '<link rel="stylesheet" href="css/estilo.css">';
            echo '</head>';
            echo '<body>';
                echo '<div class="jumbotron jumbotron-fluid">';
                    echo '<h1 class="container text-center">No fue posible continuar con el pago de la contratacion</h1>';
                    echo '<h3 class="container text-center font-weight-bold">Verifica que existen suficientes fondos en tu tarjeta y vuelve a intentarlo</h3>';
                    echo '<h3 class="container text-center font-weight-bold">¡O si no, prueba con otra tarjeta!</h3>';
                    echo '<h3 class="container text-center font-weight-bold">Si el error persiste, ponte en contacto con tu banco</h3>';
                echo '</div>';
                echo '<h2 class="container text-center font-weight-bolder">En breve seras redirigido a tu inicio...</h2>';

                echo '<script>';
                    echo 'setTimeout(function(){';
                        echo 'window.location.href ="inicioCuentaUsuario.php";';
                    echo '}, 30000);';
                echo '</script>';
            echo '</body>';
            echo '<footer class="container-fluid">';
                echo '<p><p/>';
                echo '<h3 class="container-fluid text-center">Elaborado por:</h3>';
                echo '<p><p/>';
                echo '<h4 class="container-fluid text-center">Jose Manuel Gil</h4>';
                echo '<p><p/>';
                echo '<h4 class="container-fluid text-center">Santos Noe Huchin</h4>';
                echo '<p><p/>';
                echo '<h2 class="container-fluid text-center">&copy; Universidad Autónoma De Campeche</h2>';
                echo '<p><p/>';
            echo '</footer>';
        echo '</html>';
    }
}