<?php
  session_start();//iniciamos una sesión
  if(!empty($_SESSION['user'])){
      header('location: view/index.php');
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
<body class="body-login fond">
    <!-- Creación de Login -->
    <div class="login-box">
      <img class="user" src="assets/img/icono1.png" alt="logo">
        <h1 class="text">Login</h1>
        <h2 class="bienv">Bienvenido al sistema</h2>
        <form method="post" action="view/logic/userData.php" id="formulario">
          <input type="hidden" name="table" value="loginUser"> <!-- CAMPO NECESARIO PARA userData.php  -->
          <div class="input-adm" id="group-username">
            <input type="text" class="input-admin" name="username" id="username" placeholder="Nombre de Usuario">
            <p class="input-error-log">*El nombre no debe quedar vacío, puede tener letras y acentos.</p>
          </div>
          <div class="input-adm" id="group-pass">
            <!-- <input type="text" class="input input-config"  name="rfc" id="rfc" > -->
            <input type="password" name="pass" id="pass" placeholder="Contraseña">
            <p class="input-error-log">*La contraseña debe tener mínimo 5 caracteres, pueden ser letras, números y no se aceptan caracteres especiales.</p>
          </div>
            <br>
            <div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>    <!-- se mostrara la alerta cuando encuentre un error -->
            <div class="input-btn-adm">
              <input type="submit" value="Iniciar Sesión" id="btn-send">
            </div>
           <br>
            <!-- <h1><a href="view/" class="btn-sesión">Iniciar Sesión</a></h1>  -->
           <p class="cuent">¿Nuevo aquí? <a href="registro" class="quitar">Crear una cuenta</a></p>
        </form>
    </div>
</body>
<script src="./assets/js/index.js" type="module"></script>
</html>

<script>
    let msj = localStorage.getItem("alert");
    if(msj === "show"){
      Swal.fire({
            title: "Registro completado",
            text: "Inicie sesión a continuación",
            icon: "success",//error, 
            timer: 3000,
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            confirmButtonColor: '#47874a',
        });
    } 
    setTimeout(function(){
        localStorage.removeItem("alert");
    }, 1500);
</script>