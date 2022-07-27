<?php
include('../../conexion/conexion.php');

$data = json_decode($_POST['data'], true);
// var_dump ($data);

foreach ($data as $d) {
  $producto = $d['producto'];
  $cantidad = $d['cantidad'];
  $p_compra = $d['p_compra'];
  $subtotal = $d['subtotal'];
  $proveedor = $d['proveedor'];
  $p_venta = $d['p_venta'];
  // BUSCAR ID DE PROVEEDOR

  $sqlb = "SELECT id FROM proveedor WHERE nombre = '$proveedor'";
  $re = mysqli_query($con, $sqlb);

  foreach ($re as $r) {
    $id_proveedor = $r['id'];
  } 

  $sql = "INSERT INTO productos(producto, cantidad, pcompra,pventa,id_proveedor) VALUES('$producto','$cantidad','$p_compra', '$p_venta','$id_proveedor')";
  $query_insert = mysqli_query($con,$sql);//resivimos los parametros de la consulta SQL

  if($query_insert){
    echo "compraCorrecta";
  }
}
