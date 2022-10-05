<?php
  require ("../config/Connection.php");
  class Delete{
    public $cnx;
    function __construct(){
      $this -> cnx = Connection::connectDB();
    }
    function deletePersonal($id){
      $sql = "DELETE FROM personal WHERE id_personal = ?";
      $query = $this->cnx->prepare($sql); // Preparamos la consulta
      $query -> bindParam(1,$id); // Mandamos el valor de manera segura (Uno solo)
      if($query->execute()){
        return true;
      }else{
        return false;
      }
    }
    function deleteProveedor($id){
      $sql = "DELETE FROM proveedor WHERE id_proveedor = ?";
      $query = $this->cnx->prepare($sql); // Preparamos la consulta
      $query -> bindParam(1,$id); // Mandamos el valor de manera segura (Uno solo)
      if($query->execute()){
        return true;
      }else{
        return false;
      }
    }
  }