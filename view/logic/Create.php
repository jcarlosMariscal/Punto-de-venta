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
        return false;
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
    function buscarProdExistente($nombre){
      try {
        $sql = "SELECT * FROM producto WHERE nombre = ?";
        $query = $this->cnx->prepare($sql);
        $query->bindParam(1, $nombre);
        $query->execute();
        $registros = $query->rowCount();
        foreach($query as $row){
          $cantidad = $row['cantidad'];
          $id_producto = $row['id_producto'];
          return [$registros, $cantidad, $id_producto];
        }
      } catch (PDOException $th){
        echo "error";
      }
    }
    function actualizarCompra($cantidad, $pcompra, $pventa, $nombre){
      try {
        $sql = "UPDATE producto SET cantidad = ?, pcompra = ?, pventa = ? WHERE nombre = ?";
        $query = $this->cnx->prepare($sql);
        $data = array($cantidad,$pcompra,$pventa,$nombre);
        $update = $query -> execute($data);
        if($update) return true;
      } catch (PDOException $th){
        echo "error";
      }
    }
    function realizarCompraNuevo($codigo, $nombre, $cantidad, $pcompra, $pventa, $id_unidad, $id_categoria){
      try {
        $sql = "INSERT INTO producto(codigo, nombre, cantidad, pcompra, pventa, id_unidad, id_categoria) VALUES(?,?,?,?,?,?,?)";
        $query = $this->cnx->prepare($sql);
        $data = array($codigo, $nombre,$cantidad,$pcompra,$pventa,$id_unidad, $id_categoria);
        $insert = $query -> execute($data);
        if($insert) return true;
      } catch (PDOException $th){
        return false;
      }
    }
    function registrarCompraProducto($id_sucursal,  $id_proveedor, $cadenaProductos, $detalles, $totalCompras){
      try {
        $sql = "INSERT INTO compra_producto(id_sucursal, id_proveedor, productos, detalles, total) VALUES(?,?,?,?,?)";
        $query = $this->cnx->prepare($sql);
        $data = array($id_sucursal,$id_proveedor,$cadenaProductos,$detalles,$totalCompras);
        $insert = $query -> execute($data);
        if($insert) return true;
      } catch (PDOException $th){
        return false;
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
    function generarCodigo($codigo, $nombre){
      try {
        $sql = "UPDATE producto SET codigo = ? WHERE nombre = ?";
        $query = $this->cnx->prepare($sql);
        $query->bindParam(1,$codigo); 
        $query->bindParam(2,$nombre); 
        if($query->execute()){
          return true;
        }
      } catch (PDOException $th){
        echo "error";
      }
    }
    function productoExcel($xlsx){
      try {
        $sql = "INSERT INTO producto (codigo, nombre, cantidad, pcompra,pventa,id_unidad) VALUES (?, ?, ?, ?,?,".$_POST['id_unidad'].")";

        $stmt = $this->cnx->prepare($sql);
        $stmt->bindParam(1, $codigo);
        $stmt->bindParam(2, $nombre);
        $stmt->bindParam(3, $cantidad);
        $stmt->bindParam(4, $pcompra);
        $stmt->bindParam(5, $pventa);
        // $stmt->bindParam(6, $id_unidad);

        foreach ($xlsx->rows() as $fields) {
            $codigo = $fields[0];
            $nombre = $fields[1];
            $cantidad = $fields[2];
            $pcompra = $fields[3];
            $pventa = $fields[4];
            // $id_unidad = $fields[5];
            $stmt->execute();
        }
        return true;
      } catch (PDOException $th){
        return false;
      }
    }
  }
  ?>