<?php
if (isset($_POST['t'])) {
    session_start();
    $idcntaUsr = $_SESSION['identificadorCuentaUsuario'];
    $idruta = $_POST['id'];
    $total = $_POST['total'];
    $personas = $_POST['numS'];
    $cupoAct = $_POST['numD'];
    $nt = $_POST['nt'];
    $t = $_POST['t'];
    $fv = $_POST['fv'];
    $cs = $_POST['cs'];
    
    if ($nt == '9876876576546543' && $t == 'Jose Santos Perez' && $fv == '11/22' && $cs == '123') {
        include 'aleatorioAT.php';
        include 'iniciarConexionBD.php';
        $nuevaR = new aleatorioAT();
        $confirmacionR = $nuevaR->generarConfirmacionR($idcntaUsr);
        
        try {
            $query = 'INSERT INTO Reserva(IDUsuario,IDRuta,Personas,Total,Confirmacion) VALUES (:idusr,:idr,:p,:tot,:conf)';
            $queryOutput = $mbd->prepare($query);
            $queryOutput->bindParam(':idusr',$idcntaUsr, PDO::PARAM_INT);
            $queryOutput->bindParam(':idr',$idruta, PDO::PARAM_INT);
            $queryOutput->bindParam(':p',$personas, PDO::PARAM_INT);
            $queryOutput->bindParam(':tot',$total, PDO::PARAM_INT);
            $queryOutput->bindParam(':conf',$confirmacionR, PDO::PARAM_STR, 12);
            $queryOutput->execute();
            $queryOutput = null;
            
            $nuevoCupo = $cupoAct - $personas;

            $query2 = 'UPDATE Ruta SET Cupo = :nvoCupo WHERE IDRuta = :idr';
            $queryOutput = $mbd->prepare($query2);
            $queryOutput->bindParam(':idr',$idruta, PDO::PARAM_INT);
            $queryOutput->bindParam(':nvoCupo',$nuevoCupo, PDO::PARAM_INT);
            $queryOutput->execute();
            $queryOutput = null;
            
            $query3 = 'SELECT Nombre FROM Ruta WHERE IDRuta = :idr';
            $queryOutput = $mbd->prepare($query3);
            $queryOutput->bindParam(':idr',$idruta, PDO::PARAM_INT);
            $queryOutput->execute();
            $result = $queryOutput->fetch(PDO::FETCH_ASSOC);
            $queryOutput = null;
            
            $mbd = null;
            echo '<html>';
                echo '<head>';
                    echo '<title>Comprobante de reserva</title>';
                    echo '<meta charset="UTF-8">';
                    echo '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
                    echo '<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">';
                    echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>';
                    echo '<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>';
                    echo '<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>';
                    echo '<link rel="stylesheet" href="css/estilo.css">';
                echo '</head>';
                echo '<body>';
                    echo '<span class="badge badge-pill badge-success">Informacion de la reserva</span>';
                    echo '<div class="jumbotron jumbotron-fluid">';
                        echo '<h4 class="container text-center">Clave de confirmacion:</h4>';
                        echo '<h3 class="container text-center font-weight-bold">'.$confirmacionR.'</h3>';
                        echo '<h4 class="container text-center">Ruta:</h4>';
                        echo '<h3 class="container text-center font-weight-bold">'.$result['Nombre'].'</h3>';
                        echo '<h4 class="container text-center">Numero de personas de la reserva:</h4>';          
                        echo '<h3 class="container text-center font-weight-bold">'.$personas.'</h3>';
                        echo '<h4 class="container text-center">Precio total pagado:</h4>';          
                        echo '<h3 class="container text-center font-weight-bold">$ '.$total.' MXN</h3>';
                    echo '</div>';
                    echo '<h2 class="container text-center font-weight-bolder">En breve seras redirigido a tu inicio...</h2>';
                    echo '<script>';
                        echo 'setTimeout(function(){';
                            echo 'window.location.href="inicioCuentaUsuario.php";';
                        echo '}, 20000);';
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
                echo '<title>Error de pago de reserva</title>';
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
                    echo '<h1 class="container text-center">No fue posible continuar con el pago de la reserva</h1>';
                    echo '<h3 class="container text-center font-weight-bold">Verifica que existen suficientes fondos en tu tarjeta y vuelve a intentarlo</h3>';
                    echo '<h3 class="container text-center font-weight-bold">¡O si no, prueba con otra tarjeta!</h3>';
                    echo '<h3 class="container text-center font-weight-bold">Si el error persiste, ponte en contacto con tu banco</h3>';
                echo '</div>';
                echo '<h2 class="container text-center font-weight-bolder">En breve seras redirigido a tu inicio...</h2>';

                echo '<script>';
                    echo 'setTimeout(function(){';
                        echo 'window.location.href ="inicioCuentaUsuario.php";';
                    echo '}, 20000);';
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
                echo'<p><p/>';
            echo '</footer>';
        echo '</html>';
    }
}