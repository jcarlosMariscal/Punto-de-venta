<?php
  class Read{
    public $cnx;
    function __construct(){
      $this -> cnx = Connection::connectDB();
    }
    function readNegocio($id_negocio){
      try {
        $sql = "SELECT nombre,telefono,correo,logo,id_tipo from negocio WHERE id_negocio = ?";
        $query = $this->cnx->prepare($sql);
        $query -> bindParam(1, $id_negocio);
        $read = $query->execute();
        if($read) return $query;
      } catch (PDOException $th) {
        return false;
      }
    }
    function readTipo(){
      try {
        $sql = "SELECT * from tipo_negocio";
        $query = $this->cnx->prepare($sql);
        $read = $query->execute();
        if($read) return $query;
      } catch (PDOException $th) {
        return false;
      }
    }
    function readTipoSelected($id_tipo){
      try {
        $sql = "SELECT id_tipo,tipo from tipo_negocio WHERE id_tipo = ?";
        $query = $this->cnx->prepare($sql);
        $query -> bindParam(1, $id_tipo);
        $read = $query->execute();
        if($read) return $query;
        if($read) return $query;
      } catch (PDOException $th) {
        return false;
      }
    }
    function buscarDatosFiscales($id_negocio){
      try {
        $sql = "SELECT * FROM datos_fiscales WHERE id_negocio = ?";
        $query = $this->cnx->prepare($sql);
        $query->bindParam(1, $id_negocio);
        $insert = $query -> execute();
        if($insert) {
          $count = $query->rowCount();
          return [true, $count];
        };
      } catch (PDOException $th) {
        return [false, 0];
      }
    }
    function obtenerDatosFiscales($id_negocio){
      try {
        $sql = "SELECT id_datos,nombre,rfc,rFiscal FROM datos_fiscales WHERE id_negocio = ?";
        $query = $this->cnx->prepare($sql);
        $query->bindParam(1, $id_negocio);
        $insert = $query -> execute();
        if($insert) return $query;
      } catch (PDOException $th) {
        return false;
      }
    }
    // ------------------------personal  
    function selectPersonal()
    {
        try {
            $sql = "SELECT * from personal";
            $query = $this->cnx->prepare($sql);
            $read = $query->execute();
            if ($read) return $query;
        } catch (PDOException $th) {
            return false;
        }
    }
    function idSucursal()
    {
        try {
            $sql = "SELECT * from sucursal";
            $query = $this->cnx->prepare($sql);
            $read = $query->execute();
            if ($read) return $query;
        } catch (PDOException $th) {
            return false;
        }
    }

    function idCaja()
    {
        try {
            $sql = "SELECT * from caja";
            $query = $this->cnx->prepare($sql);
            $read = $query->execute();
            if ($read) return $query;
        } catch (PDOException $th) {
            return false;
        }
    }

    function idRol()
    {
        try {
            $sql = "SELECT * from rol";
            $query = $this->cnx->prepare($sql);
            $read = $query->execute();
            if ($read) return $query;
        } catch (PDOException $th) {
            return false;
        }
    }

    function editPersonal($id)
    {
        try {
            $sql = "SELECT * FROM personal WHERE id_personal = ?";
            $query = $this->cnx->prepare($sql);
            $query->bindParam(1, $id);
            $read = $query->execute();
            if ($read) return $query;
        } catch (PDOException $th) {
            return false;
        }
    }

    function selectInfoPer()
    {
        try {
            $sql = "SELECT * from personal";
            $query = $this->cnx->prepare($sql);
            $read = $query->execute();
            if ($read) return $query;
        } catch (PDOException $th) {
            return false;
        }
    }

    //---------------- provedor---------------------------------
    function selectProveedor()
    {
        try {
            $sql = "SELECT * from proveedor";
            $query = $this->cnx->prepare($sql);
            $read = $query->execute();
            if ($read) return $query;
        } catch (PDOException $th) {
            return false;
        }
    }

    function editProveedor($id)
    {
        try {
            $sql = "SELECT * FROM proveedor WHERE id_proveedor = ?";
            $query = $this->cnx->prepare($sql);
            $query->bindParam(1, $id);
            $read = $query->execute();
            if ($read) return $query;
        } catch (PDOException $th) {
            return false;
        }
    }
    
    function selectInfo(){
        try {
            $sql = "SELECT * from proveedor";
            $query = $this->cnx->prepare($sql);
            $read = $query->execute();
            if ($read) return $query;
        } catch (PDOException $th) {
            return false;
        }
    }

  }
  ?>