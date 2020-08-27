<?php
if (isset($_POST['idreserva'])) {
    
    session_start();
    include 'iniciarConexionBD.php';
    $idserv = $_POST['idserv'];
    $total = $_POST['total'];
    $cantidad = $_POST['cantidad'];
    $idreserva = $_POST['idreserva']; 

    try {
        $query = 'SELECT Disponibles FROM ServEspecial WHERE IDServEspecial = :idserv';
        $queryOutput = $mbd->prepare($query);
        $queryOutput->bindParam(':idserv',$idserv, PDO::PARAM_INT);
        $queryOutput->execute();
        $result = $queryOutput->fetch(PDO::FETCH_ASSOC);
        $queryOutput = null;
        $qAct = $result['Disponibles'];
        
        if ($cantidad <= $qAct) {
            $mbd = null;
            header("Location: pagar.php?idserv=".$idserv."&total=".$total."&cantidad=".$cantidad."&qAct=".$qAct."&idreserva=".$idreserva);
        } else {
            $mbd = null;
            header("Location: malaSuerte4.html");
        }
    } catch (PDOException $e) {
        print "¡Error!: " . $e->getMessage() . "<br/>";
        die();
    }
}
?>