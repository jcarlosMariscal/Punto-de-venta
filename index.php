<?php
session_start();//iniciamos una sesión
require_once "conexion/conexion.php";
$alert = "";

if(!empty($_SESSION['active'])){
    header('location: view/index.php');

}else {
  if(!empty($_POST)){//Verificamos si el usuario le ha dado click en el boton del formulario
    if(empty($_POST['username']) || empty($_POST['pass'])){// Verificamos si el campo username y la contraseña estan vacias
      $alert=' <p class="input-error-act">Ingrese su usuario y contraseña</p>';  
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
        $_SESSION['correo'] = $data['correo'];
        $_SESSION['telefono'] = $data['telefono'];
        $_SESSION['rol'] = $data['id_rol'];
        ?>
        <script>
          localStorage.setItem("login", "true");
          window.location.href = "view/index.php";
        </script>    
        <?php
      }else {
        $alert='<p class="input-error-act">El usuario y la contraseña son incorrectos.</p>';
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
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Inicio de sesión</title>
</head>
<body>
    <!-- Creación de Login -->
    <div class="login-box">
      <img class="user" src="assets/img/icono1.png" alt="logo">
        <h1 class="text">Login</h1>
        <h1 class="text">Bienvenido al sistema</h1>
                <form method="post" action="" id="formulario">
          <div class="input-adm" id="group-username">
            <input type="text" class="input-admin" name="username" id="username" placeholder="Nombre de Usuario">
            <p class="input-error-log">*El nombre no debe quedar vacío, puede tener letras y acentos.</p>
          </div>
          <div class="input-adm" id="group-pass">
            <!-- <input type="text" class="input input-config"  name="rfc" id="rfc" > -->
            <input type="password" name="pass" id="pass" placeholder="Contraseña">
            <p class="input-error-log">*La contraseña debe tener mínimo 5 caracteres, ppueden ser letras, números y no se aceptan caracteres especiales.</p>
          </div>
            <br>
            <div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>    <!-- se mostrara la alerta cuando encuentre un error -->
            <div class="input-btn-adm">
              <input type="submit" value="Iniciar Sesión" id="btn-send">
            </div>
           <br>
            <!-- <h1><a href="view/" class="btn-sesión">Iniciar Sesión</a></h1>  -->
           <p>Si usted no tiene una cuenta por favor entra a <a href="registro.php" class="quitar">Registrarse</a></p>
        </form>
    </div>
</body>
<script src="./assets/js/index.js" type="module"></script>
</html>

<script>
    let msj = localStorage.getItem("register");
    if(msj === "true"){
      Swal.fire({
            title: "Registro correcto",
            text: "Inicie sesión en el siguiente formulario",
            icon: "success",//error, 
            timer: 3000,
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            confirmButtonColor: '#47874a',
        });
    } 
    setTimeout(function(){
        localStorage.removeItem("register");
    }, 1500);
</script>