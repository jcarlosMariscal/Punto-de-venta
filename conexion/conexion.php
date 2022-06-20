<?php
    $servidor = "localhost";
    $usuario = "root";
    $clave   = "";
    $bdName = "punto_venta";


    $con = @mysqli_connect($servidor, $usuario, $clave,$bdName);
    

    if(!$con){
        echo "error conexion";
    }
?>