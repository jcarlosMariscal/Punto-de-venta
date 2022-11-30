<?php
require ("Update.php");
$query = new Update();
$table = (isset($_POST['table']) ? $_POST['table'] : NULL);
if(!empty($_POST)){
  switch ($table) {
    case 'editarProveedor';
      $id_prov = (isset($_POST['id_proveedor']) ? $_POST['id_proveedor'] : NULL); 
      $nombre = (isset($_POST['nombre']) ? $_POST['nombre'] : NULL);
      $telefono = (isset($_POST['telefono']) ? $_POST['telefono'] : NULL);
      $correo = (isset($_POST['correo']) ? $_POST['correo'] : NULL);
      $contacto = (isset($_POST['contacto']) ? $_POST['contacto'] : NULL);
      $cargo = (isset($_POST['cargo']) ? $_POST['cargo'] : NULL);
      $query->editarProveedor($id_prov,$nombre,$telefono,$correo,$contacto,$cargo);
      if ($query) {
      ?>
        <script>
          localStorage.setItem("modProv", "true");
          window.location.href = "../proveedor";
        </script>
      <?php
      } else {
        $alert = '<p class="msg_error">Error al crear al usuario.</p>';
      }
      break;
    case 'editarPersonal':
      $id_per = (isset($_POST['id_personal']) ? $_POST['id_personal'] : NULL); 
      $nombre = (isset($_POST['nombre']) ? $_POST['nombre'] : NULL); 
      $pass = (isset($_POST['pass']) ? $_POST['pass'] : NULL);
      $correo = (isset($_POST['correo']) ? $_POST['correo'] : NULL); 
      $telefono = (isset($_POST['telefono']) ? $_POST['telefono'] : NULL); 
      $ciudad = (isset($_POST['ciudad']) ? $_POST['ciudad'] : NULL); 
      $domicilio = (isset($_POST['domicilio']) ? $_POST['domicilio'] : NULL); 
      $id_sucursal = (isset($_POST['id_sucursal']) ? $_POST['id_sucursal'] : NULL); 
      $id_caja = (isset($_POST['id_caja']) ? $_POST['id_caja'] : NULL); 
      $id_rol = (isset($_POST['id_rol']) ? $_POST['id_rol'] : NULL);
      $query->editarPersonal($id_per, $nombre,$pass,$correo,$telefono,$ciudad,$domicilio,$id_sucursal,$id_caja,$id_rol);
      if ($query) {       
      ?>
        <script>
          localStorage.setItem("modPer", "true");
          window.location.href = "../personal";
        </script>
        <?php
      } else {
        $alert = '<p class="msg_error">Error al crear al usuario.</p>';
      }
        
    break;
    case 'editarAdmin':
      $id_admin = (isset($_POST['id_admin']) ? $_POST['id_admin'] : NULL); 
      $nombre = (isset($_POST['nombre']) ? $_POST['nombre'] : NULL);
      $correo = (isset($_POST['correo']) ? $_POST['correo'] : NULL); 
      $telefono = (isset($_POST['telefono']) ? $_POST['telefono'] : NULL); 
      $query->editarAdmin($id_admin, $nombre,$correo,$telefono);
      if ($query) {       
      ?>
        <script>
          localStorage.setItem("modAdmin", "true");
          window.location.href = "../personal";
        </script>
        <?php
      } else {
        $alert = '<p class="msg_error">Error al modificar administrador.</p>';
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
              window.location.href = "../configuracion";
            </script>
          <?php
        } else {
          $updateNegocioImg = $query->updateNegocioImg($nombre, $telefono, $correo, $logoName, $id_tipo, $id_negocio);
          if ($updateNegocioImg) {
            move_uploaded_file($temp, '../../assets/img/logo/' . $logoName);
          ?>
            <script>
              localStorage.setItem("configuration", "actualizado");
              window.location.href = "../configuracion";
            </script>
          <?php
          } else {
            ?>
              <script>
                localStorage.setItem("configuration", "error");
                window.location.href = "../configuracion";
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
                window.location.href = "../configuracion";
              </script>
            <?php 
          }else{
            ?>
              <script>
                localStorage.setItem("configuration", "error");
                window.location.href = "../configuracion";
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
                window.location.href = "../configuracion";
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
