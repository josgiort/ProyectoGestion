<?php
$bd = "mysql:host=localhost;dbname=AgenciaTuristica";
$usuario = "root";
$contrasena = "";

$mbd = new PDO($bd, $usuario, $contrasena);
$mbd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);