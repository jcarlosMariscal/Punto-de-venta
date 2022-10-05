<?php
  include ("../conexion/conexion.php");

  // if($_SESSION['rol'] == 1){
  //   echo "<h6 style='color: red;'>Esta funcionalidad por el momento solo está disponible para el rol de <b>Vendedor</b></h6>";
  //   $caja = "Sin registro";
  //   $total = "0.00";
  // }else if($_SESSION['rol'] == 2){
  //   // echo $_SESSION['id_caja'];
  //   if(!$_SESSION['id_caja']){
  //     echo "<h6 style='color: red;'>La información del vendedor está incompleto, no puede hacer uso de esta funcionalidad</h6>";
  //     $caja = "Sin registro";
  //     $total = "0.00";
  //   }else{
  //     $query = "SELECT * FROM usuarios U JOIN caja C ON U.id_caja = C.id_caja WHERE id_rol = 2";
  //     $resultado = mysqli_query($con, $query);
  //     foreach ($resultado as $row) {
  //       $caja = $row['caja'];
  //       $total = $row['total'];
  //     } 
  //   }
  // }


  $query2 = "SELECT MAX(id_venta) AS id FROM venta_producto";
  $res = mysqli_query($con, $query2);
  $rowcount = mysqli_num_rows($res);
  if($rowcount == NULL) {
    $actual = '1';
  }else{
    foreach ($res as $r) {
      $actual = $r['id'] + 1;
    } 
  }
  date_default_timezone_set('America/Mexico_City');
?>
<section class="content">
  <section class="add-product">
    <h5><div class="above__info">Información de venta</div></h5>
    <div class="card-group">
      <div class="card-body">
        <div class="above__info">Venta realizada por: &nbsp;<b id="nameVendedor"><?php echo $_SESSION['user']['nombre']; ?></b> </div>
        <div class="above__info">No. de transaccion: &nbsp;<b id="nTransaccion"><?php echo $actual; ?></b>  </div>
      </div>
      <div class="card-body">
        <div class="above__info">No. de caja: &nbsp;<b id="nCaja"><?php echo "1"; ?></b> </div>
        <div class="above__info">Fecha Venta:&nbsp;<b id="fVenta"><?php echo date('Y-m-d'); ?></b> </div>
        <!-- <div class="above__info">Fecha Venta:&nbsp;<b><?php //echo date('"Y-m-d H:i:s"'); ?></b> </div> -->
        <!-- <div class="above__info">Fecha Venta:&nbsp;<b><?php //echo date_default_timezone_get(); ?></b> </div> -->
      </div>
      <div class="card-body">
        <div class="above__info">Total en caja: &nbsp;<b id="tCaja"><?php echo "120"; ?></b></div>
      </div>
  </div>
  </section>
  <br>
  <section class="table-ventas">
    <input type="text" autofocus placeholder="Introduce el código del producto" id="code-product" class="code-product">
    <br><br>
    <table table bgcolor= "#FFFFFF"  class="table table-bordered" id="table-ventas">
      <thead>
        <tr>
          <th scope="col">CÓDIGO</th>
          <th scope="col">PRODUCTO</th>
          <th scope="col">PRECIO</th>
          <th scope="col">PROVEEDOR</th>
          <th scope="col">STOCK</th>
        </tr>
      </thead>
      <tbody id="table-body-ventas">
      </tbody>
    </table>
  </section>
  <section class="info_venta">
    <div class="venta__total">
      <p class="total__p">Total: <b>$</b><b id="total-pagar"></b></p>
    </div>
    <div class="venta__efectivo">
      <label class="efectivo__p">Efectivo: </label>
      <input type="text" class="efectivo__input" id="efectivo_cliente" placeholder="Introduce la cantidad">
    </div>
    <div class="venta__cambio">
      <p class="cambio__p">Cambio: <b>$</b><b id="cambio_cliente"></b></p>
    </div>
    <div class="btns-venta">
      <a href="" id="vender" class="btn-prm btn-venta">Vender</a>
    </div>
  </section>
</section>

<script src="../assets/js/ventas.js" type="module"></script>
