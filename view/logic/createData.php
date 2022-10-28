<?php
require ("Create.php");
$query = new Create();
$table = (isset($_POST['table']) ? $_POST['table'] : NULL);
if(!empty($_POST)){
  switch ($table) {
    case 'agregarProveedor': // REGISTRAR ADMINISTRADOR
      $id_proveedor = (isset($_POST['id_proveedor']) ? $_POST['id_proveedor'] : NULL);
      $nombre = (isset($_POST['nombre']) ? $_POST['nombre'] : NULL);
      $telefono = (isset($_POST['telefono']) ? $_POST['telefono'] : NULL);
      $correo = (isset($_POST['correo']) ? $_POST['correo'] : NULL);
      $contacto = (isset($_POST['contacto']) ? $_POST['contacto'] : NULL);
      $cargo = (isset($_POST['cargo']) ? $_POST['cargo'] : NULL);
      $modalProveedor = (isset($_POST['modalProveedor']) ? $_POST['modalProveedor'] : false);
      //  LLAMAMOS A UN MÉTODO PARA VALIDAR SI YA EXISTE UN USUARIO CON EL MISMO NOMBRE
      $validate = $query->validateNameUser($nombre, 'proveedor','nombre');
      if($validate >= 1){
        echo "Proveedor ya registrado";
      }else{
        $query -> registrarProveedor($nombre,$telefono,$correo,$contacto,$cargo);
        if($query){
          if(!$modalProveedor){
            ?>
            <script>
              localStorage.setItem("addProv", "true");
              window.location.href = "../index.php?p=proveedor";
            </script>
          <?php
          }else{
            ?>
            <script>
              localStorage.setItem("addProv", "desdeCompras");
              window.location.href = "../index.php?p=compras";
            </script>
          <?php
          }
        }
      } 
  
      break;
    case 'agregarPersonal':
      $nombre = (isset($_POST['nombre']) ? $_POST['nombre'] : NULL);
      $pass = (isset($_POST['pass']) ? $_POST['pass'] : NULL);
      $correo = (isset($_POST['correo']) ? $_POST['correo'] : NULL);
      $telefono = (isset($_POST['telefono']) ? $_POST['telefono'] : NULL);
      $ciudad = (isset($_POST['ciudad']) ? $_POST['ciudad'] : NULL);
      $domicilio = (isset($_POST['domicilio']) ? $_POST['domicilio'] : NULL);
      $id_sucursal = (isset($_POST['id_sucursal']) ? $_POST['id_sucursal'] : NULL);
      $id_caja = (isset($_POST['id_caja']) ? $_POST['id_caja'] : NULL);
      $id_rol = (isset($_POST['id_rol']) ? $_POST['id_rol'] : NULL);      
      //  LLAMAMOS A UN MÉTODO PARA VALIDAR SI YA EXISTE UN USUARIO CON EL MISMO NOMBRE
      $validate = $query->validateNameUser($nombre, 'personal','nombre');
      if($validate >= 1){
        echo "Usuario ya registrado";
      }else{
        // SI NO ESTÁ REPETIDO, LLAMAMOS A UN MÉTODO PARA REGISTRARSE Y MANDAMOS LOS PARAMETROS NECESARIOS
        $query -> registrarPersonal($nombre,$pass,$correo,$telefono,$ciudad,$domicilio,$id_sucursal,$id_caja,$id_rol);
        if($query){
          // echo "correcto";
           ?>
             <script>
                 localStorage.setItem("addPer", "true");
              window.location.href = "../index.php?p=personal";
             </script>
           <?php
        }
      }   

    break;
    case 'registerConfig':
      // PARA CUANDO SE REALICE EL CAMBIO A LA LÓGICA DE INICIO DE SESIÓN
    break;
    case 'getNegocio':
      $id_sucursal = (isset($_POST['id_sucursal']) ? $_POST['id_sucursal'] : NULL); 
      $sucursal = ($id_sucursal == 0) ? 1 : $_POST['id_sucursal']; 
      $getNegocio = $query->getNegocio($sucursal);
      if($getNegocio[0]){
        echo $getNegocio[1];
      }else{
        echo "Ha ocurrido un error, no se ha podido obtener los datos del negocio.";
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
    case 'realizarCompra':
      $data = json_decode($_POST['data'], true);
      foreach ($data as $row) {
        $producto = $row['producto'];
        $cantidad = $row['cantidad'];
        $p_compra = $row['p_compra'];
        $subtotal = $row['subtotal'];
        $proveedor = $row['proveedor'];
        $p_venta = $row['p_venta'];

        $id_proveedor = $query->buscarIdProv($proveedor);
        $buscarProdExistente = $query->buscarProdExistente($producto);
        if($buscarProdExistente[0] > 0){
          $cantidad2 = $buscarProdExistente[1];
          $cantidad = $cantidad + $cantidad2;
          $actualizar = $query->actualizarCompra($cantidad, $p_compra, $p_venta, $producto);
          if($actualizar) echo "compraCorrecta";
        }else{
          $comprar = $query->realizarCompra($producto, $cantidad, $p_compra, $p_venta, $id_proveedor);
          $comprar = $query->realizarCompra($producto, $cantidad, $p_compra, $p_venta, $id_proveedor);
          if($comprar) echo "compraCorrecta";
        }
      }
    break;
    case 'venderProducto':
      $usuario = (isset($_POST['usuario']) ? $_POST['usuario'] : NULL);
      $producto = (isset($_POST['producto']) ? $_POST['producto'] : NULL);
      $cantidad = (isset($_POST['cantidad']) ? $_POST['cantidad'] : NULL);

      $id_producto = $query->buscarIdProd($producto);
      $realizarVenta = $query->realizarVenta($id_producto, $usuario, $cantidad); // Vender producto
      if($realizarVenta){
        $cantidadBase = $query->obtenerCantidadBase($producto);
        $actual = $cantidadBase - $cantidad;
        $reducirCantidad = $query->reducirCantidad($actual, $producto);
        if($reducirCantidad){
          echo "ventaRealizada";
        }
      }
    break;
    case 'generarCodigo':
      $codigo = (isset($_POST['codigo']) ? $_POST['codigo'] : NULL);
      $nombre = (isset($_POST['nombre']) ? $_POST['nombre'] : NULL);
      $generarCodigo = $query->generarCodigo($codigo, $nombre);
      if($generarCodigo) echo "correcto";
    break;
    case 'negocio':
      $nombre = (isset($_POST['nombre']) ? $_POST['nombre'] : NULL);
      $id_tipo = (isset($_POST['tipo']) ? $_POST['tipo'] : NULL);
      $telefono = (isset($_POST['telefono']) ? $_POST['telefono'] : NULL);
      $correo = (isset($_POST['correo']) ? $_POST['correo'] : NULL);
      $imagen = (isset($_FILES['imagen']) ? $_FILES['imagen'] : NULL);

      if ($imagen['size'] != 0 && $imagen['name'] != '') {
        $img = $_FILES['imagen']['name'];
        $tipo = $_FILES['imagen']['type'];
        $temp  = $_FILES['imagen']['tmp_name'];

        if (!((strpos($tipo, 'png')))) {
          echo "Solo se permiten archivos con la extensión png";
        } else {
          $registrarNegocio = $query->registrarNegocio($nombre, $telefono, $correo, $img, $id_tipo);
          if ($registrarNegocio[0]) {
            move_uploaded_file($temp, '../../assets/img/logo/' . $img);
            echo "negocioRegistrado".$registrarNegocio[1];
          } else {
            echo 'error';
          }
        }
      }          
    break;
    case 'datos_fiscales':
      $nombre = (isset($_POST['nombre']) ? $_POST['nombre'] : NULL);
      $rfc = (isset($_POST['rfc']) ? $_POST['rfc'] : NULL);
      $regimen = (isset($_POST['regimen']) ? $_POST['regimen'] : NULL);
      $id_negocio = (isset($_POST['id_negocio']) ? $_POST['id_negocio'] : NULL);
      $registrarDF = $query->registrarDF($nombre, $rfc, $regimen, $id_negocio);
      if($registrarDF) {
        echo "dfRegistrado";
      }else {
        echo "error";
      }
    case 'datos_fiscales_sistema':
      $nombre = (isset($_POST['nombre']) ? $_POST['nombre'] : NULL);
      $rfc = (isset($_POST['rfc']) ? $_POST['rfc'] : NULL);
      $regimen = (isset($_POST['regimen']) ? $_POST['regimen'] : NULL);
      $id_negocio = (isset($_POST['id_negocio']) ? $_POST['id_negocio'] : NULL);
      $registrarDF = $query->registrarDF($nombre, $rfc, $regimen, $id_negocio);
      if($registrarDF) {
        ?>
              <script>
                localStorage.setItem("configuration", "DFAgregado");
                window.location.href = "../index.php?p=configuration";
              </script>
            <?php 
      }else {
        echo "error";
      }
    break;
    case 'sucursal':
      $nombre = (isset($_POST['nombre']) ? $_POST['nombre'] : NULL);
      $estado = (isset($_POST['estado']) ? $_POST['estado'] : NULL);
      $ciudad = (isset($_POST['ciudad']) ? $_POST['ciudad'] : NULL);
      $colonia = (isset($_POST['colonia']) ? $_POST['colonia'] : NULL);
      $direccion = (isset($_POST['direccion']) ? $_POST['direccion'] : NULL);
      $codigo_postal = (isset($_POST['codigo_postal']) ? $_POST['codigo_postal'] : NULL);
      $telefono = (isset($_POST['telefono']) ? $_POST['telefono'] : NULL);
      $correo = (isset($_POST['correo']) ? $_POST['correo'] : NULL);
      $id_negocio = (isset($_POST['id_negocio']) ? $_POST['id_negocio'] : NULL);
      $registrarSucursal = $query->registrarSucursal($nombre,$estado, $ciudad, $colonia, $direccion, $codigo_postal, $telefono, $correo, $id_negocio);
      if($registrarSucursal) {
        echo "sucursalRegistrado";
      }else {
        echo "error";
      }
    break;
    case 'administrador':
      $nombre = (isset($_POST['nombre']) ? $_POST['nombre'] : NULL);
      $pass = (isset($_POST['pass']) ? $_POST['pass'] : NULL);
      $correo = (isset($_POST['correo']) ? $_POST['correo'] : NULL);
      $telefono = (isset($_POST['telefono']) ? $_POST['telefono'] : NULL);
      $id_negocio = (isset($_POST['id_negocio']) ? $_POST['id_negocio'] : NULL);
      $registrarAdmin = $query->registrarAdmin($nombre, $pass, $correo, $telefono, $id_negocio);
      if($registrarAdmin) {
        echo "adminRegistrado";
      }else {
        echo "error";
      }
    break;
    
    default:
      # code...
      break;
  }


}

include "../../libreriaExcel/SimpleXLSX.php";
use Shuchkin\SimpleXLSX;
if (isset($_POST["import"])) {
  $allowedFileType = ['application/vnd.ms-excel', 'text/xls', 'text/xlsx', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];

    if (in_array($_FILES["file"]["type"], $allowedFileType)) {

        $targetPath = '../../assets/excel/' . $_FILES['file']['name'];
        move_uploaded_file($_FILES['file']['tmp_name'], $targetPath);
        $xlsx = new SimpleXLSX($targetPath);  
        $registerExcel = $query->productoExcel($xlsx); 
        if($registerExcel){
          ?>
          <script>
            localStorage.setItem("excel", "true");
            window.location.href = "../index.php?p=productos";
        </script>
          <?php
        }else{
        ?>
          <script>
            localStorage.setItem("excel", "false");
            window.location.href = "../index.php?p=productos";
        </script>
          <?php
        }
    }

}