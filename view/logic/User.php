<?php
  require ("../config/Connection.php"); // LLAMAMOS A LA CLASE QUE RETORNA LA CONEXIÓN
  session_start(); 
  class User{
    public $cnx;
    function __construct(){
      $this -> cnx = Connection::connectDB(); // ACCEMOS AL MÉTODO QUE RETORNA LA VARIABLE DE CONEXIÓN
    }
    function validateUser($username){ // MÉTODO QUE VALIDA SI EL NOMBRE DE USUARIO ESTÁ REPETIDO
      try {
        $sql = "SELECT * FROM usuarios WHERE username = ?"; // Hacer la consulta. NO MANDAR LOS VALORES DIRECTAMENTE
        $query = $this->cnx->prepare($sql); // Preparamos la consulta
        $query -> bindParam(1, $username); // Mandamos el valor de manera segura (Uno solo)
        if($query->execute()){
          echo "success";
          return $query->rowCount();
        }
      } catch (PDOException $th) {
        echo "error";
      }
    }
    function registerAdmin($nombre, $pass){ // MÉTODO QUE REGISTRA AL ADMINISTRADOR
      try {
        $id_negocio=1;
        $sql = "INSERT INTO administrador(nombre,pass, id_negocio) VALUES (?,?, ?)"; // Hacer la consulta. NO MANDAR LOS VALORES DIRECTAMENTE
        $query = $this->cnx->prepare($sql); // Preparar la consulta
        $encrypt = password_hash($pass, PASSWORD_BCRYPT); // Encriptar la contraseña
        $data = array($nombre,$encrypt, $id_negocio); // Mandar los valores de manera segura en forma de arreglo (Varios)
        $insert = $query -> execute($data);
        if($insert) echo "success";
      } catch (PDOException $th) {
        echo "error";
      }
    }
    function loginUser($nombre, $pass){
      try {
        $sql = "SELECT * FROM administrador WHERE nombre = ?";
        $query = $this->cnx->prepare($sql);
        $query -> bindParam(1,$nombre);
        $query->execute();
        $count = $query->rowCount();
        if($count >= 1){
          foreach($query as $data){
            if(password_verify($pass,$data['pass'])){
                    // $_SESSION["admin"] = $data; // GUARDA LA SESIÓN PARA USARLO DESPUÉS
              $_SESSION['rol'] = 0;
              $_SESSION['user'] = $data;
              $_SESSION['user']['id_sucursal'] = 1;
              $_SESSION['user']['id_user'] = $data['id_admin'];

              return true;
            }else{
              return false;
            }
          }
        }else {
          $sql = "SELECT * FROM personal WHERE nombre = ?";
          $query = $this->cnx->prepare($sql);
          $query -> bindParam(1,$nombre);
          $query->execute();
          foreach($query as $data){
            if(password_verify($pass,$data['pass'])){
              // $_SESSION["admin"] = $data; // GUARDA LA SESIÓN PARA USARLO DESPUÉS
              $_SESSION['rol'] = $data['id_rol'];
              $_SESSION['user'] = $data;
              $_SESSION['user']['id_user'] = $data['id_personal'];
              $_SESSION['user']['id_negocio'] = 1;
              return true;
            }else{
              return false;
            }
          }
        }
      } catch (PDOException $th) {
        echo "error";
      }
    }
  }