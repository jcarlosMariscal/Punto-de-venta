<?php
require ("User.php"); // LLAMAMOS A LA CLASE
$query = new User(); // INSTANCIAMOS LA CLASE PARA ACCEDER A LOS MÉTODOS
// CAMPO OCULTO DE FORMULARIO PARA TOMAR LA DESICIÓN DE QUE ACCIÓN TOMAR
$table = (isset($_POST['table']) ? $_POST['table'] : NULL); 
if(!empty($_POST)){
  switch ($table) {
    case 'registerAdmin': // REGISTRAR ADMINISTRADOR
      // VALIDAMOS SI SE RECIBEN LOS DATOS, SI NO MANDALOS LOS VALORES COMO NULO.
      $nombre = (isset($_POST['username']) ? $_POST['username'] : NULL);
      $pass = (isset($_POST['pass']) ? $_POST['pass'] : NULL);
      // $rol = (isset($_POST['id_rol']) ? $_POST['id_rol'] : NULL);
      // LLAMAMOS A UN MÉTODO PARA VALIDAR SI YA EXISTE UN USUARIO CON EL MISMO NOMBRE
      $validate = $query->validateUser($nombre);
      if($validate >= 1){
        echo "User with repeated name";
      }else{
        // SI NO ESTÁ REPETIDO, LLAMAMOS A UN MÉTODO PARA REGISTRARSE Y MANDAMOS LOS PARAMETROS NECESARIOS
        $query -> registerAdmin($nombre, $pass);
        if($query){
          ?>
            <script>
              localStorage.setItem("register", "true");
              window.location.href = "../index.php";
            </script>
          <?php
        }
      }
      break;
    case 'loginUser': // INICIAR SESIÓN
      // VALIDAMOS SI SE RECIBEN LOS DATOS, SI NO MANDALOS LOS VALORES COMO NULO.
      $username = (isset($_POST['username']) ? $_POST['username'] : NULL);
      $pass = (isset($_POST['pass']) ? $_POST['pass'] : NULL);
      // LLAMAMOS A UN MÉTODO PARA INICIAR SESIÓN Y NANDALOS LOS PARAMETROS NECESARIOS
      $query -> loginUser($username, $pass);
      if($query){
        ?>
          <script>
            localStorage.setItem("login", "true");
            window.location.href = "../inicio";
          </script>    
        <?php
      }else{
        ?>
          <script>
            alert("Verifique que sus datos sean correctos");
            window.location.href = "bienvenido";
          </script>    
        <?php

      }
      break;
    
    default:
      # code...
      break;
  }
}
