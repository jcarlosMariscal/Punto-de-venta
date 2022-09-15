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
        $data = array($id_prov,$identificador,$nombre,$factura,$telefono);
        $insert = $query->execute($data);
        if($insert) echo "success";
      }catch(PDOException $th){
        echo "error";
      }

    }

    function editarPersonal($id_per,$nombre,$telefono,$correo,$rol,$pass){
      try{
        $sql = "UPDATE usuarios SET username = ?, pass = ?, correo = ?, telefono = ?,id_rol = ? WHERE id_user = ?";//Insertamos el registro
        $query = $this-> cnx->prepare($sql);
        $data = array($id_per,$nombre,$telefono,$correo,$rol,$pass);
        $insert = $query->execute($data);
        if($insert) echo "success";
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

    function updateConfiImg($razon_social,$rfc,$domicilio,$cpostal,$telefono,$imagen){
      try{
        $id = 1;
        $sql = "UPDATE configuracion SET razon_social = ? ,rfc = ? ,domicilio = ? ,cpostal = ? ,telefono = ? ,imagen = ? WHERE id = ?";//Insertamos el registro                           
        $query = $this-> cnx->prepare($sql);
        $data = array($razon_social,$rfc,$domicilio,$cpostal,$telefono,$imagen, $id);
        $insert = $query->execute($data);
        return true;
        if($insert) echo "success";
      }catch(Exception $th) {
        echo "error";      
      }
    }

    function updateConfi($razon_social,$rfc,$domicilio,$cpostal,$telefono){
      try{
        $id = 1;
        $sql = "UPDATE configuracion SET razon_social = ? ,rfc = ? ,domicilio = ? ,cpostal = ? ,telefono = ? WHERE id = ?";//Insertamos el registro                           
        $query = $this-> cnx->prepare($sql);
        $data = array($razon_social,$rfc,$domicilio,$cpostal,$telefono, $id);
        $insert = $query->execute($data);
        if($insert) echo "success";
        return true;
      }catch(Exception $th) {
        echo "error - Exception";      
      }
    }
}