<?php
  require ("../config/Connection.php");
  class Create{
    public $cnx;
    function __construct(){
      $this -> cnx = Connection::connectDB();
    }
    function registrarNegocio($nombre, $telefono, $correo, $imagen, $id_tipo){
      try {
        $sql = "INSERT INTO negocio(nombre, telefono, correo, logo, id_tipo) VALUES (?,?,?,?,?)";
        $query = $this->cnx->prepare($sql);
        $data = array($nombre,$telefono,$correo, $imagen, $id_tipo);
        $insert = $query -> execute($data);
        $lastId = $this->cnx->lastInsertId();
        
        if($insert) return [true, $lastId];
      } catch (PDOException $th) {
        return [false, 0];
      }
    }
    function registrarDF($nombre, $rfc, $regimen, $id_negocio){
      try {
        $sql = "INSERT INTO datos_fiscales(nombre, rfc, rFiscal, id_negocio) VALUES (?,?,?,?)";
        $query = $this->cnx->prepare($sql);
        $data = array($nombre,$rfc,$regimen,$id_negocio);
        $insert = $query -> execute($data);
        if($insert) return true;
      } catch (PDOException $th) {
        return false;
      }
    }
    function registrarSucursal($nombre,$estado, $ciudad, $colonia, $direccion, $codigo_postal, $telefono, $correo, $id_negocio){
      try {
        $sql = "INSERT INTO sucursal(nombre, estado, ciudad, colonia, direccion, codigo_postal, telefono, correo, id_negocio) VALUES (?,?,?,?,?,?,?,?,?)";
        $query = $this->cnx->prepare($sql);
        $data = array($nombre,$estado,$ciudad,$colonia,$direccion, $codigo_postal, $telefono, $correo, $id_negocio);
        $insert = $query -> execute($data);
        if($insert) return true;
      } catch (PDOException $th) {
        return false;
      }
    }
    function registrarAdmin($nombre, $pass, $correo, $telefono, $id_negocio){
      try {
        $sql = "INSERT INTO administrador(nombre, pass, correo, telefono, id_negocio) VALUES (?,?,?,?,?)";
        $query = $this->cnx->prepare($sql);
        $encrypt = password_hash($pass, PASSWORD_BCRYPT);
        $data = array($nombre,$encrypt,$correo,$telefono, $id_negocio);
        $insert = $query -> execute($data);
        if($insert) return true;
      } catch (PDOException $th) {
        return false;
      }
    }
    function validateNameUser($nombre, $table, $field){ // MÉTODO QUE VALIDA SI EL NOMBRE DE USUARIO ESTÁ REPETIDO
      try {
        $sql = "SELECT * FROM $table WHERE $field = ? "; // Hacer la consulta. NO MANDAR LOS VALORES DIRECTAMENTE
        $query = $this->cnx->prepare($sql); // Preparamos la consulta
        $query -> bindParam(1,$nombre); // Mandamos el valor de manera segura (Uno solo)
        if($query->execute()){
          // echo "success";
          return $query->rowCount();
        }
      } catch (PDOException $th) {
        return 0;
      }
    }
    function registrarProveedor($nombre,$telefono,$correo,$contacto,$cargo){
      try{
        $sql = "INSERT INTO proveedor(nombre,telefono,correo,contacto,cargo) VALUES(?,?,?,?,?)"; //Insertamos el registro
        $query = $this->cnx->prepare($sql); // Preparar la consulta
        $data = array($nombre,$telefono,$correo,$contacto,$cargo); // Mandar los valores de manera segura en forma de arreglo (Varios)
        $insert = $query -> execute($data);//ejecutamos la consulta
        if($insert) return true;
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
    function registrarPersonal($nombre,$pass,$correo,$telefono,$ciudad,$domicilio,$id_sucursal,$id_caja,$id_rol){
      try{
          $sql = "INSERT INTO personal(nombre,pass,correo,telefono,ciudad,domicilio,id_sucursal,id_caja,id_rol) VALUES(?,?,?,?,?,?,?,?,?)"; //Insertamos el registro
          $query = $this->cnx->prepare($sql); // Preparar la consulta
          $encrypt = password_hash($pass, PASSWORD_BCRYPT); // Encriptar la contraseña
          $data = array($nombre,$encrypt,$correo,$telefono,$ciudad,$domicilio,$id_sucursal,$id_caja,$id_rol);
          $insert = $query -> execute($data);//ejecutamos la consulta
          if($insert) return true;
      }catch (PDOException $th){
        return false;
      }

    }
    function getNegocio($id_sucursal){
      try {
        $sql = "SELECT * FROM sucursal WHERE id_sucursal = ?";
        $query = $this->cnx->prepare($sql);
        $query -> bindParam(1, $id_sucursal);
        $query -> execute();
        $sucursal = $query;
        foreach($sucursal as $row){
          $nombre = $row['nombre'];
          $estado = $row['estado'];
          $ciudad = $row['ciudad'];
          $colonia = $row['colonia'];
          $direccion = $row['direccion'];
          $codigo_postal = $row['codigo_postal'];
          $telefono = $row['telefono'];
        }
        $json = '{"nombre":"'.$nombre.'","estado":"'.$estado.'","ciudad":"'.$ciudad.'","colonia":"'.$colonia.'","direccion":"'.$direccion.'","codigo_postal":"'.$codigo_postal.'","telefono":"'.$telefono.'"}';
        return [true, $json];
      } catch (PDOException $th){
        echo "error";
      }
    }
    function buscarProducto($codigo){
      try {
        $sql = "SELECT * FROM productos WHERE codigo = ?";
        $query = $this->cnx->prepare($sql);
        $query->bindParam(1, $codigo);
        $query -> execute();
        if($query->rowCount() > 0){
          foreach ($query as $row) {
            $codigo = $row['codigo'];
            $producto = $row['producto'];
            $pventa = $row['pventa'];
            $id_proveedor = $row['id_proveedor'];
            $cantidad = $row['cantidad'];
          } 
          $json = '{"codigo":"'.$codigo.'","producto":"'.$producto.'","pventa":"'.$pventa.'","id_proveedor":"'.$id_proveedor.'", "cantidad":"'.$cantidad.'"}';
          return [true, $json];
        }else{
          return [false, 'noEncontrado'];
        }
      } catch (PDOException $th){
        echo "error";
      }
    }
    function buscarIdProv($proveedor){
      try {
        $sql = "SELECT id FROM proveedor WHERE nombre = ?";
        $query = $this->cnx->prepare($sql);
        $query->bindParam(1, $proveedor);
        $query->execute();
        foreach($query as $row){
          return $row['id'];
        }
      } catch (PDOException $th){
        echo "error";
      }
    }
    function buscarIdProd($producto){
      try {
        $sql = "SELECT id FROM productos WHERE codigo = ?";
        $query = $this->cnx->prepare($sql);
        $query->bindParam(1, $producto);
        $query->execute();
        foreach($query as $row){
          return $row['id'];
        }
      } catch (PDOException $th){
        echo "error";
      }
    }
    function buscarProdExistente($producto){
      try {
        $sql = "SELECT * FROM productos WHERE producto = ?";
        $query = $this->cnx->prepare($sql);
        $query->bindParam(1, $producto);
        $query->execute();
        $registros = $query->rowCount();
        foreach($query as $row){
          $cantidad = $row['cantidad'];
          return [$registros, $cantidad];
        }
      } catch (PDOException $th){
        echo "error";
      }
    }
    function actualizarCompra($cantidad, $p_compra, $p_venta, $producto){
      try {
        $sql = "UPDATE productos SET cantidad = ?, pcompra = ?, pventa = ? WHERE producto = ?";
        $query = $this->cnx->prepare($sql);
        $data = array($cantidad,$p_compra,$p_venta,$producto);
        $update = $query -> execute($data);
        if($update) return true;
      } catch (PDOException $th){
        echo "error";
      }
    }
    function realizarCompra($producto, $cantidad, $p_compra, $p_venta, $id_proveedor){
      try {
        $sql = "INSERT INTO productos(producto, cantidad, pcompra, pventa, id_proveedor) VALUES(?,?,?,?,?)";
        $query = $this->cnx->prepare($sql);
        $data = array($producto,$cantidad,$p_compra,$p_venta,$id_proveedor);
        $insert = $query -> execute($data);
        if($insert) return true;
      } catch (PDOException $th){
        echo "error";
      }
    }
    function realizarVenta($id_producto, $usuario, $cantidad){
      try {
        $sql = "INSERT INTO ventas (id_producto, id_user, cantidad) VALUES(?,?,?)";
        $query = $this->cnx->prepare($sql);
        $data = array($id_producto,$usuario,$cantidad);
        $insert = $query -> execute($data);
        if($insert) return true;
      } catch (PDOException $th){
        echo "error";
      }
    }
    function obtenerCantidadBase($producto){
      try {
        $sql = "SELECT cantidad FROM productos WHERE codigo = ?";
        $query = $this->cnx->prepare($sql);
        $query->bindParam(1,$producto);
        $query->execute(); 
        if($query->rowCount() > 0){
          foreach($query as $row){
            return $row['cantidad'];
          }
        }
      } catch (PDOException $th){
        echo "error";
      }
    }
    function reducirCantidad($actual, $producto){
      try {
        $sql = "UPDATE productos SET cantidad = ? WHERE codigo = ?";
        $query = $this->cnx->prepare($sql);
        $query->bindParam(1,$actual); 
        $query->bindParam(2,$producto); 
        if($query->execute()){
          return true;
        }
      } catch (PDOException $th){
        echo "error";
      }
    }
    function generarCodigo($codigo, $producto){
      try {
        $sql = "UPDATE productos SET codigo = ? WHERE producto = ?";
        $query = $this->cnx->prepare($sql);
        $query->bindParam(1,$codigo); 
        $query->bindParam(2,$producto); 
        if($query->execute()){
          return true;
        }
      } catch (PDOException $th){
        echo "error";
      }
    }
  }
  ?>