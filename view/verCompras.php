<?php
  require_once "config/Connection.php";
  require_once "logic/Read.php";
  $query = new Read();

  $readCompraProducto = $query->selectTable('compra_producto'); // Hacer una consulta a tabla negocios
  // $resProveedor = $readProveedor->fetch(); // Obtener el registro de la consulta
?>
<section class="ver-compras px-4">
  <section class="compraProducto-info">
    <div class="filtrarCompraProducto">
      <p>Filtrar por:</p>
      <label for="">
        <select name="" id="">
          <option value="" disabled>Seleccionar</option>
          <option value="" selected>Fecha</option>
          <option value="" >Proveedor</option>
        </select>
      </label>
      <label for="">
        <input type="text" placeholder="05-06-2022">
      </label>
    </div>
    <?php
    if($readCompraProducto){
      foreach($readCompraProducto as $row){
        $tableId = $query->selectTableId('sucursal', 'id_sucursal', $row['id_sucursal'], 'nombre');
        $res = $tableId->fetch();
        ?>
        <div class="registroCompras" id="registroCompras">
          <div class="registroCompras-text">
            <p class="text-id">Compra #<span class="id_sucursal"><?php echo $row['id_compra'] ?></span> - <?php echo $res['nombre'] ?></p>
            <p class="text-fecha"><?php echo $row['fecha']; ?></p>
          </div>
          <div class="registroCompras-total">
            <p class="total-text">$<?php echo $row['total']; ?></p>
          </div>
        </div>
        <?php
      }
    }
    ?>
  </section>
  <section class="compraProducto-details">
    <div class="detalles-general">
      <p>Compra #1</p>
      <p>Sucursal Paletería</p>
      <button class="btn btn-success">Descargar</button>
    </div>
    <div class="detallesCompra" id="detallesCompra">
      <div class="columna-campos">
        <p>Proveedor(es)</p>
        <p>Fecha compra</p>
        <p>Fecha consulta</p>
        <p>Sucursal</p>
        <p>Comprador</p>
        <p>Método de pago</p>
        <p>Productos</p>
        <p>Total</p>
      </div>
      <div class="columna-registros">
        <p>Proveedor en general</p>
        <p>29-09-2022 05:55:02</p>
        <p>30-10-2022</p>
        <p>Sucursal Paletería</p>
        <p>Gerente: Juan Carlos Ramírez Mariscal</p>
        <p>Efectivo</p>
        <p>Aceite, Frijol, CocaCola</p>
        <p>$500.00</p>
      </div>
    </div>
    <div class="masDetallesCompra">
      <br>
      <div class="accordion" id="accordionPanelsStayOpenExample">
        <div class="accordion-item">
          <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
              Más detalles
            </button>
          </h2>
          <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingTwo">
            <div class="accordion-body">
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">Nombre</th>
                    <th scope="col">Código</th>
                    <th scope="col">Cantidad</th>
                    <th scope="col">P. Compra</th>
                    <th scope="col">P. Venta</th>
                    <th scope="col">Unidad</th>
                    <th scope="col">Subtotal</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td class="row">Pepsi</td>
                    <td>1</td>
                    <td>20</td>
                    <td>$50</td>
                    <td>$52</td>
                    <td>Kilogramo</td>
                    <td>$502.0</td>
                  </tr>
                  <tr>
                    <td class="row">Pepsi</td>
                    <td>1</td>
                    <td>20</td>
                    <td>$50</td>
                    <td>$52</td>
                    <td>Kilogramo</td>
                    <td>$502.0</td>
                  </tr>
                  <tr>
                    <td class="row">Pepsi</td>
                    <td>1</td>
                    <td>20</td>
                    <td>$50</td>
                    <td>$52</td>
                    <td>Kilogramo</td>
                    <td>$502.0</td>
                  </tr>
                  <tr>
                    <td class="row">Pepsi</td>
                    <td>1</td>
                    <td>20</td>
                    <td>$50</td>
                    <td>$52</td>
                    <td>Kilogramo</td>
                    <td>$502.0</td>
                  </tr>
                  <tr>
                    <td class="row">Pepsi</td>
                    <td>1</td>
                    <td>20</td>
                    <td>$50</td>
                    <td>$52</td>
                    <td>Kilogramo</td>
                    <td>$502.0</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</section>
<section class="modales">

</section>

<?php
// $addProvCompras = true;
// require_once "modales/agregarProveedor.php";
?>

<script src="../assets/js/compras.js" type="module"></script>
