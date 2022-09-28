<?php
require ("Create.php");
$query = new Create();
$table = (isset($_POST['table']) ? $_POST['table'] : NULL);
if(!empty($_POST)){
  switch ($table) {
    case 'agregarProveedor': // REGISTRAR ADMINISTRADOR
      $identificador = (isset($_POST['identificador']) ? $_POST['identificador'] : NULL);
      $nombre = (isset($_POST['nombre']) ? $_POST['nombre'] : NULL);
      $factura = (isset($_POST['factura']) ? $_POST['factura'] : NULL);
      $telefono = (isset($_POST['telefono']) ? $_POST['telefono'] : NULL);
      //  LLAMAMOS A UN MÉTODO PARA VALIDAR SI YA EXISTE UN USUARIO CON EL MISMO NOMBRE
      $validate = $query->validateNameUser($nombre, 'proveedor','nombre');
      if($validate >= 1){
        echo "Proveedor ya registrado";
      }else{
        $query -> registrarProveedor($identificador, $nombre, $factura,$telefono);
        if($query){
          ?>
            <script>
              localStorage.setItem("addProv", "true");
              window.location.href = "../index.php?p=proveedor";
            </script>
          <?php
        }
      }    
      break;
    case 'agregarPersonal':

      $nombre = (isset($_POST['nombre']) ? $_POST['nombre'] : NULL);
      $pass = (isset($_POST['pass']) ? $_POST['pass'] : NULL);
      $correo = (isset($_POST['correo']) ? $_POST['correo'] : NULL);
      $telefono = (isset($_POST['telefono']) ? $_POST['telefono'] : NULL);
      $caja = (isset($_POST['caja']) ? $_POST['caja'] : NULL);
      $rol = (isset($_POST['rol']) ? $_POST['rol'] : NULL);
      
      //  LLAMAMOS A UN MÉTODO PARA VALIDAR SI YA EXISTE UN USUARIO CON EL MISMO NOMBRE
      $validate = $query->validateNameUser($nombre, 'usuarios','username');
      if($validate >= 1){
        echo "Usuario ya registrado";
      }else{
        // SI NO ESTÁ REPETIDO, LLAMAMOS A UN MÉTODO PARA REGISTRARSE Y MANDAMOS LOS PARAMETROS NECESARIOS
        $query -> registrarPersonal($nombre,$pass,$correo,$telefono,$caja,$rol);
        if($query){
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
      $getNegocio = $query->getNegocio();
      if($getNegocio[0]){
        echo $getNegocio[1];
      }else{
        echo "Ha ocurrido un error, no se ha podido obtener los datos del negocio.";
      }
    break;
    case 'buscarProducto':
      $codProducto = (isset($_POST['codProducto']) ? $_POST['codProducto'] : NULL);
      $buscarProducto = $query->buscarProducto($codProducto);
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
      $producto = (isset($_POST['producto']) ? $_POST['producto'] : NULL);
      $generarCodigo = $query->generarCodigo($codigo, $producto);
      if($generarCodigo) echo "correcto";
    break;
    case 'negocio':
      $nombre = (isset($_POST['nombre']) ? $_POST['nombre'] : NULL);
      $tipo_negocio = (isset($_POST['tipo']) ? $_POST['tipo'] : NULL);
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
          $registrarNegocio = $query->registrarNegocio($nombre, $tipo_negocio, $telefono, $correo, $img);
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
    break;
    case 'sucursal':
      $estado = (isset($_POST['estado']) ? $_POST['estado'] : NULL);
      $ciudad = (isset($_POST['ciudad']) ? $_POST['ciudad'] : NULL);
      $colonia = (isset($_POST['colonia']) ? $_POST['colonia'] : NULL);
      $direccion = (isset($_POST['direccion']) ? $_POST['direccion'] : NULL);
      $codigo_postal = (isset($_POST['codigo_postal']) ? $_POST['codigo_postal'] : NULL);
      $telefono = (isset($_POST['telefono']) ? $_POST['telefono'] : NULL);
      $correo = (isset($_POST['correo']) ? $_POST['correo'] : NULL);
      $id_negocio = (isset($_POST['id_negocio']) ? $_POST['id_negocio'] : NULL);
      $registrarSucursal = $query->registrarSucursal($estado, $ciudad, $colonia, $direccion, $codigo_postal, $telefono, $correo, $id_negocio);
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
