<?php
  include ("../conexion/conexion.php");

  $query = "SELECT * FROM usuarios U JOIN caja C ON U.id_caja = C.id_caja WHERE id_rol = 2";
  $resultado = mysqli_query($con, $query);
  foreach ($resultado as $row) {
    $caja = $row['caja'];
    $total = $row['total'];
  } 

  $query2 = "SELECT MAX(id_venta) AS id FROM ventas";
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


<section class="above">
    <div class="above__info">
      <span class="info__seccion">Ventas</span>
      <a href="index.php?p=ver-compras" class="btn-prm btn-above deshabilitar">Mis Ventas</a>
      &nbsp; &nbsp;
      <a href="index.php?p=ver-compras" class="btn-prm btn-above deshabilitar">Mi Reporte</a>
      <!-- <a href="index.php?p=compras" class="btn-regresar"><i class="fa-solid fa-eye"></i></a> -->
    </div>
    <div class="above__user">
    <div class="user__info">
            <p class="user__name"><?php echo $_SESSION['user']?></p>
            <p class="user__rol">
                <?php 
                    if($_SESSION['rol'] == 1){
                        echo "Administrador";
                    }elseif ($_SESSION['rol'] == 2) {
                        echo "Vendedor";
                    }
                ?>
            </p>
        </div>
        <div class="user__icon">
            <span class="icon-user"><i class="icon-font fa-solid fa-user"></i></span>
        </div>
    </div>
</section>
<hr>
<section class="add-product">
  <h5><div class="above__info">Información de venta</div></h5>
  <div class="card-group">
    <div class="card-body">
      <div class="above__info">Venta realizada por: &nbsp;<b><?php echo $_SESSION['user']?></b> </div>
      <div class="above__info">No. de transaccion: &nbsp;<b><?php echo $actual; ?></b>  </div>
    </div>
    <div class="card-body">
      <div class="above__info">No. de caja: &nbsp;<b><?php echo $caja; ?></b> </div>
      <div class="above__info">Fecha Venta:&nbsp;<b><?php echo date('"Y-m-d"'); ?></b> </div>
      <!-- <div class="above__info">Fecha Venta:&nbsp;<b><?php //echo date('"Y-m-d H:i:s"'); ?></b> </div> -->
      <!-- <div class="above__info">Fecha Venta:&nbsp;<b><?php //echo date_default_timezone_get(); ?></b> </div> -->
    </div>
    <div class="card-body">
      <div class="above__info">Total en caja: &nbsp;<b><?php echo $total; ?></b></div>
    </div>
</div>
</section>
<br>
<section class="table-ventas">
  <input type="text" autofocus placeholder="Introduce o escanea el código del producto" id="code-product">
  <br><br>
  <table table bgcolor= "#FFFFFF"  class="table table-bordered" id="table-ventas">
    <thead>
      <tr>
        <th scope="col">ID. PRODUCTO</th>
        <th scope="col">NOMBRE</th>
        <th scope="col">CATEGORIA</th>
        <th scope="col">PRECIO</th>
        <th scope="col">STOCK</th>
      </tr>
    </thead>
    <tbody id="table-body-ventas">
    </tbody>
  </table>
</section>
<section class="info_venta">
  <div class="venta__total">
    <p class="total__p">Total de venta: <b>$</b><b id="total-pagar"></b></p>
    <p></p>
  </div>
  <div class="venta__efectivo">
    <label class="efectivo__p">Efectivo cliente: </label>
    <input type="text" class="efectivo__input" id="efectivo_cliente" placeholder="Introduce la cantidad">
  </div>
  <div class="venta__cambio">
    <p class="cambio__p">Cambio de cliente: <b>$</b><b id="cambio_cliente"></b></p>
  </div>
  <div class="btns-compra">
    <!-- <a href="" id="cancelar" class="btn-prm btn-cancelar">Cancelar</a> -->
    <!-- <a href="" id="comprar"class="btn-prm btn-compra">Imprimir Ticket</a> -->
    <a href="" id="vender" class="btn-prm btn-compra">Vender</a>
  </div>
</section>

<script src="../assets/js/ventas.js" type="module"></script>
