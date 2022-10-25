<?php
  class Read{
    public $cnx;
    function __construct(){
      $this -> cnx = Connection::connectDB();
    }
    // -------------------------- Negocio [tipo negocio, ]
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
    // -------------------------- Negocio [tipo negocio, ]

    // --------------- Leer campos seleccionados en formulario [Rol, sucursal, Caja]
    function readFieldSelected($id, $table, $id_table, $field){
      try {
        $sql = "SELECT $id_table,$field from $table WHERE $id_table = ?";
        $query = $this->cnx->prepare($sql);
        $query -> bindParam(1, $id);
        $read = $query->execute();
        if($read) return $query;
      } catch (PDOException $th) {
        return false;
      }
    }
    function readFieldNoSelected($id, $table, $id_table){
      try {
            $sql = "SELECT * from $table WHERE $id_table != ?";
            $query = $this->cnx->prepare($sql);
            $query->bindParam(1, $id);
            $read = $query->execute();
            if ($read) return $query;
          } catch (PDOException $th) {
            return false;
          }
        }
    function readRolesNoSelected($id){
      try {
            $sql = "SELECT * from rol WHERE id_rol != ?";
            $query = $this->cnx->prepare($sql);
            $query->bindParam(1, $id);
            $read = $query->execute();
            if ($read) return $query;
          } catch (PDOException $th) {
            return false;
          }
        }
    // --------------- Leer campos seleccionados en formulario [Rol, sucursal, Caja]

    // --------------- Datos Fiscales Y sucursal
    function buscarDatosFiscales($id_negocio){ // Verificar si los datos fiscales del negocio están registrados
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
    function obtenerDatosFiscales($id_negocio){ // Obtener datos fiscales
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
    function obtenerSucursales(){
      try {
        $sql = "SELECT * FROM sucursal";
        $query = $this->cnx->prepare($sql);
        $insert = $query -> execute();
        if($insert) return $query;
      } catch (PDOException $th) {
        return false;
      }
    }
    // --------------- Datos Fiscales y Sucursal

    // ------------------------personal  
    function selectTable($table){
        try {
            $sql = "SELECT * from $table";
            $query = $this->cnx->prepare($sql);
            $read = $query->execute();
            if ($read) return $query;
        } catch (PDOException $th) {
            return false;
        }
    }
    function selectPersonal(){
        try {
            $sql = "SELECT * from personal";
            $query = $this->cnx->prepare($sql);
            $read = $query->execute();
            if ($read) return $query;
        } catch (PDOException $th) {
            return false;
        }
    }
    function idSucursal(){
        try {
            $sql = "SELECT * from sucursal";
            $query = $this->cnx->prepare($sql);
            $read = $query->execute();
            if ($read) return $query;
        } catch (PDOException $th) {
            return false;
        }
    }
    // ---------------------------------- ROLES
    // ---------------------------------- ROLES

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
       //Productos------------
    function selectProductos()
    {
        try {
            $sql = "SELECT * from producto";
            $query = $this->cnx->prepare($sql);
            $read = $query->execute();
            if ($read) return $query;
        } catch (PDOException $th) {
            return false;
        }
    }
        function editProducto($id)
    {
        try {
            $sql = "SELECT * FROM producto WHERE id_producto = ?";
            $query = $this->cnx->prepare($sql);
            $query->bindParam(1, $id);
            $read = $query->execute();
            if ($read) return $query;
        } catch (PDOException $th) {
            return false;
        }
    }
        function idUnidad(){
        try {
            $sql = "SELECT * from unidad";
            $query = $this->cnx->prepare($sql);
            $read = $query->execute();
            if ($read) return $query;
        } catch (PDOException $th) {
            return false;
        }
    }




  }
  ?>