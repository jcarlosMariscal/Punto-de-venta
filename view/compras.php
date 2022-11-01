<?php
  require_once "config/Connection.php";
  require_once "logic/Read.php";
  $query = new Read();

  $readProveedor = $query->selectTable('proveedor'); // Hacer una consulta a tabla negocios
  // $resProveedor = $readProveedor->fetch(); // Obtener el registro de la consulta
  $readProducto = $query->selectTable('producto'); // Hacer una consulta a tabla negocios
  $readUnidad = $query->selectTable('unidad'); // Hacer una consulta a tabla negocios
?>
<section class="realizar-compra">
  <div id="alertProduct"></div>
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
              <input type="text" class="input btn-selectProv" disabled id="nombre_prov" name="nombre_prov" placeholder="Seleccionar" data-bs-toggle="modal" data-bs-target=".seleccionar-prov">
            </div>
            <div class="input-nom-producto input-compra" id="group-producto_prod">
              <label for="">Producto: </label>
              <input type="text" class="input input-cpr" id="nombre_prod" name="nombre_prod" placeholder="Nombre de producto">
              <a href="" class="seleccionar" data-bs-toggle="modal" data-bs-target=".seleccionar-prod"><i class="fa-solid fa-magnifying-glass"></i></a>
            </div>
            <div hidden id="db_get_product">
              <input type="hidden" id="db_get_code" name="db_get_code">
              <input type="hidden" id="db_get_name" name="db_get_name">
            </div>
            <div class="input-cantidad input-compra" id="group-cantidad_prov">
              <label for="">Unidad: </label>
              <select name="unidad_prod" id="unidad_prod">
                <option selected disabled>Seleccione una unidad</option>
              <?php
                if($readUnidad){
                  foreach ($readUnidad as $row) {
                    ?><option value="<?php echo $row['id_unidad']; ?>"><?php echo $row['unidad']; ?></option><?php
                  }
                }
              ?>
              </select>
              <!-- <a href="" class="seleccionar" data-bs-toggle="modal" data-bs-target=".seleccionar-prov"><i class="fa-solid fa-circle-plus"></i></a> -->
            </div>
            <div class="input-cantidad input-compra" id="group-cantidad_prod">
              <label for="">Cantidad: </label>
              <input type="number" class="input input-cpr" id="cantidad_prod" name="cantidad_prod" placeholder="Cantidad a comprar">
            </div>
            <div class="input-precio-compra input-compra" id="group-pcompra_prod">
              <label for="">P. Compra: </label>
              <input type="number" class="input input-cpr" id="pcompra_prod" name="pcompra_prod" placeholder="Precio por unidad">
            </div>
            <div class="input-precio-venta input-compra" id="group-pventa_prod">
              <label for="">P. Venta: </label>
              <input type="number" class="input input-cpr" id="pventa_prod" name="pventa_prod" placeholder="Precio por unidad">
            </div>
            <div class="input-compra-submit">
              <input type="submit" class="btn-prm btn-compra" value="Agregar Producto" id="btn-compraProducto">
            </div>
          </form>
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
              <th scope="col">CÓDIGO</th>
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
<section class="modales">
  <div class="modal fade seleccionar-prov" id="seleccionar-prov" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Seleccionar proveedor</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="permisos">
            <a href="" class="btn-prm btn-cancelar" data-bs-toggle="modal" data-bs-target=".agregarProveedor" data-bs-dismiss="modal" aria-label="Close"><i class="fa-solid fa-plus fa-lg"></i> Agregar</a> 
            <br>
            <br>
            <form class="form-select-prov" id="form-select-prov">
              <?php
                foreach ($readProveedor as $row) {
              ?>
                <label class="rad-label">
                  <input type="radio" class="rad-input" name="proveedor" value="<?php echo $row['nombre']; ?>">
                  <div class="rad-design"></div>
                  <div class="rad-text"> <?php echo $row['nombre']; ?></div>
                </label>
              <?php
              }
              ?>
              <br>
              <div class="input-submit modal-footer">
                <button type="button" class="btn-close-modal" data-bs-dismiss="modal">Cerrar</button>
                <input type="submit" class="btn-cfg" data-bs-dismiss="modal" value="Seleccionar">
              </div>
              <!-- </select> -->
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade seleccionar-prod" id="seleccionar-prod" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Productos existentes</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="permisos">
            <div class="row">
              <div class="col-6">
                <a href="" class="btn-prm" id="nuevoProducto"><i class="fa-solid fa-plus fa-lg"></i> Nuevo producto</a> 
              </div>
              <div class="col-6 text-right">
                <label for="">
                  Filtrar producto por: 
                  <input type="search" class="input" id="filtrarProducto" placeholder=" Código | Nombre">
                </label>
              </div>
            </div>
            <br>
            <div class="row agregar-nuevo-form" id="agregarNuevoForm">
              <div class="col-5">
                <label for="">Código: 
                  <input type="text" placeholder="Código" id="nuevoCodigo">
                </label>
              </div>
              <div class="col-5">
                <label for="">Nombre: 
                  <input type="text" placeholder="Nombre" id="nuevoNombre">
                </label>
              </div>
              <div class="col-2">
                <a href="#"class="btn-prm" id="agregarNuevo">Agregar</a>
              </div>
            </div>
            <br>
            <form class="form-user" id="form-select-prod">
              <?php
                foreach ($readProducto as $row) {
              ?>
                <label class="rad-label radLabelProduct">
                  <input type="radio" class="rad-input" name="producto" value="<?php echo $row['nombre']; ?>">
                  <div class="rad-design"></div>
                  <div class="rad-text"><?php echo $row['codigo']; ?> - <?php echo $row['nombre']; ?></div>
                </label>
              <?php
              }
              ?>
              <br>
              <div class="input-submit modal-footer">
                <button type="button" class="btn-close-modal" data-bs-dismiss="modal">Cerrar</button>
                <input type="submit" class="btn-cfg" data-bs-dismiss="modal" id="seleccionarProducto" value="Seleccionar">
              </div>
              <!-- </select> -->
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php
$addProvCompras = true;
require_once "modales/agregarProveedor.php";
?>

<script src="../assets/js/compras.js" type="module"></script>
