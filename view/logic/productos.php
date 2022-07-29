<?php
  include('../../conexion/conexion.php');

  $codigo = (isset($_POST['codigo']) ? $_POST['codigo'] : NULL);
  $producto = (isset($_POST['producto']) ? $_POST['producto'] : NULL);
  // echo $codigo;
  // echo $producto;

  $sql = "UPDATE productos SET codigo = '$codigo' WHERE producto = '$producto'";
  
  $resul = mysqli_query($con, $sql);
  if($resul) echo "correcto";
