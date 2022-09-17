<?php
require ("Delete.php");
$query = new Delete();

$personal = (isset($_GET['personal']) ? $_GET['personal'] : NULL);
$proveedor = (isset($_GET['proveedor']) ? $_GET['proveedor'] : NULL);
if($personal){
  $delete = $query->deletePersonal($personal);
  if($delete){
    header("Location: ../index.php?p=personal");
  }
}
if($proveedor){
  $delete = $query->deleteProveedor($proveedor);
  if($delete){
    header("Location: ../index.php?p=proveedor");
  }
}