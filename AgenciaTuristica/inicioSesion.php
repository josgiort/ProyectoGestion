<?php
if (isset($_POST['contrasena'])) {
    include 'iniciarConexionBD.php';
    $corr = $_POST['email'];
    $ctrs = $_POST['contrasena'];

    try {
        $query = 'SELECT IDUsuario, Nombre, Apellido  FROM CuentaUsuario WHERE CorreoElectronico = :corr AND Contrasena = :ctrs';
        $queryOutput = $mbd->prepare($query);
        $queryOutput->bindParam(':corr',$corr, PDO::PARAM_STR, 12);
        $queryOutput->bindParam(':ctrs',$ctrs, PDO::PARAM_STR, 12);
        $queryOutput->execute();
        $result = $queryOutput->fetch(PDO::FETCH_ASSOC);
        $queryOutput = null;
        
        $query2 = 'SELECT * FROM Ruta';
        $queryOutput = $mbd->prepare($query2);
        $queryOutput->execute();
        $result2 = $queryOutput->fetchAll(PDO::FETCH_ASSOC);
        $queryOutput = null;
        
        $mbd = null;

        if ($result != false) {
            session_start();
            $_SESSION['identificadorCuentaUsuario']  = $result['IDUsuario'];
            $_SESSION['nombreCuentaUsuario']  = $result['Nombre'];
            $_SESSION['apellidoCuentaUsuario']  = $result['Apellido'];
            $_SESSION['resumenRT'] = $result2;
            header("Location: inicioCuentaUsuario.php");
        } else {
            header("Location: malaSuerte.html");
        }
    } catch (PDOException $e) {
        print "¡Error!: " . $e->getMessage() . "<br/>";
        die();
    }
}