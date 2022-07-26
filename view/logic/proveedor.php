<?php

include('../../conexion/conexion.php');

$alert = "";
if(!empty($_POST)){
  $action_prov = (isset($_POST['action_prov']) ? $_POST['action_prov'] : NULL);
  if($action_prov === "agregar_prov"){
    if(empty($_POST['identificador']) || empty($_POST['nombre'] || empty($_POST['factura']) || empty($_POST['telefono']))){
      $alert='<p class="msg_error">Los datos son obligatorios</p>';
    }else{
      $identificador = $_POST['identificador'];// almacenamos los campos que vienen del metodo POST
      $nombre = $_POST['nombre'];
      $factura = $_POST['factura'];
      $telefono = $_POST['telefono'];
      $sql = "SELECT * FROM proveedor WHERE identificador = '$identificador' OR nombre='$nombre'";
      $query = mysqli_query($con,$sql);
      $resultado = mysqli_fetch_array($query); 

      if($resultado > 0){
        $alert='<p class="msg_error">El provedor ya existe.</p>';
      }else{ 
        $sql = "INSERT INTO proveedor(identificador,nombre,factura,telefono) VALUES('$identificador','$nombre','$factura','$telefono')";//Insertamos el registro
        $query_insert = mysqli_query($con,$sql);//resivimos los parametros de la consulta SQL

        if($query_insert){
          // $alert='<p class="msg_save">Usuario registrado correctamente.</p>';
          ?>
          <script>
              localStorage.setItem("addProv", "true");
              window.location.href = "../index.php?p=proveedor";
            </script>
          <?php
        }else{
          $alert='<p class="msg_error">Error al crear al usuario.</p>';
        }
      }          
    }
  }
}
