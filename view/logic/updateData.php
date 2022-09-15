<?php
require ("Update.php");
$query = new Update();
$table = (isset($_POST['table']) ? $_POST['table'] : NULL);
if(!empty($_POST)){
  switch ($table) {
    case 'editarProveedor';
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
    case 'updateConfi':
      $razon_social = (isset($_POST['razon_social']) ? $_POST['razon_social'] : NULL); 
      $rfc = (isset($_POST['rfc']) ? $_POST['rfc'] : NULL); 
      $domicilio = (isset($_POST['domicilio']) ? $_POST['domicilio'] : NULL); 
      $cpostal = (isset($_POST['cpostal']) ? $_POST['cpostal'] : NULL); 
      $telefono = (isset($_POST['telefono']) ? $_POST['telefono'] : NULL);
      $img = (isset($_FILES['imagen']) ? $_FILES['imagen'] : NULL);
      if ($img['size'] != 0 && $img['name'] != '') {
        $imagen = $_FILES['imagen']['name'];
        $tipo = $_FILES['imagen']['type'];
        $temp  = $_FILES['imagen']['tmp_name'];

        if (!((strpos($tipo, 'png')))) {
          echo "Solo se permiten archivos con la extensión png";
        } else {
          $updateConfiImg = $query->updateConfiImg($razon_social, $rfc, $domicilio, $cpostal, $telefono, $imagen);

          if ($updateConfiImg) {
            move_uploaded_file($temp, '../../imagenes/' . $imagen);
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
        $updateConfi = $query->updateConfi($razon_social, $rfc, $domicilio, $cpostal, $telefono);
          if ($updateConfi) {
                // echo "bien";
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
