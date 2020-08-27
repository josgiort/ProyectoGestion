<?php

class aleatorioAT {
    function generarConfirmacionA($idCuenta) {
        $numeroConfirmacion = "1";
        for ($i = 0; $i < 4; $i++) {
            $numeroConfirmacion .= strval(mt_rand(0,9));
        }
        for ($i = 0; $i < (4 - strlen($idCuenta)); $i++) {
            $numeroConfirmacion .= "0";
        }
        $numeroConfirmacion .= strval($idCuenta);
        $numeroConfirmacion .= strval(mt_rand(0,9));
        return $numeroConfirmacion;
    }
    
    function generarConfirmacionSE($idCuenta) {
        $numeroConfirmacion = "2";
        for ($i = 0; $i < 4; $i++) {
            $numeroConfirmacion .= strval(mt_rand(0,9));
        }
        for ($i = 0; $i < (4 - strlen($idCuenta)); $i++) {
            $numeroConfirmacion .= "0";
        }
        $numeroConfirmacion .= strval($idCuenta);
        $numeroConfirmacion .= strval(mt_rand(0,9));
        return $numeroConfirmacion;
    }
    
    function generarConfirmacionR($idCuenta) {
        $numeroConfirmacion = "3";
        for ($i = 0; $i < 4; $i++) {
            $numeroConfirmacion .= strval(mt_rand(0,9));
        }
        for ($i = 0; $i < (4 - strlen($idCuenta)); $i++) {
            $numeroConfirmacion .= "0";
        }
        $numeroConfirmacion .= strval($idCuenta);
        $numeroConfirmacion .= strval(mt_rand(0,9));
        return $numeroConfirmacion;
    }
    
    function generarFotos() {
        $foto1 = 'img/sitios/'.strval(mt_rand(1,17)).'.jpg';
        $foto2 = 'img/sitios/'.strval(mt_rand(1,17)).'.jpg';
        $foto3 = 'img/sitios/'.strval(mt_rand(1,17)).'.jpg';
        $foto4 = 'img/sitios/'.strval(mt_rand(1,17)).'.jpg';
        $fotos = array($foto1, $foto2, $foto3, $foto4);
        return $fotos;
    }
}