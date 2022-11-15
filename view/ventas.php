<?php
  if($_SESSION['rol'] == 0){
    echo "FUNCIONALIDAD EN DESARROLLO EN ADMINISTRADOR, INICIE SESIÓN CON EL ROL DE VENDEDOR PARA  PROBARLO";
  }
  $id_caja = (isset($_SESSION['user']['id_caja']) ? $_SESSION['user']['id_caja'] : 1); 
  $readIdVenta = $query->readIdVenta(); // Hacer una consulta a tabla negocios
  $readTotalCaja = $query->selectTableId('caja','id_caja',$id_caja,'total'); 
  $totalCaja = $readTotalCaja->fetch();
  // $resNegocio = $readNegocio->fetch(); // Obtener el registro de la consulta
  // $readTipo = $query->readTipo(); // Hacer consulta para leer los tipos de negocios.
  // $readTipoSelected = $query->readFieldSelected($resNegocio['id_tipo'], 'tipo_negocio', 'id_tipo', 'tipo'); // Obtner el tipo de negocio actual


  date_default_timezone_set('America/Mexico_City');
?>
<section class="realizar-venta">
  <section class="add-product px-2 ms-2 mt-2">
    <div class="above__info">
      <h5>Información de venta</h5>
    </div>
    <div class="info__venta">
      <div class="venta__text">
        <div class="text-desc">Venta realizada por:</div>
        <div class="text-desc">Número de transaccion:</div>
        <div class="text-desc">Número de caja:</div>
        <div class="text-desc">Fecha de Venta:</div>
        <div class="text-desc">Total en caja:</div>
      </div>
      <div class="venta__value">
        <div class="text-value"><span id="nameVendedor"><?php echo $_SESSION['user']['nombre']; ?></span></div>
        <div class="text-value"><span id="nTransaccion"><?php echo $readIdVenta; ?></span></div>
        <div class="text-value"><span id="id_caja"><?php echo $id_caja; ?></span></div>
        <div class="text-value"><span id="fVenta"><?php echo date('Y-m-d'); ?></span></div>
        <div class="text-value"><span id="total_caja"><?php echo $totalCaja['total']; ?></span></div>
      </div>
    </div>
    <div class="input__code">
      <form action="" id="formCodeProduct">
        <input type="text" autofocus placeholder="Introduce el nombre o código del producto" id="code-product" class="code-product">
        <div class="btn-buscar-producto">
          <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
        </div>
      </form>
    </div>
    <div class="venta__detalles">
      <div class="venta__total">
        <p class="total__p">Total de venta:<b id="total-pagar"></b></p>
      </div>
      <div class="venta__efectivo">
        <label class="efectivo__p">Efectivo: </label>
        <input type="number" class="efectivo__input" id="efectivo_cliente" placeholder="Introduce la cantidad">
      </div>
      <br>
      <div class="venta__cambio">
        <p class="cambio__p">Cambio: <b id="cambio_cliente"></b></p>
      </div>
      <div class="btns-venta">
        <a href="" id="vender" class="btn-prm btn-venta">Vender</a>
      </div>
    </div>
  </section>
  <section class="table-product px-2">
    <div class="content rounded-3 p-3 table-ventas">
      <table table bgcolor= "#FFFFFF"  class="table table-bordered" id="table-ventas">
        <thead>
          <tr>
            <!-- <th scope="col">CÓDIGO</th> -->
            <th scope="col">PRODUCTO</th>
            <th scope="col">PRECIO</th>
            <th scope="col">UNIDAD</th>
            <th scope="col">CATEGORIA</th>
            <th scope="col">STOCK</th>
            <th scope="col">VENDER</th>
            <th scope="col">SUBTOTAL</th>
          </tr>
        </thead>
        <tbody id="table-body-ventas">
        </tbody>
      </table>
    </div>
  </section>
</section>
<section class="modales"></section>

<script src="../assets/js/ventas.js" type="module"></script>
