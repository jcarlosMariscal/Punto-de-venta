<?php
  include('../../conexion/conexion.php');

  if(!empty($_POST)){//Verificamos si el usuario le ha dado click en el boton del formulario
    if(empty($_POST['razon_social']) || empty($_POST['rfc'] || empty($_POST['domicilio']) || empty($_POST['cpostal']) || empty($_POST['telefono']))){// Verificamos si el campo username, contraseña y id_rol estan vacias
      $alert='<p class="msg_error">Los datos son obligatorios</p>';
    }else{
      $razon_social = $_POST['razon_social'];// almacenamos los campos que vienen del metodo POST
      $rfc = ($_POST['rfc']);
      $domicilio = $_POST['domicilio'];
      $cpostal = $_POST['cpostal'];
      $telefono = $_POST['telefono'];
      $img = (isset($_FILES['imagen']) ? $_FILES['imagen'] : NULL);
      if ($img['size'] != 0 && $img['name'] != '') {
        $imagen = $_FILES['imagen']['name'];
        $tipo = $_FILES['imagen']['type'];
        $temp  = $_FILES['imagen']['tmp_name'];
        
          if( !((strpos($tipo, 'png')))){
            $_SESSION['mensaje'] = 'solo se permite archivos png';
            $_SESSION['tipo'] = 'danger';
          }else{
            $query = "UPDATE configuracion SET razon_social = '$razon_social' ,rfc = '$rfc' ,domicilio = '$domicilio' ,cpostal = '$cpostal' ,telefono = '$telefono' ,imagen = '$imagen' WHERE id = 1";//Insertamos el registro                           
            $resultado = mysqli_query($con,$query);

            if($resultado){
              move_uploaded_file($temp,'../../imagenes/'.$imagen);   
              $_SESSION['mensaje'] = 'se ha subido correctamente';
              $_SESSION['tipo'] = 'success';
            }else{
              $_SESSION['mensaje'] = 'ocurrio un error en el servidor';
              $_SESSION['tipo'] = 'danger';
            }
          }
      }else{
        $query = "UPDATE configuracion SET razon_social = '$razon_social' ,rfc = '$rfc' ,domicilio = '$domicilio' ,cpostal = '$cpostal' ,telefono = '$telefono'  WHERE id = 1";//Insertamos el registro                           
        $resultado = mysqli_query($con,$query);
        if($resultado){
          ?>
            <script>
              localStorage.setItem("insert", "true");
              window.location.href = "../index.php?p=configuration";
            </script>
          <?php
            // header('location: ../index.php?p=configuration');  
        }
      }   
    }
  }
?>
