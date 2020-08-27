<?php
if (isset($_POST['d5'])) {
    session_start();
    $idCntaUs = $_SESSION['identificadorCuentaUsuario'];
    include 'iniciarConexionBD.php';
    $d1 = $_POST['d1'];
    $d2 = $_POST['d2'];
    $d3 = $_POST['d3'];
    $d4 = $_POST['d4'];
    $d5 = $_POST['d5'];
    $d6 = $_POST['d6'];
    $d7 = $_POST['d7'];
    try {
            $query = 'UPDATE CuentaUsuario SET Nombre = :d1, Apellido = :d2, FechaNacimiento = :d3, Sexo = :d4, Telefono = :d5, CorreoElectronico = :d6, Contrasena = :d7 WHERE IDUsuario = :idcnta';
            $queryOutput = $mbd->prepare($query);
            $queryOutput->bindParam(':d1',$d1, PDO::PARAM_STR, 12);
            $queryOutput->bindParam(':d2',$d2, PDO::PARAM_STR, 12);
            $queryOutput->bindParam(':d3',$d3, PDO::PARAM_STR, 12);
            $queryOutput->bindParam(':d4',$d4, PDO::PARAM_STR, 12);
            $queryOutput->bindParam(':d5',$d5, PDO::PARAM_STR, 12);
            $queryOutput->bindParam(':d6',$d6,  PDO::PARAM_STR, 12);
            $queryOutput->bindParam(':d7',$d7, PDO::PARAM_STR, 12);
            $queryOutput->bindParam(':idcnta',$idCntaUs, PDO::PARAM_INT);
            $queryOutput->execute();
            $queryOutput = null;
            
            $mbd = null;
            header('Location: inicioCuentaUsuario.php');
        } catch (PDOException $e) {
            print "¡Error!: " . $e->getMessage() . "<br/>";
            die();
        }
}