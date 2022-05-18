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

        <form>
            <input type="text" placeholder="Nombre de Usuario">
            
            <input type="password" placeholder="Contraseña">
            <div class="select">
                <select name="format" id="format">
                    <option select disable>Selecciones el rol</option>
                    <option value="admin">Aministrador</option>
                    <option value="vendedor">Vendedor</option>
                </select>
            </div>
            <br><br>
           <h1><a href="view/" class="btn-sesión">Iniciar Sesión</a></h1> 
        </form>
    </div>
</body>
</html>