<?php
  require ("../config/Connection.php");
  session_start();
  class User{
    public $cnx;
    function __construct(){
      $this -> cnx = Connection::connectDB();
    }
    function validateUser($username){
      try {
        $sql = "SELECT * FROM usuarios WHERE username = ?";
        $query = $this->cnx->prepare($sql);
        $query -> bindParam(1, $username);
        if($query->execute()){
          echo "success";
          return $query->rowCount();
        }
      } catch (PDOException $th) {
        echo "error";
      }
    }
    function registerAdmin($username, $pass, $id_rol){
      try {
        $sql = "INSERT INTO usuarios(username,pass,id_rol) VALUES (?,?,?)";
        $query = $this->cnx->prepare($sql);
        $encrypt = password_hash($pass, PASSWORD_BCRYPT);
        $data = array($username,$encrypt,$id_rol);
        $insert = $query -> execute($data);
        if($insert) echo "success";
      } catch (PDOException $th) {
        echo "error";
      }
    }
    function loginAdmin($username, $pass){
      try {
        $sql = "SELECT * FROM usuarios WHERE username = ?";
        $query = $this->cnx->prepare($sql);
        $query -> bindParam(1,$username);
        if($query->execute()){
            foreach($query as $data){
                if(password_verify($pass,$data['pass'])){
                    // $_SESSION["admin"] = $data; // GUARDA LA SESIÓN PARA USARLO DESPUÉS
                    $_SESSION['active'] = true;
                    $_SESSION['id'] = $data['id_user'];
                    $_SESSION['user'] = $data['username'];
                    $_SESSION['correo'] = $data['correo'];
                    $_SESSION['telefono'] = $data['telefono'];
                    $_SESSION['rol'] = $data['id_rol'];
                    $_SESSION['id_caja'] = $data['id_caja'];
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