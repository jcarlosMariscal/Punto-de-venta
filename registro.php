<?php
  include "view/config/Connection.php";
  // VALIDAR SI YA EXISTE UN ADMINISTRADOR PARA YA NO MOSTRAR EL FORMULARIO
  $cnx = Connection::connectDB();
  $admin = 1;
  $sql = "SELECT * FROM usuarios WHERE id_rol = ?";
  $query = $cnx->prepare($sql);
  $query->bindParam(1, $admin);
  $query->execute();
  if($query->rowCount() >= 1) header("Location: index.php");
  // VALIDAR SI YA EXISTE UN ADMINISTRADOR PARA YA NO MOSTRAR EL FORMULARIO
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
    <h1>Registrarse</h1>
    <h1 class="text">Bienvenido al sistema</h1>

    <form action="view/logic/userData.php" method="POST" id="formulario">
      <input type="hidden" name="table" value="registerAdmin"> <!-- CAMPO NECESARIO PARA userData.php -->
      <div class="input-adm" id="group-username">
        <input type="text" class="input-admin" name="username" id="username" placeholder="Nombre de Usuario">
        <p class="input-error-log">*El nombre no debe quedar vacío, puede tener letras y acentos.</p>
      </div>
      <div class="input-adm" id="group-pass">
        <!-- <input type="text" class="input input-config"  name="rfc" id="rfc" > -->
        <input type="password" name="pass" id="pass" placeholder="Contraseña">
        <p class="input-error-log">*La contraseña debe tener mínimo 5 caracteres, pueden ser letras, números y no se aceptan caracteres especiales.</p>
      </div>      
        <div class="select">
          <select name="id_rol">
            <option value="1">Administrador</option>
          </select>
        </div>
            <br><br>
            <div class="input-btn-adm">
              <button type="submit" id="btn-send" value="ingresar" class="btn-sesion">Registrarse</button>
              <a href="index.php" class="back" value="ingresar">Atrás</a>
            </div>
           <!-- <h1><a href="view/" class="btn-sesión">Iniciar Sesión</a></h1>  -->
        </form>
    </div>
</body>
<script src="./assets/js/index.js" type="module"></script>
</html>