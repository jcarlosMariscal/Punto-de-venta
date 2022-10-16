<?php
  include('../conexion/conexion.php');
  $sql = "SELECT * FROM proveedor";
  $query = mysqli_query($con, $sql);
  $res = mysqli_fetch_array($query); 
  

?>
<section class="content">
  <div class="px-4">
    <section class="add-product">
      <div class="formularioxd">
        <div class="content rounded-3 p-3">
          <div class="above__info">
            <h5>Realizar una compra</h5>
          </div>
          <form action="" class="form-add-product" id="formulario">
            <div class="input-nom-proveedor input-compra" id="group-nombre_prov">
              <label for="">Proveedor: </label>
              <input type="text" class="input input-cpr" disabled id="nombre_prov" name="nombre_prov" placeholder="Selecciona proveedor">
              <a href="" class="seleccionar" data-bs-toggle="modal" data-bs-target=".seleccionar-prov"><i class="fa-solid fa-check-to-slot"></i></a>
            </div>
            <div class="input-nom-producto input-compra" id="group-producto_prov">
              <label for="">Producto: </label>
              <input type="text" class="input input-cpr" id="producto_prov" name="producto_prov" placeholder="Nombre de producto">
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
            </div>
          </form>
          <div class="modal fade seleccionar-prov" id="seleccionar-prov" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLongTitle">Seleccione un proveedor</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                                <button type="button" class="btn-close-modal" data-bs-dismiss="modal">Cerrar</button>
                                <input type="submit" class="btn-cfg" data-bs-dismiss="modal" value="Seleccionar">
                              </div>
                              <!-- </select> -->
                            </form>
                      </div>
                      <br>
                  </div>
              </div>
            </div>
          </div>
        </div> 
      </div> 
    </section>
  </div>
  <div class="px-4">
    <section class="table-product">
      <div class="content rounded-3 p-3">
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
      </div>
    </section>
  </div>
  <div class="info-compra">
    <div class="compra__total">
      <p class="total">Total a pagar: <b>$</b><b id="total-pagar"></b></p>
    </div>
    <div class="btns-compra">
      <a href="" id="cancelar" class="btn-prm btn-cancelar"><i class="fa-solid fa-ban"></i> Cancelar</a>
      <a href="" id="comprar"class="btn-prm btn-compra"><i class="fa-solid fa-cart-shopping"></i> Comprar</a>
      <!-- <a href="index.php?p=pago" id="compra_online" class="btn-prm btn-compra">Compra Online</a> -->
    </div>
  </div>
</section>

<script src="../assets/js/compras.js" type="module"></script>