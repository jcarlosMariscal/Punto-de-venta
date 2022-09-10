<?php
require ("User.php");
$query = new User();
$table = (isset($_POST['table']) ? $_POST['table'] : NULL);
if(!empty($_POST)){
  switch ($table) {
    case 'registerAdmin':
      $username = (isset($_POST['username']) ? $_POST['username'] : NULL);
      $pass = (isset($_POST['pass']) ? $_POST['pass'] : NULL);
      $rol = (isset($_POST['id_rol']) ? $_POST['id_rol'] : NULL);
      $validate = $query->validateUser($username);
      if($validate >= 1){
        echo "User with repeated name";
      }else{
        $query -> registerAdmin($username, $pass, $rol);
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
    case 'loginAdmin':
      $username = (isset($_POST['username']) ? $_POST['username'] : NULL);
      $pass = (isset($_POST['pass']) ? $_POST['pass'] : NULL);
      $query -> loginAdmin($username, $pass);
      if($query){
        ?>
          <script>
            localStorage.setItem("login", "true");
            window.location.href = "../index.php";
          </script>    
        <?php
      }else{
        ?>
          <script>
            alert("Verifique que sus datos sean correctos");
            window.location.href = "../../index.php";
          </script>    
        <?php

      }
      break;
    
    default:
      # code...
      break;
  }
}
