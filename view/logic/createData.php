<?php
require ("Create.php");
$query = new Create();
$table = (isset($_POST['table']) ? $_POST['table'] : NULL);
if(!empty($_POST)){
  switch ($table) {
    case 'registrarProveedor': // REGISTRAR ADMINISTRADOR
      // VALIDAMOS SI SE RECIBEN LOS DATOS, SI NO MANDALOS LOS VALORES COMO NULO.
      $identificador = (isset($_POST['identificador']) ? $_POST['identificador'] : NULL);
      $nombre = (isset($_POST['nombre']) ? $_POST['nombre'] : NULL);
      $factura = (isset($_POST['factura']) ? $_POST['factura'] : NULL);
      $telefono = (isset($_POST['telefono']) ? $_POST['telefono'] : NULL);
      //  LLAMAMOS A UN MÉTODO PARA VALIDAR SI YA EXISTE UN USUARIO CON EL MISMO NOMBRE
      $validate = $query->validarProveedor($identificador,$nombre);
      if($validate >= 1){
        echo "Usuario ya registrado";
      }else{
        // SI NO ESTÁ REPETIDO, LLAMAMOS A UN MÉTODO PARA REGISTRARSE Y MANDAMOS LOS PARAMETROS NECESARIOS
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
    case 'registrarPersonal':
    $action_per = (isset($_POST['action_per']) ? $_POST['action_per'] : NULL);

      $nombre = (isset($_POST['nombre']) ? $_POST['nombre'] : NULL);
      $pass = (isset($_POST['pass']) ? $_POST['pass'] : NULL);
      $correo = (isset($_POST['correo']) ? $_POST['correo'] : NULL);
      $telefono = (isset($_POST['telefono']) ? $_POST['telefono'] : NULL);
      $caja = (isset($_POST['caja']) ? $_POST['caja'] : NULL);
      $rol = (isset($_POST['rol']) ? $_POST['rol'] : NULL);
      
      //  LLAMAMOS A UN MÉTODO PARA VALIDAR SI YA EXISTE UN USUARIO CON EL MISMO NOMBRE
      $validate = $query->validarPersonal($nombre);
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
      $sql = "SELECT * FROM configuracion";
    $res = mysqli_query($con, $sql);
    foreach ($res as $row) {
      $razon_social = $row['razon_social'];
      // $rfc = $row['rfc'];
      $domicilio = $row['domicilio'];
      $cpostal = $row['cpostal'];
      $telefono = $row['telefono'];
      $imagen = $row['imagen'];
    } 
    // echo json_code($razon_social);
    $json = '{"razon_social":"'.$razon_social.'","domicilio":"'.$domicilio.'","cpostal":"'.$cpostal.'","telefono":"'.$telefono.'", "imagen":"'.$imagen.'"}';
    echo $json;
    break;
    
    
    default:
      # code...
      break;
  }


}
