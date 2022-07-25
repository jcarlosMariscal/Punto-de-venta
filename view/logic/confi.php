<?php

include('../conexion/conexion.php');

if(!empty($_POST)){//Verificamos si el usuario le ha dado click en el boton del formulario
       
    if(empty($_POST['razon_social']) || empty($_POST['rfc'] || empty($_POST['domicilio']) || empty($_POST['cpostal']) || empty($_POST['telefono']) || empty($_POST['imagen']))){// Verificamos si el campo username, contraseña y id_rol estan vacias
      $alert='<p class="msg_error">Los datos son obligatorios</p>';
    
    }else{

        $razon_social = $_POST['razon_social'];// almacenamos los campos que vienen del metodo POST
        $rfc = ($_POST['rfc']);
        $domicilio = $_POST['domicilio'];
        $cpostal = $_POST['cpostal'];
        $telefono = $_POST['telefono'];

        $imagen = $_FILES['imagen']['name'];

    if(isset($imagen) && $imagen != ""){
        $tipo = $_FILES['imagen']['type'];
        $temp  = $_FILES['imagen']['tmp_name'];
        
        if( !((strpos($tipo,'gif') || strpos($tipo,'jpeg') || strpos($tipo,'webp')|| strpos($tipo, 'png')))){
            $_SESSION['mensaje'] = 'solo se permite archivos jpeg, gif, webp';
            $_SESSION['tipo'] = 'danger';
        }else{
         $query = "INSERT INTO configuracion(razon_social,rfc,domicilio,cpostal,telefono,imagen) VALUES('$razon_social','$rfc','$domicilio','$cpostal','$telefono','$imagen')";//Insertamos el registro                           
         $resultado = mysqli_query($con,$query);

         if($resultado){
              move_uploaded_file($temp,'../imagenes/'.$imagen);   
             $_SESSION['mensaje'] = 'se ha subido correctamente';
             $_SESSION['tipo'] = 'success';
         }else{
             $_SESSION['mensaje'] = 'ocurrio un error en el servidor';
             $_SESSION['tipo'] = 'danger';
         }
       }
    }

    header('location: index.php?p=configuration');     

    }
}

?>
