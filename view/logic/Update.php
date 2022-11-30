<?php
  require ("../config/Connection.php");
  class Update{
    public $cnx;
    function __construct(){
      $this -> cnx = Connection::connectDB();
    }
    function editarProveedor($id_prov,$nombre,$telefono,$correo,$contacto,$cargo){
      try{
        $sql = "UPDATE proveedor SET nombre = ?, telefono = ?, correo = ? ,contacto = ?, cargo =? WHERE id_proveedor = ? ";//Insertamos el registro
        $query = $this-> cnx->prepare($sql);
        $data = array($nombre,$telefono,$correo,$contacto,$cargo, $id_prov);
        $insert = $query->execute($data);
        if($insert) return true;
      }catch(PDOException $th){
        echo "error";
      }
    }

    function editarPersonal($id_per,$nombre,$pass,$correo,$telefono,$ciudad,$domicilio,$id_sucursal,$id_caja,$id_rol){
      try{
        $sql = "UPDATE personal SET nombre = ?, pass = ?, correo = ?, telefono = ?, ciudad = ?,domicilio= ?, id_sucursal = ?, id_caja = ?, id_rol = ? WHERE id_personal = ?";//Insertamos el registro
        $query = $this-> cnx->prepare($sql);
        $data = array($nombre,$pass, $correo,$telefono,$ciudad,$domicilio,$id_sucursal,$id_caja,$id_rol, $id_per);
        $insert = $query->execute($data);
        if($insert) return true;
      }catch(PDOException $th){
        echo "error";
      }
    }
    function editarAdmin($id_admin,$nombre,$correo,$telefono){
      try{
        $sql = "UPDATE administrador SET nombre = ?, correo = ?, telefono = ? WHERE id_admin = ?";
        $query = $this-> cnx->prepare($sql);
        $data = array($nombre, $correo,$telefono, $id_admin);
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

    function updateNegocioImg($nombre, $telefono, $correo, $logoName, $id_tipo, $id_negocio){
      try{
        $sql = "UPDATE negocio SET nombre = ? ,telefono = ? ,correo = ? ,logo = ?, id_tipo = ? WHERE id_negocio = ?";//Insertamos el registro                           
        $query = $this-> cnx->prepare($sql);
        $data = array($nombre,$telefono,$correo,$logoName, $id_tipo, $id_negocio);
        $insert = $query->execute($data);
        return true;
        if($insert) echo "success";
      }catch(Exception $th) {
        echo "error";      
      }
    }

    function updateNegocio($nombre, $telefono, $correo, $id_tipo, $id_negocio){
      try{
        $sql = "UPDATE negocio SET nombre = ? ,telefono = ? ,correo = ?, id_tipo = ? WHERE id_negocio = ?";
        $query = $this->cnx->prepare($sql);
        $data = array($nombre,$telefono,$correo, $id_tipo, $id_negocio);
        $insert = $query->execute($data);
        if($insert) return true;
      }catch(Exception $th) {
        return false;      
      }
    }
    function actualizarDF($nombre, $rfc, $regimen, $id_negocio, $id_datos){
      try{
        $sql = "UPDATE datos_fiscales SET nombre = ? ,rfc = ? ,rFiscal = ? WHERE id_negocio = ? && id_datos = ?";
        $query = $this->cnx->prepare($sql);
        $data = array($nombre,$rfc,$regimen, $id_negocio, $id_datos);
        $insert = $query->execute($data);
        if($insert) return true;
      }catch(Exception $th) {
        return false;      
      }
    }
}