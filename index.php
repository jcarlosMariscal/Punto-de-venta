<?php
session_start();//iniciamos una sesión
require_once "conexion/conexion.php";
$alert = "";

if(!empty($_SESSION['active'])){
    header('location: view/index.php');

}else {
  if(!empty($_POST)){//Verificamos si el usuario le ha dado click en el boton del formulario
    if(empty($_POST['username']) || empty($_POST['pass'])){// Verificamos si el campo username y la contraseña estan vacias
      $alert='<p class="msg_error">ingrese su usuario y contraseña</p>';  
    }else{
      $username = mysqli_real_escape_string($con,$_POST['username']);//Obtenemos el valor de username con el metodo POST, la funcion mysqli_real_escape_string se utliza para crear una cadena sql legal 
      $pass = md5(mysqli_real_escape_string($con,$_POST['pass']));// md5 se utliza para incriptar la contraseña

      $sql = "SELECT * FROM usuarios  where username='$username' and pass='$pass'";//Creamos una variable y dentro guardamos la consulta sql
      // mysqli_close($conn);
      $query = mysqli_query($con,$sql); //resive dos parametros la conexion y la consulta realizada

      $resultado = mysqli_num_rows($query);//guardamos el resultado de la consulta

      if($resultado > 0){// validamos si e resultado es mayor a 0, mostramos el resultado
        $data = mysqli_fetch_array($query);

        $_SESSION['active'] = true;
        $_SESSION['id'] = $data['id_user'];
        $_SESSION['user'] = $data['username'];
        $_SESSION['rol'] = $data['id_rol'];

        header('location: view/index.php');     
      }else {
        $alert='<p class="msg_error">El usuario y la contraseña son incorrectos.</p>';
        session_destroy();
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
    <link rel="shortcut icon" href="assets/img/favicon.png" type="image/x-icon">
    <title>Inicio de sesión</title>
</head>
<body>
    <!-- Creación de Login -->
    <div class="login-box">
        <h1 class="text">Login</h1>
        <h1 class="text">Bienvenido al sistema</h1>
        <form method="post" action="">
            <input type="text" name="username" placeholder="Nombre de Usuario">
            <input type="password" name="pass" placeholder="Contraseña">
            <br>
            <div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>    <!-- se mostrara la alerta cuando encuentre un error -->
            <button type="submit"  class="btn-sesion" value="Ingresar">Iniciar Sesión</button>
           <br>
           <br>
            <!-- <h1><a href="view/" class="btn-sesión">Iniciar Sesión</a></h1>  -->
           <p>Si usted no tiene una cuenta por favor entra a <a href="registro.php" class="quitar">Registrarse</a></p>
        </form>
    </div>
</body>
</html>