<?php
include "conexion/conexion.php";
$alert = "";        
   if(!empty($_POST)){//Verificamos si el usuario le ha dado click en el boton del formulario
       
        if(empty($_POST['username']) || empty($_POST['pass'] || empty($_POST['id_rol']))){// Verificamos si el campo username, contraseña y id_rol estan vacias
          $alert='<p class="msg_error">Los datos son obligatorios</p>';
        
        }else{

            $username = $_POST['username'];// almacenamos los campos que vienen del metodo POST
            $pass = md5($_POST['pass']);
            $rol = $_POST['id_rol'];
            
            $sql = "SELECT * FROM usuarios WHERE username = '$username' OR pass='$pass'";//Realizamos un select de la tabla usuarios
            $query = mysqli_query($con,$sql);//resivimos los parametros de la consulta SQL
            // mysqli_close($con);
            $resultado = mysqli_fetch_array($query); //Obtenemos el resultado en un array y lo almacenamos en la variable resultado
            // echo "SELECT * FROM usuarios WHERE username = '$username' OR pass='$pass' AND id_rol = '$roll'";//Creamos una variable y dentro guardamos la consulta sql

            if($resultado > 0){//Comprobamos si el resultado es mayor a 0, entonces existe un usuario con el mismo nombre
                $alert='<p class="msg_error">El usuario ya existe.</p>';

            }else{ 
                $sql = "INSERT INTO usuarios(username,pass,id_rol) VALUES('$username','$pass','$rol')";//Insertamos el registro
                $query_insert = mysqli_query($con,$sql);//resivimos los parametros de la consulta SQL

                if($query_insert){//Verificamos si la variable $query_insert es igual a true, se registro correctamente el usuario
                    $alert='<p class="msg_save">Usuario registrado correctamente.</p>';
                
                }else{
                    $alert='<p class="msg_error">Error al crear al usuario.</p>';

                }
            }             
            
        }
   }
   


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@100;200&family=Hind+Siliguri:wght@300&family=Montserrat:ital,wght@1,300&family=Roboto:wght@100&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Inicio de sesión</title>
</head>
<body>
    <!-- Creación de Login -->
    <div class="login-box">
        <h1>Registrarse</h1>
        <h1 class="text">Bienvenido al sistema</h1>
        <div class="alert"><?php echo isset($alert) ? $alert : '';?></div><!-- if simplificado -->

        <form action="" method="POST" > 
            <input type="text" name="username" placeholder="Nombre de Usuario">
            
            <input type="password" name="pass" placeholder="Contraseña">
            <?php 
            $sql = "SELECT * FROM roles";//realizamos una cosulta
            $query_rol = mysqli_query($con,$sql);
            mysqli_close($con);

            $result_rol = mysqli_num_rows($query_rol);//devuele las filas de la consulta

            ?>
            <div class="select">
                <select name="id_rol">
            <?php
                if($result_rol > 0){// Si el result_rol es mayor a cero
                    while($rol = mysqli_fetch_array($query_rol)){
            ?>
                <option value="<?php echo $rol["id_rol"]; ?>"><?php echo $rol["rol"]?></option>
            <?php
                    }
                }

            ?>
                </select>
            </div>
            <br><br>
            <button type="submit" value="ingresar" class="btn-sesion">Registrarse</button>
           <!-- <h1><a href="view/" class="btn-sesión">Iniciar Sesión</a></h1>  -->
        </form>
    </div>
</body>
</html>