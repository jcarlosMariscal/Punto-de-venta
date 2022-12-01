<?php
  require_once "../config/Connection.php";
  require_once "Read.php";
  $query = new Read();
  $action = (isset($_POST['action']) ? $_POST['action'] : NULL);
  if(!empty($_POST)){
    switch ($action) {
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
      case 'readVentaProducto':
        $id_venta = (isset($_POST['id_venta']) ? $_POST['id_venta'] : NULL); 
        $ventaProducto = ($id_venta == 0) ? 1 : $_POST['id_venta']; 
        $getVentaProducto = $query->getVentaProducto($ventaProducto);
        if($getVentaProducto[0]){
          $getJsons = [$getVentaProducto[1], $getVentaProducto[2]];
          $cadenaJSON = implode("-/", $getJsons);
          echo $cadenaJSON;
        }else{
          echo "Ha ocurrido un error, no se ha podido obtener los datos del negocio.";
        }
      break;
      case 'readCompras':
        $filtro = (isset($_POST['filtro']) ? $_POST['filtro'] : NULL); 
        $campo = (isset($_POST['campo']) ? $_POST['campo'] : NULL); 
        $getCompras = $query->getCompras($filtro, $campo);
        if($getCompras[0]){
          echo $getCompras[1];
        }else{
          echo "No hay resultados";
        }
      break;
      case 'readVentas':
        $filtro = (isset($_POST['filtro']) ? $_POST['filtro'] : NULL); 
        $campo = (isset($_POST['campo']) ? $_POST['campo'] : NULL); 
        $getCompras = $query->getVentas($filtro, $campo);
        if($getCompras[0]){
          echo $getCompras[1];
        }else{
          echo "No hay resultados";
        }
      break;
      case 'buscarProducto':
        $codNameProducto = (isset($_POST['codNameProducto']) ? $_POST['codNameProducto'] : NULL);
        $buscarProducto = $query->buscarProducto($codNameProducto);
        if($buscarProducto[0]){
          echo $buscarProducto[1];
        }else{
          echo "noEncontrado";
        }
      break;
      break;
      default:
        # code...
      break;
    }
  }