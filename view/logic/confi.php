<?php
  include('../../conexion/conexion.php');

  $getNegocio = (isset($_POST['getNegocio']) ? $_POST['getNegocio'] : NULL);
  if($getNegocio){
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
  }else{
    if(!empty($_POST)){//Verificamos si el usuario le ha dado click en el boton del formulario
    if(empty($_POST['razon_social']) || empty($_POST['rfc'] || empty($_POST['domicilio']) || empty($_POST['cpostal']) || empty($_POST['telefono']))){
      echo "confiError";
      ?>
      <script>
          localStorage.setItem("confiError", "true");
          window.location.href = "../index.php?p=configuration";
        </script>    
        <?php
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
              ?>
              <script>
              localStorage.setItem("confi", "true");
              window.location.href = "../index.php?p=configuration";
            </script>
              <?php
            }else{
              $_SESSION['mensaje'] = 'ocurrio un error en el servidor';
              $_SESSION['tipo'] = 'danger';
              echo "error";
            }
          }
      }else{
        $query = "UPDATE configuracion SET razon_social = '$razon_social' ,rfc = '$rfc' ,domicilio = '$domicilio' ,cpostal = '$cpostal' ,telefono = '$telefono'  WHERE id = 1";//Insertamos el registro                           
        $resultado = mysqli_query($con,$query);
        if($resultado){
          // echo "bien";
          ?>
            <script>
              localStorage.setItem("confi", "true");
              window.location.href = "../index.php?p=configuration";
            </script>
          <?php
            // header('location: ../index.php?p=configuration');  
        }
        echo "error";
      }   
    }
  }
  }
  
?>
