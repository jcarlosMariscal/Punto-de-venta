<?php
  require ("../config/Connection.php");
  class Create{
    public $cnx;
    function __construct(){
      $this -> cnx = Connection::connectDB();
    }
    function validateNameUser($nombre, $table, $field){ // MÉTODO QUE VALIDA SI EL NOMBRE DE USUARIO ESTÁ REPETIDO
      try {
        $sql = "SELECT * FROM $table WHERE $field = ? "; // Hacer la consulta. NO MANDAR LOS VALORES DIRECTAMENTE
        $query = $this->cnx->prepare($sql); // Preparamos la consulta
        $query -> bindParam(1,$nombre); // Mandamos el valor de manera segura (Uno solo)
        if($query->execute()){
          echo "success";
          return $query->rowCount();
        }
      } catch (PDOException $th) {
        echo "error";
      }
    }


    function registrarProveedor($identificador,$nombre,$factura,$telefono){
      try{
        $sql = "INSERT INTO proveedor(identificador,nombre,factura,telefono) VALUES(?,?,?,?)"; //Insertamos el registro
        $query = $this->cnx->prepare($sql); // Preparar la consulta
        $data = array($identificador,$nombre,$factura,$telefono); // Mandar los valores de manera segura en forma de arreglo (Varios)
        $insert = $query -> execute($data);//ejecutamos la consulta
        if($insert) echo "success";
      }catch (PDOException $th){
        echo "error";
      }

    }


    

    //Validar personal
    function validarPersonal($nombre){
      try {
        $sql = "SELECT * FROM usuarios WHERE username = ?"; // Hacer la consulta. NO MANDAR LOS VALORES DIRECTAMENTE
        $query = $this->cnx->prepare($sql); // Preparamos la consulta
        $query -> bindParam(1,$nombre); // Mandamos el valor de manera segura (Uno solo)
        if($query->execute()){
          echo "success";
          return $query->rowCount();
        }
      } catch (PDOException $th) {
        echo "error";
      }

    }

    //Registrar personal
    function registrarPersonal($nombre,$pass,$correo,$telefono,$caja,$rol){
        try{
          $sql = "INSERT INTO usuarios(username,pass,correo,telefono,id_caja, id_rol) VALUES(?,?,?,?,?,?)"; //Insertamos el registro
          $query = $this->cnx->prepare($sql); // Preparar la consulta
          $encrypt = password_hash($pass, PASSWORD_BCRYPT); // Encriptar la contraseña
          $data = array($nombre,$encrypt,$correo,$telefono,$caja,$rol); // Mandar los valores de manera segura en forma de arreglo (Varios)
          $insert = $query -> execute($data);//ejecutamos la consulta
          if($insert) return true;

        }catch (PDOException $th){
          echo "error";
        }

    }


  }