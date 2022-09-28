<?php
  require ("../config/Connection.php");
  class Update{
    public $cnx;
    function __construct(){
      $this -> cnx = Connection::connectDB();
    }
    function editarProveedor($id_prov,$identificador,$nombre,$factura,$telefono){
      try{
        $sql = "UPDATE proveedor SET identificador = ?, nombre = ?, factura = ? ,telefono = ? WHERE id = ? ";//Insertamos el registro
        $query = $this-> cnx->prepare($sql);
        $data = array($identificador,$nombre,$factura,$telefono, $id_prov);
        $insert = $query->execute($data);
        if($insert) return true;
      }catch(PDOException $th){
        echo "error";
      }

    }

    function editarPersonal($id_per,$nombre,$telefono,$correo,$rol,$pass){
      try{
        $sql = "UPDATE usuarios SET username = ?, pass = ?, correo = ?, telefono = ?,id_rol = ? WHERE id_user = ?";//Insertamos el registro
        $query = $this-> cnx->prepare($sql);
        $data = array($nombre,$pass, $correo,$telefono,$rol, $id_per);
        $insert = $query->execute($data);
        if($insert) return true;
      }catch(PDOException $th){
        echo "error";
      }
    }

    function configError($getNegocio){
      try {
        $sql = "SELECT * FROM configuracion"; // Hacer la consulta. NO MANDAR LOS VALORES DIRECTAMENTE
        $query = $this->cnx->prepare($sql); // Preparamos la consulta
        $query -> bindParam(1,$getNegocio); // Mandamos el valor de manera segura (Uno solo)
        if($query->execute()){
          echo "success";
          return $query->rowCount();
        }
      } catch (PDOException $th) {
        echo "error";
      }
    }

    function updateNegocioImg($nombre, $tipo, $telefono, $correo, $logoName, $id_negocio){
      try{
        $sql = "UPDATE negocio SET nombre = ? ,tipo = ? ,telefono = ? ,correo = ? ,logo = ? WHERE id_negocio = ?";//Insertamos el registro                           
        $query = $this-> cnx->prepare($sql);
        $data = array($nombre,$tipo,$telefono,$correo,$logoName, $id_negocio);
        $insert = $query->execute($data);
        return true;
        if($insert) echo "success";
      }catch(Exception $th) {
        echo "error";      
      }
    }

    function updateNegocio($nombre, $tipo, $telefono, $correo, $id_negocio){
      try{
        $sql = "UPDATE configuracion SET nombre = ? ,tipo = ? ,telefono = ? ,correo = ? WHERE id_negocio = ?";
        $query = $this-> cnx->prepare($sql);
        $data = array($nombre,$tipo,$telefono,$correo, $id_negocio);
        $insert = $query->execute($data);
        if($insert) echo "success";
        return true;
      }catch(Exception $th) {
        echo "error - Exception";      
      }
    }
}