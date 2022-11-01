<?php
  $readCompraProducto = $query->selectTable('compra_producto'); // Hacer una consulta a tabla negocios
  // $resProveedor = $readProveedor->fetch(); // Obtener el registro de la consulta
?>
<section class="ver-compras px-2">
  <section class="compraProducto-info">
    <div class="filtroCompraProducto">
      <form action="" class="agregarFiltro" id="agregarFiltro">
        <div class="filtro-text">
          <p>Filtrar por:</p>
        </div>
        <div class="filtro-input-select">
          <select name="" id="selectFiltro" required>
            <option value="" disabled selected>Seleccionar filtro</option>
            <option value="producto" >Producto</option>
            <option value="proveedor" >Proveedor</option>
            <option value="fecha">Fecha</option>
          </select>
        </div>
        <div class="filtro-input-text">
          <label for="">
            <input type="search" id="filtrarRegistros" placeholder="2022-05-22" autofocus required>
          </label>
        </div>
        <div class="filtro-btn-buscar">
          <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
        </div>
      </form>
    </div>
    <div id="mostrarRegistros">
    </div>
  </section>
  <section class="compraProducto-details">
    <div id="info-user"><p>Seleccione una compra para ver su información</p></div>
    <div class="detalles-general" id="detallesGeneral"></div>
    <div class="detallesCompra" id="detallesCompra"></div>
    <div class="masDetallesCompra" id="masDetallesCompra"></div>
  </section>
</section>

<?php
// $addProvCompras = true;
// require_once "modales/agregarProveedor.php";
?>

<script src="../assets/js/compras.js" type="module"></script>
