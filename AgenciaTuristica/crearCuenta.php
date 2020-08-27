<?php
if (isset($_POST['email'])) {
    include 'iniciarConexionBD.php';
    $nombr = $_POST['nombre'];
    $apell= $_POST['apellido'];
    $fecha= $_POST['fecha'];
    $sexo= $_POST['sexo'];
    $numTe= $_POST['celular'];
    $corEl= $_POST['email'];
    $contr= $_POST['contrasena'];

    try {
        $query = 'INSERT INTO CuentaUsuario (Nombre, Apellido, FechaNacimiento, Sexo, Telefono, CorreoElectronico, Contrasena) VALUES (:nombr, :apell, :fecha, :sexo, :numTe, :corEl, :contr)';        
        $queryOutput = $mbd->prepare($query);
        $queryOutput->bindParam(':nombr',$nombr, PDO::PARAM_STR, 12);
        $queryOutput->bindParam(':apell',$apell, PDO::PARAM_STR, 12);
        $queryOutput->bindParam(':fecha',$fecha, PDO::PARAM_STR, 12);
        $queryOutput->bindParam(':sexo',$sexo, PDO::PARAM_STR, 12);
        $queryOutput->bindParam(':numTe',$numTe, PDO::PARAM_STR, 12);
        $queryOutput->bindParam(':corEl',$corEl, PDO::PARAM_STR, 12);
        $queryOutput->bindParam(':contr',$contr, PDO::PARAM_STR, 12);
        $queryOutput->execute();
        $mbd = null;
        $queryOutput = null;
    } catch (PDOException $e) {
        print "¡Error!: " . $e->getMessage() . "<br/>";
        die();
    }
    header("Location: index.php");
}