<?php

include('../../conexion/conexion.php');
// echo "hola";
$alert = "";
$dPer = (isset($_GET['dPer']) ? $_GET['dPer'] : NULL);
if(!empty($_POST)){
  $action_per = (isset($_POST['action_per']) ? $_POST['action_per'] : NULL);
  if($action_per === "agregar_per"){
    if(empty($_POST['nombre']) || empty($_POST['telefono'] || empty($_POST['correo']) || empty($_POST['rol']) || empty($_POST['pass']))){
      $alert='<p class="msg_error">Los datos son obligatorios</p>';
    }else{
      // echo "accediendo";
      $nombre = $_POST['nombre'];// almacenamos los campos que vienen del metodo POST
      $telefono = $_POST['telefono'];
      $correo = $_POST['correo'];
      $rol = $_POST['rol'];
      $caja = $_POST['caja'];
      $pass = md5($_POST['pass']);
      $sql = "SELECT * FROM usuarios WHERE username = '$nombre'";
      $query = mysqli_query($con,$sql);
      $resultado = mysqli_fetch_array($query); 

      if($resultado > 0){
        $alert='<p class="msg_error">Ya existe un usuario con ese nombre.</p>';
      }else{ 
        $sql = "INSERT INTO usuarios(username,pass,correo,telefono, id_caja, id_rol) VALUES('$nombre','$pass','$correo','$telefono', '$caja','$rol')";//Insertamos el registro
        $query_insert = mysqli_query($con,$sql);//resivimos los parametros de la consulta SQL

        if($query_insert){
          // $alert='<p class="msg_save">Usuario registrado correctamente.</p>';
          ?>
          <script>
              localStorage.setItem("addPer", "true");
              window.location.href = "../index.php?p=personal";
            </script>
          <?php
        }else{
          $alert='<p class="msg_error">Error al crear al usuario.</p>';
        }
      }          
    }
  }else if($action_per === "editar_per"){
    if(empty($_POST['nombre']) || empty($_POST['telefono'] || empty($_POST['correo']) || empty($_POST['rol']) || empty($_POST['pass']))){
      $alert='<p class="msg_error">Los datos son obligatorios</p>';
    }else{
      $id_per = $_POST['id_per'];// almacenamos los campos que vienen del metodo POST
      $nombre = $_POST['nombre'];// almacenamos los campos que vienen del metodo POST
      $telefono = $_POST['telefono'];
      $correo = $_POST['correo'];
      $rol = $_POST['rol'];
      $pass = md5($_POST['pass']);
      // $sql = "SELECT * FROM proveedor WHERE identificador = '$identificador' OR nombre='$nombre' AND id != '$id_prov'";
      // $query = mysqli_query($con,$sql);
      // $resultado = mysqli_fetch_array($query); 

      // if($resultado > 0){
      //   $alert='<p class="msg_error">El provedor ya existe.</p>';
      // }else{ 
      //   echo "aeditar";
        $sql = "UPDATE usuarios SET username = '$nombre', pass = '$pass', correo = '$correo', telefono = '$telefono',id_rol = '$rol' WHERE id_user = '$id_per'";//Insertamos el registro
        $query_insert = mysqli_query($con,$sql);//resivimos los parametros de la consulta SQL

        if($query_insert){
          // $alert='<p class="msg_save">Usuario registrado correctamente.</p>';
          ?>
          <script>
              localStorage.setItem("modPer", "true");
              window.location.href = "../index.php?p=personal";
            </script>
          <?php
        }else{
          $alert='<p class="msg_error">Error al crear al usuario.</p>';
        }
      // }          
    }
  }
}
if($dPer){
  $sql = "DELETE FROM usuarios WHERE id_user = '$dPer'";
  $res = mysqli_query($con, $sql);
  header("Location: ../index.php?p=personal");
}
