<section class="above">
    <div class="above__info">
      <span class="info__seccion">Compras</span>
      <a href="index.php?p=ver-compras" class="btn-prm btn-above">Mis Ventas</a>
      &nbsp; &nbsp;
      <a href="index.php?p=ver-compras" class="btn-prm btn-above">Mi Reporte</a>
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
      <div class="above__info">Venta realizada por: &nbsp;<b>Carlos Mariscal</b> </div>
      <div class="above__info">No. de transaccion: &nbsp;<b>1252</b>  </div>
    </div>
    <div class="card-body">
      <div class="above__info">No. de caja: &nbsp;<b>10</b> </div>
      <div class="above__info">Fecha Venta:&nbsp;<b>20-07-2022</b> </div>
    </div>
    <div class="card-body">
      <div class="above__info">Total en caja: &nbsp;<b>6300.20</b></div>
    </div>
</div>
</section>
<br>
<section class="table-product">
  <table table bgcolor= "#FFFFFF"  class="table table-bordered">
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
      <tr id = "product-1">
        <th scope="row"><input type="text" placeholder="Introduce..." id="code-product-1"></th>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
      <!-- Agregar productos dinámicamente -->
    </tbody>
  </table>
</section>
<section class="info-compra">
  <div class="compra__total">
    <p class="total">Total de venta: <b>$</b><b id="total-pagar"></b></p>
  </div>
  <div class="compra__total">
    <p class="total">Efectivo cliente: <input type="text"></p>
  </div>
  <div class="compra__total">
    <p class="total">Cambio de cliente: <b>$</b><b id="total-pagar"></b></p>
  </div>
  <div class="btns-compra">
    <!-- <a href="" id="cancelar" class="btn-prm btn-cancelar">Cancelar</a> -->
    <a href="" id="comprar"class="btn-prm btn-compra">Imprimir Ticket</a>
    <a href="index.php?p=pago" id="compra_online" class="btn-prm btn-compra">Realizar venta</a>
  </div>
</section>

<script src="../assets/js/ventas.js" type="module"></script>
