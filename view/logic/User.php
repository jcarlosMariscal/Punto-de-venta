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
        $sql = "INSERT INTO administrador(nombre,pass) VALUES (?,?)"; // Hacer la consulta. NO MANDAR LOS VALORES DIRECTAMENTE
        $query = $this->cnx->prepare($sql); // Preparar la consulta
        $encrypt = password_hash($pass, PASSWORD_BCRYPT); // Encriptar la contraseña
        $data = array($nombre,$encrypt); // Mandar los valores de manera segura en forma de arreglo (Varios)
        $insert = $query -> execute($data);
        if($insert) echo "success";
      } catch (PDOException $th) {
        echo "error";
      }
    }
    function loginAdmin($nombre, $pass){
      try {
        $sql = "SELECT * FROM administrador WHERE nombre = ?";
        $query = $this->cnx->prepare($sql);
        $query -> bindParam(1,$nombre);
        if($query->execute()){
            foreach($query as $data){
                if(password_verify($pass,$data['pass'])){
                    // $_SESSION["admin"] = $data; // GUARDA LA SESIÓN PARA USARLO DESPUÉS
                    $_SESSION['active'] = true;
                    $_SESSION['id'] = $data['id_admin'];
                    $_SESSION['user'] = $data['nombre'];
                    $_SESSION['correo'] = $data['correo'];
                    $_SESSION['telefono'] = $data['telefono'];
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