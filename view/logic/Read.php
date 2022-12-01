<?php
  class Read{
    public $cnx;
    function __construct(){
      $this -> cnx = Connection::connectDB();
    }
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
    // El primer parametro es la tabla para hacer la consulta, el segundo el campo que vamos a condicionar, el tercer el valor que vamos a comparar y el último el campo que vamos a seleccionar.
    function selectTableId($table, $campo, $valor, $select){
      try {
        $sql = "SELECT $select from $table WHERE $campo = ?";
        $query = $this->cnx->prepare($sql);
        $query->bindParam(1, $valor);
        $read = $query->execute();
        if ($read) return $query;
      } catch (PDOException $th) {
        return false;
      }
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
    function getCompras($filtro, $campo){
      try {
        if($filtro == "todo"){
          $sql = "SELECT id_compra, total, fecha FROM compra_producto";
          $query = $this->cnx->prepare($sql);
        }
        if($campo == "proveedor"){
          $sql = "SELECT id_compra, total, fecha FROM compra_producto WHERE id_proveedor LIKE '%$filtro%' ";
          $query = $this->cnx->prepare($sql);
        }
        if($campo == "producto"){
          $sql = "SELECT id_compra, total, fecha FROM compra_producto WHERE productos LIKE '%$filtro%' ";
          $query = $this->cnx->prepare($sql);
        }
        if($campo == "fecha"){
          $sql = "SELECT id_compra, total, fecha FROM compra_producto WHERE fecha LIKE '%$filtro%' ";
          $query = $this->cnx->prepare($sql);
        }
        $query -> execute();
        $compraProducto = $query;
        $arr = [];
        foreach($compraProducto as $row){
          $id_compra = $row['id_compra'];
          $total = $row['total'];
          $fecha = $row['fecha'];
          $json = '{"id_compra":"'.$id_compra.'","total":"'.$total.'","fecha":"'.$fecha.'"}';
          array_push($arr, $json);
        }
        $cadenaArr = implode('-/', $arr);
        return [true, $cadenaArr];
      } catch (PDOException $th){
        echo "No hay resultados";
      }
    }
    function getVentas($filtro, $campo){
      try {
        if($filtro == "todo"){
          $sql = "SELECT id_venta, total, fecha FROM venta_producto";
          $query = $this->cnx->prepare($sql);
        }
        if($campo == "sucursal"){
          $sql = "SELECT id_venta, total, fecha FROM venta_producto WHERE id_sucursal LIKE '%$filtro%' ";
          $query = $this->cnx->prepare($sql);
        }
        if($campo == "producto"){
          $sql = "SELECT id_venta, total, fecha FROM venta_producto WHERE id_producto LIKE '%$filtro%' ";
          $query = $this->cnx->prepare($sql);
        }
        if($campo == "personal"){
          $sql = "SELECT id_venta, total, fecha FROM venta_producto WHERE id_personal LIKE '%$filtro%' ";
          $query = $this->cnx->prepare($sql);
        }
        if($campo == "fecha"){
          $sql = "SELECT id_venta, total, fecha FROM venta_producto WHERE fecha LIKE '%$filtro%' ";
          $query = $this->cnx->prepare($sql);
        }
        $query -> execute();
        $ventaProducto = $query;
        $arr = [];
        foreach($ventaProducto as $row){
          $id_venta = $row['id_venta'];
          $total = $row['total'];
          $fecha = $row['fecha'];
          $json = '{"id_venta":"'.$id_venta.'","total":"'.$total.'","fecha":"'.$fecha.'"}';
          array_push($arr, $json);
        }
        $cadenaArr = implode('-/', $arr);
        return [true, $cadenaArr];
      } catch (PDOException $th){
        echo "No hay resultados";
      }
    }
    function getCompraProducto($id_compra){
      try {
        $sql = "SELECT * FROM compra_producto WHERE id_compra = ?";
        $query = $this->cnx->prepare($sql);
        $query -> bindParam(1, $id_compra);
        $query -> execute();
        $compraProducto = $query;
        foreach($compraProducto as $row){
          $id_compra = $row['id_compra'];
          $id_sucursal = $row['id_sucursal'];
          $id_proveedor = $row['id_proveedor'];
          $productos = $row['productos'];
          $detalles = $row['detalles'];
          $total = $row['total'];
          $fecha = $row['fecha'];
        }
        $json = '{"id_compra":"'.$id_compra.'","id_sucursal":"'.$id_sucursal.'","id_proveedor":"'.$id_proveedor.'","productos":"'.$productos.'","total":"'.$total.'","fecha":"'.$fecha.'"}';
        $json2 = $detalles;
        return [true, $json, $json2];
      } catch (PDOException $th){
        echo "error";
      }
    }
    function getVentaProducto($id_venta){
      try {
        $sql = "SELECT * FROM venta_producto WHERE id_venta = ?";
        $query = $this->cnx->prepare($sql);
        $query -> bindParam(1, $id_venta);
        $query -> execute();
        $ventaProducto = $query;
        foreach($ventaProducto as $row){
          $id_venta = $row['id_venta'];
          $id_sucursal = $row['id_sucursal'];
          $id_personal = $row['id_personal'];
          $productos = $row['id_producto'];
          $cliente = $row['id_cliente'];
          $total = $row['total'];
          $efectivo = $row['efectivo'];
          $cambio = $row['cambio'];
          $detalles = $row['detalles'];
          $fecha = $row['fecha'];
          $getSucursal = $this->selectTableId("sucursal","id_sucursal", $id_sucursal, "nombre");
          $getPersonal = $this->selectTableId("personal","id_personal", $id_personal, "nombre");
          $getCliente = $this->selectTableId("cliente","id_cliente", $cliente, "nombre");
          $sucNombre = $getSucursal->fetch()['nombre'];
          $perNombre = $getPersonal->fetch()['nombre'];
          $cliNombre = $getCliente->fetch()['nombre'];
        }
        $json = '{"id_venta":"'.$id_venta.'","sucursal":"'.$sucNombre.'","personal":"'.$perNombre.'","productos":"'.$productos.'","cliente":"'.$cliNombre.'","total":"'.$total.'","efectivo":"'.$efectivo.'","cambio":"'.$cambio.'","fecha":"'.$fecha.'"}';
        $json2 = $detalles;
        return [true, $json, $json2];
      } catch (PDOException $th){
        echo "error";
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
    function buscarProducto($valor){
      try {
        $sql = "SELECT * FROM producto WHERE codigo = ? OR nombre LIKE '%$valor%'";
        $query = $this->cnx->prepare($sql);
        $query->bindParam(1, $valor);
        $query -> execute();
        if($query->rowCount() > 0){
          foreach ($query as $row) {
            $codigo = $row['codigo'];
            $nombre = $row['nombre'];
            $cantidad = $row['cantidad'];
            $pcompra = $row['pcompra'];
            $pventa = $row['pventa'];
            $unidad = $row['id_unidad'];
            $categoria = $row['id_categoria'];
            // $id_proveedor = $row['id_proveedor'];
          } 
          $json = '{"codigo":"'.$codigo.'","nombre":"'.$nombre.'","cantidad":"'.$cantidad.'","pcompra":"'.$pcompra.'", "pventa":"'.$pventa.'","unidad":"'.$unidad.'","categoria":"'.$categoria.'"}';
          return [true, $json];
        }else{
          return [false, 'noEncontrado'];
        }
      } catch (PDOException $th){
        echo "error";
      }
    }
    function readIdVenta(){
      try {
        $sql = "SELECT MAX(id_venta) AS id FROM venta_producto";
        $query = $this->cnx->prepare($sql);
        $read = $query->execute();
        $rowcount = $query->rowCount();
        $res = $query->fetch();
        if($rowcount == NULL) {
          return '1';
        }else{
          return  $res['id'] + 1;
        }
      } catch (PDOException $th){
        echo "error";
      }
    }
  function compraProducto(){
    try {
        $sql = "SELECT * from compra_producto";
        $query = $this->cnx->prepare($sql);
        $query->execute();
        $compraProducto = $query;
        $cproductos = [];
        foreach($compraProducto as $row){
          $id_compra = $row['id_compra'];
          $productos = $row['productos'];
          $total = $row['total'];
          $fecha = $row['fecha'];
          $json = '{"productos":"'.$productos.'","total":"'.$total.'","fecha":"'.$fecha.'","id_compra":"'.$id_compra.'"}';
          array_push($cproductos, $json);
        }   
        $compraPro = implode(', ', $cproductos); 
        $json1 = '"compras":['.$compraPro.']';
        return $json1;
      } catch (PDOException $th) {
        return false;
    }
  }
  function personalVentas(){
    try {
        $sql = "SELECT * from personal";
        $query = $this->cnx->prepare($sql);
        $query->execute();
        $ventas = $query;
        $pVentas = [];
        foreach($ventas as $row){
          $nombre = $row['nombre'];
          $telefono = $row['telefono'];
          $json = '{"nombre":"'.$nombre.'","telefono":"'.$telefono.'"}';
          array_push($pVentas, $json);
        }
        $personalVentas = implode(', ', $pVentas); 
        $json1 = '"ventas":['.$personalVentas.']';
        return $json1;
    } catch (PDOException $th) {
        return false;
    }
  }
  // MOSTRAR GRAFICAS ///////

    function productosMax(){
      try {
        $sql = "SELECT * FROM compra_producto ORDER BY total DESC";
        $query = $this->cnx->prepare($sql);
        $query -> execute();
        $productos = $query;
        $arreglo = [];
        foreach($productos as $row){
          $productos = $row['productos'];
          $total = $row['total'];
          $json = '{"productos":"'.$productos.'","total":"'.$total.'"}';
          array_push($arreglo, $json);
        }
        $cadenaArr = implode(', ', $arreglo);
        $json1 = '"compra_producto":['.$cadenaArr.']';//Creamos el JSON de compra_producto, para despues unirlo
        $pventas = $this->personalNum();//Mandamo a llamar a los metodos        
        $grafProveedor = $this->proveedorNum();        
        $unir = $json1.','.$pventas.','.$grafProveedor;//Aquí unimos los diferentes JSON creados anteriormente
        $jsonValido = '{'.$unir.'}';//Los convertimos en un solo JSON valido, para despues interactuar con ellos

        return $jsonValido;
      } catch (PDOException $th){
        echo "error";
    }
  }
  function personalNum(){
    try {
        $sql = "SELECT * from personal";
        $query = $this->cnx->prepare($sql);
        $query->execute();
        $ventas = $query;
        $pVentas = [];
        foreach($ventas as $row){
          $id_personal = $row['id_personal'];
          $nombre = $row['nombre'];
          $json = '{"id_personal":"'.$id_personal.'","nombre":"'.$nombre.'"}';
          array_push($pVentas, $json);
        }
        $personalVentas = implode(', ', $pVentas); 
        $json1 = '"personal":['.$personalVentas.']';//Creamos el JSON de personal, para despues unirlo
        return $json1;
    } catch (PDOException $th) {
        return false;
    }
  }
  function proveedorNum(){
    try {
        $sql = "SELECT * from proveedor";
        $query = $this->cnx->prepare($sql);
        $query->execute();
        $proveedor = $query;
        $numProv = [];
        foreach($proveedor as $row){
          $id_proveedor = $row['id_proveedor'];
          $nombre = $row['nombre'];
          $json = '{"id_proveedor":"'.$id_proveedor.'","nombre":"'.$nombre.'"}';
          array_push($numProv, $json);
        }
        $proveGraf = implode(', ', $numProv); 
        $json1 = '"proveedor":['.$proveGraf.']';//Creamos el JSON de proveedor, para despues unirlo
        return $json1;
    } catch (PDOException $th) {
        return false;
    }
  }
  // grafica para mostrar las fechas
  function graficaFechas() {
      try {
      $fecha1 = (!empty($_POST['fecha1'])?$_POST['fecha1']:"");
      $fecha2 = (!empty($_POST['fecha2'])?$_POST['fecha2']:"");          
        $sql = "SELECT * FROM venta_producto WHERE fecha BETWEEN '$fecha1' AND '$fecha2' ORDER BY fecha ASC";
        $query = $this->cnx->prepare($sql);
        $read = $query->execute();        
        if ($read) return $query;
      } catch (PDOException $th) {
        return false;
      }
  }




  }
  ?>