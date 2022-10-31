<?php
  require_once "../config/Connection.php";
  require_once "Read.php";
  $query = new Read();
  $table = (isset($_POST['action']) ? $_POST['action'] : NULL);
  if(!empty($_POST)){
    switch ($table) {
      case 'readCompraProducto':
        $id_compra = (isset($_POST['id_compra']) ? $_POST['id_compra'] : NULL); 
        $compraProducto = ($id_compra == 0) ? 1 : $_POST['id_compra']; 
        $getCompraProducto = $query->getCompraProducto($compraProducto);
        if($getCompraProducto[0]){
          $getJsons = [$getCompraProducto[1], $getCompraProducto[2]];
          $cadenaJSON = implode("-/", $getJsons);
          echo $cadenaJSON;
        }else{
          echo "Ha ocurrido un error, no se ha podido obtener los datos del negocio.";
        }
      break;
      default:
        # code...
      break;
    }
  }