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
      $id_tipo = (isset($_POST['tipo']) ? $_POST['tipo'] : NULL); 
      $telefono = (isset($_POST['telefono']) ? $_POST['telefono'] : NULL); 
      $correo = (isset($_POST['correo']) ? $_POST['correo'] : NULL); 
      $id_negocio = (isset($_POST['id_negocio']) ? $_POST['id_negocio'] : NULL); 
      $imagen = (isset($_FILES['logo']) ? $_FILES['logo'] : NULL);
      if ($imagen['size'] != 0 && $imagen['name'] != '') {
        $logoName = $_FILES['logo']['name'];
        $tipo = $_FILES['logo']['type'];
        $temp  = $_FILES['logo']['tmp_name'];

        if (!((strpos($tipo, 'png')))) {
          ?>
            <script>
              localStorage.setItem("configuration", "errExtension");
              window.location.href = "../index.php?p=configuration";
            </script>
          <?php
        } else {
          $updateNegocioImg = $query->updateNegocioImg($nombre, $telefono, $correo, $logoName, $id_tipo, $id_negocio);
          if ($updateNegocioImg) {
            move_uploaded_file($temp, '../../assets/img/logo/' . $logoName);
          ?>
            <script>
              localStorage.setItem("configuration", "actualizado");
              window.location.href = "../index.php?p=configuration";
            </script>
          <?php
          } else {
            ?>
              <script>
                localStorage.setItem("configuration", "error");
                window.location.href = "../index.php?p=configuration";
              </script>
            <?php 
          }
        }
      } else {
        echo $imagen['name'];
        $updateNegocio = $query->updateNegocio($nombre, $telefono, $correo, $id_tipo, $id_negocio);
          if ($updateNegocio) {
            ?>
              <script>
                localStorage.setItem("configuration", "actualizado");
                window.location.href = "../index.php?p=configuration";
              </script>
            <?php 
          }else{
            ?>
              <script>
                localStorage.setItem("configuration", "error");
                window.location.href = "../index.php?p=configuration";
              </script>
            <?php 
          }
        }
      break;
      case 'datos_fiscales':
        $nombre = (isset($_POST['nombre']) ? $_POST['nombre'] : NULL);
        $rfc = (isset($_POST['rfc']) ? $_POST['rfc'] : NULL);
        $regimen = (isset($_POST['regimen']) ? $_POST['regimen'] : NULL);
        $id_negocio = (isset($_POST['id_negocio']) ? $_POST['id_negocio'] : NULL);
        $id_datos = (isset($_POST['id_datos']) ? $_POST['id_datos'] : NULL);
        $actualizarDF = $query->actualizarDF($nombre, $rfc, $regimen, $id_negocio, $id_datos);
        if($actualizarDF) {
          ?>
              <script>
                localStorage.setItem("configuration", "DFActualizado");
                window.location.href = "../index.php?p=configuration";
              </script>
            <?php 
        }else {
          echo "error";
        }
      break;

    default:
      # code...
      break;
  }

}
