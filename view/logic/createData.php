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
    
    
    default:
      # code...
      break;
  }


}
