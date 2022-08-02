<?php
  include('../../conexion/conexion.php');
// echo "hola";
// echo $_POST['action'];
$action = (isset($_POST['action']) ? $_POST['action'] : NULL);
if($action === "buscar"){
  $codProducto = (isset($_POST['codProducto']) ? $_POST['codProducto'] : NULL);

  $sql = "SELECT * FROM productos WHERE codigo = '$codProducto'";
  $query = mysqli_query($con,$sql);
  $res = mysqli_fetch_array($query);
  if($res > 0){
    // echo "encontrado";
    foreach ($query as $row) {
      $codigo = $row['codigo'];
      $producto = $row['producto'];
      $pventa = $row['pventa'];
      $id_proveedor = $row['id_proveedor'];
      $cantidad = $row['cantidad'];
    } 
    // echo json_code($razon_social);
    $json = '{"codigo":"'.$codigo.'","producto":"'.$producto.'","pventa":"'.$pventa.'","id_proveedor":"'.$id_proveedor.'", "cantidad":"'.$cantidad.'"}';
    echo $json;
  }else{
    echo "noEncontrado";
  }
}else if($action === "vender"){
  $usuario = (isset($_POST['usuario']) ? $_POST['usuario'] : NULL);
  $producto = (isset($_POST['producto']) ? $_POST['producto'] : NULL);
  $cantidad = (isset($_POST['cantidad']) ? $_POST['cantidad'] : NULL);

  $sqlp = "SELECT id FROM productos WHERE codigo = '$producto'";
  $queryp = mysqli_query($con,$sqlp);
  foreach($queryp as $res){
    $id_producto = $res['id'];
  }

  // echo $usuario;
  $sql = "INSERT INTO ventas (id_producto, id_user, cantidad) VALUES ('$id_producto', '$usuario', '$cantidad')";
  $query = mysqli_query($con,$sql);//resivimos los parametros de la consulta SQL
  if($query){
    $sql2 = "SELECT cantidad FROM productos WHERE codigo = '$producto'";
    $query2 = mysqli_query($con,$sql2);
    $res = mysqli_fetch_array($query2); 
    if($res > 0){
      foreach($query2 as $r){
        $cant = $r['cantidad'];
      }
      $actual = $cant - $cantidad;
      $sql3 = "UPDATE productos SET cantidad = '$actual' WHERE codigo = '$producto'";
      $query3 = mysqli_query($con,$sql3);
      if($query3){
        echo "ventaRealizada";
      }
    }
  }
}