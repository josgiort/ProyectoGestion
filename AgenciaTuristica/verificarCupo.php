<?php
if (isset($_POST['total'])) {
    session_start();
    include 'iniciarConexionBD.php';
    $idruta = $_POST['idruta'];
    $total = $_POST['total'];
    $lugaresSol = $_POST['cupo'];

    try {
        $query = 'SELECT Cupo FROM Ruta WHERE IDRuta = :idr';
        $queryOutput = $mbd->prepare($query);
        $queryOutput->bindParam(':idr',$idruta, PDO::PARAM_INT);
        $queryOutput->execute();
        $result = $queryOutput->fetch(PDO::FETCH_ASSOC);
        $queryOutput = null;
        $cupoAct = $result['Cupo'];
        
        if ($lugaresSol <= $cupoAct) {
            $mbd = null;
            header("Location: pagar.php?idruta=".$idruta."&total=".$total."&lugaresSol=".$lugaresSol."&cupoAct=".$cupoAct);
        } else {
            $mbd = null;
            header("Location: malaSuerte2.html");
        }
    } catch (PDOException $e) {
        print "¡Error!: " . $e->getMessage() . "<br/>";
        die();
    }
}
?>