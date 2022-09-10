<?php
  require ("../config/Connection.php");
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
    
  }