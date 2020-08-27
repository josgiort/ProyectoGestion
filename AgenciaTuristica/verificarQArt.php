<?php
if (isset($_POST['total'])) {
    session_start();
    include 'iniciarConexionBD.php';
    $idart = $_POST['idart'];
    $total = $_POST['total'];
    $cantidad = $_POST['cantidad'];

    try {
        $query = 'SELECT Disponibles FROM Articulo WHERE IDArticulo = :idart';
        $queryOutput = $mbd->prepare($query);
        $queryOutput->bindParam(':idart',$idart, PDO::PARAM_INT);
        $queryOutput->execute();
        $result = $queryOutput->fetch(PDO::FETCH_ASSOC);
        $queryOutput = null;
        $qAct = $result['Disponibles'];
        
        if ($cantidad <= $qAct) {
            $mbd = null;
            header("Location: pagar.php?idart=".$idart."&total=".$total."&cantidad=".$cantidad."&qAct=".$qAct);
        } else {
            $mbd = null;
            header("Location: malaSuerte3.html");
        }
    } catch (PDOException $e) {
        print "¡Error!: " . $e->getMessage() . "<br/>";
        die();
    }
}
?>