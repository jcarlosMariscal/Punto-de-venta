<?php
  include('../conexion/conexion.php');
  $sql = "SELECT * FROM proveedor";
  $query = mysqli_query($con, $sql);
  $res = mysqli_fetch_array($query); 
  

?>

<section class="above">
    <div class="above__info">
      <span class="info__seccion">Compras</span>
      <a href="index.php?p=ver-compras" class="btn-prm btn-above deshabilitar"><i class="fa-solid fa-eye"></i> Ver</a>
      &nbsp;
      &nbsp;
      <?php
        if($res == 0){
          ?><h6 style="color:red;">Agregue proveedores para registrar la compra de productos</h6><?php
        }
      ?>
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
    <h5><div class="above__info">Realizar una compra</div></h5>
    <form action="" class="form-add-product" id="formulario">
        <div class="input-nom-proveedor input-compra" id="group-nombre_prov">
            <label for="">Proveedor: </label>
            <input type="text" class="input input-cpr" disabled id="nombre_prov" name="nombre_prov" placeholder="Selecciona proveedor">
            <a href="" class="seleccionar" data-toggle="modal" data-target=".seleccionar-prov"><i class="fa-solid fa-check-to-slot"></i></a>
        </div>
        <div class="input-nom-producto input-compra" id="group-producto_prov">
            <label for="">Producto: </label>
            <input type="text" class="input input-cpr" id="producto_prov" name="producto_prov" placeholder="Nombre de producto">
            <!-- <a href="" class="seleccionar"><i class="fa-solid fa-check-to-slot"></i></a> -->
        </div>
        <div class="input-cantidad input-compra" id="group-cantidad_prov">
            <label for="">Cantidad: </label>
            <input type="number" class="input input-cpr" id="cantidad_prov" name="cantidad_prov">
        </div>
        <div class="input-precio-compra input-compra" id="group-pcompra_prov">
            <label for="">P. Compra: </label>
            <input type="number" class="input input-cpr" id="pcompra_prov" name="pcompra_prov">
        </div>
        <div class="input-precio-venta input-compra" id="group-pventa_prov">
            <label for="">P. Venta: </label>
            <input type="number" class="input input-cpr" id="pventa_prov" name="pventa_prov">
        </div>
        <div class="input-compra-submit">
            <input type="submit" class="btn-prm btn-compra" value="Agregar Producto" id="btn-send">
            <!-- <svg xmlns="http://www.w3.org/2000/svg" class="input-icon" viewBox="0 0 20 20" fill="currentColor">
              <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
            </svg> -->
        </div>
    </form>
</section>
<div class="modal fade seleccionar-prov" id="seleccionar-prov" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Seleccione un proveedor</h5>
            <span data-dismiss="modal" aria-label="Close" class="close"><i class="fa-solid fa-xmark"></i></span>
        </div>
        <div class="modal-body">
            <div class="permisos">
                <form class="form-user" id="form-select-prov">
                    <?php
                    foreach ($query as $row) {
                      ?>
                      <label><input type="radio" name="proveedor" id="cbox1" value="<?php echo $row['nombre']; ?>"> <?php echo $row['nombre']; ?></label><br>
                      <?php
                    }
                    ?>
                    <div class="input-submit modal-footer">
                      <button type="button" class="btn-close-modal" data-dismiss="modal">Cerrar</button>
                      <input type="submit" class="btn-cfg" value="Seleccionar" id="">
                    </div>
                    <!-- </select> -->
                  </form>
            </div>
            <br>
        </div>
    </div>
  </div>
</div>
<section class="table-product">
  <table table bgcolor= "#FFFFFF"  class="table table-bordered">
    <thead>
      <tr>
        <th scope="col">PRODUCTO</th>
        <th scope="col">CANTIDAD</th>
        <th scope="col">P. COMPRA</th>
        <th scope="col">SUB TOTAL</th>
      </tr>
    </thead>
    <tbody id="table-body">
      <!-- Agregar productos dinámicamente -->
    </tbody>
  </table>
</section>
<div class="info-compra">
  <div class="compra__total">
    <p class="total">Total a pagar: <b>$</b><b id="total-pagar"></b></p>
  </div>
  <div class="btns-compra">
    <a href="" id="cancelar" class="btn-prm btn-cancelar">Cancelar</a>
    <a href="" id="comprar"class="btn-prm btn-compra">Comprar</a>
    <a href="index.php?p=pago" id="compra_online" class="btn-prm btn-compra">Compra Online</a>
  </div>
</div>

<script src="../assets/js/compras.js" type="module"></script>