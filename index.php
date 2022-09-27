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
    <title>Nova Tech PV</title>
</head>
<body>
    <div class="login-box1">
        <h1 class="text">Bienvenido al sistema</h1>
        <h1 class="text">Nova Tech</h1>
         <img class="log" src="assets/img/favicon.png" alt="logo">
         <br>
         <div class="input-btn-adm">
          <input onclick="location.href='login.php'"  type="submit" value="Iniciar Sesión" id="btn-send">
          <input onclick="location.href='add_negocio.php'" type="submit" value="Registrar" id="btn-send">
         </div>
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