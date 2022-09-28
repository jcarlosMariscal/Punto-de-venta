<?php
require ("Update.php");
$query = new Update();
$table = (isset($_POST['table']) ? $_POST['table'] : NULL);
if(!empty($_POST)){
  switch ($table) {
    case 'editarProveedor';
      $id_prov = (isset($_POST['id_prov']) ? $_POST['id_prov'] : NULL); 
      $identificador = (isset($_POST['identificador']) ? $_POST['identificador'] : NULL);
      $nombre = (isset($_POST['nombre']) ? $_POST['nombre'] : NULL);
      $factura = (isset($_POST['factura']) ? $_POST['factura'] : NULL);
      $telefono = (isset($_POST['telefono']) ? $_POST['telefono'] : NULL);

      $query->editarProveedor($id_prov, $identificador, $nombre, $factura, $telefono);
      if ($query) {
      ?>
        <script>
          localStorage.setItem("modProv", "true");
          window.location.href = "../index.php?p=proveedor";
        </script>
      <?php
      } else {
        $alert = '<p class="msg_error">Error al crear al usuario.</p>';
      }
      break;
    case 'editarPersonal';
      $id_per = (isset($_POST['id_per']) ? $_POST['id_per'] : NULL); 
      $nombre = (isset($_POST['nombre']) ? $_POST['nombre'] : NULL); 
      $telefono = (isset($_POST['telefono']) ? $_POST['telefono'] : NULL); 
      $correo = (isset($_POST['correo']) ? $_POST['correo'] : NULL); 
      $rol = (isset($_POST['rol']) ? $_POST['rol'] : NULL);
      $pass = (isset($_POST['pass']) ? $_POST['pass'] : NULL);
      $query->editarPersonal($id_per, $nombre, $telefono, $correo, $rol, $pass);
      if ($query) {
        
      ?>
        <script>
          localStorage.setItem("modPer", "true");
          window.location.href = "../index.php?p=personal";
        </script>
        <?php
      } else {
        $alert = '<p class="msg_error">Error al crear al usuario.</p>';
      }         
    break;
    case 'updateNegocio':
      $nombre = (isset($_POST['nombre']) ? $_POST['nombre'] : NULL); 
      $tipo = (isset($_POST['tipo']) ? $_POST['tipo'] : NULL); 
      $telefono = (isset($_POST['telefono']) ? $_POST['telefono'] : NULL); 
      $correo = (isset($_POST['correo']) ? $_POST['correo'] : NULL); 
      $imagen = (isset($_FILES['logo']) ? $_FILES['logo'] : NULL);
      if ($imagen['size'] != 0 && $imagen['name'] != '') {
        $logoName = $_FILES['logo']['name'];
        $tipo = $_FILES['logo']['type'];
        $temp  = $_FILES['logo']['tmp_name'];

        if (!((strpos($tipo, 'png')))) {
          echo "Solo se permiten archivos con la extensión png";
        } else {
          $updateNegocioImg = $query->updateNegocioImg($nombre, $tipo, $telefono, $correo, $logoName);
          if ($updateNegocioImg) {
            move_uploaded_file($temp, '../../assets/img/logo/' . $logoName);
            echo 'se ha subido correctamente';
          ?>
            <script>
              localStorage.setItem("confi", "true");
              window.location.href = "../index.php?p=configuration";
            </script>
          <?php
          } else {
            echo'ocurrio un error en el servidor';
          }
        }
      } else {
        $updateNegocio = $query->updateNegocio($nombre, $tipo, $telefono, $correo);
          if ($updateNegocio) {
            ?>
              <script>
                localStorage.setItem("confi", "true");
                window.location.href = "../index.php?p=configuration";
              </script>
            <?php 
          }else{
            echo "error - UpdateData";
          }
        }
      break;

    default:
      # code...
      break;
  }

}
