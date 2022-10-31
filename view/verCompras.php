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
    <div id="info-user"><p>Selecciona una compra para ver su información</p></div>
    <div class="detalles-general" id="detallesGeneral"></div>
    <div class="detallesCompra" id="detallesCompra"></div>
    <div class="masDetallesCompra" id="masDetallesCompra"></div>
  </section>
</section>
<section class="modales">

</section>

<?php
// $addProvCompras = true;
// require_once "modales/agregarProveedor.php";
?>

<script src="../assets/js/compras.js" type="module"></script>
