<?php
  include('../conexion/conexion.php');
  $sql = "SELECT * FROM productos";
  $query = mysqli_query($con, $sql); 
  $nombre = (isset($_GET['nombre']) ? $_GET['nombre'] : NULL);
  $ver = (isset($_GET['ver']) ? $_GET['ver'] : NULL);

?>
<section class="above">
    <div class="above__info">
      <span class="info__seccion">Compras</span>
      <!-- <a href="index.php?p=ver-compras" class="btn-prm btn-above">Mis Ventas</a> -->
      &nbsp; &nbsp;
      <!-- <a href="index.php?p=ver-compras" class="btn-prm btn-above">Mi Reporte</a> -->
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
<section class="table-productos">
  <div class="product-filter">
    <form action="">
      <label for="">Buscar por: </label>
      <select name="" id="">
        <option value="">Código</option>
        <option value="">Nombre del Producto</option>
        <!-- <option value="">Categoria</option> -->
      </select>
      <input type="text" name="" id="" class="input" name="buscar" id="buscar">
    </form>
    <br>
  </div>
  <div class="table-product">
    <table table bgcolor="#FFFFFF" class="table table-bordered">
      <thead>
        <tr>
          <th scope="col">Código</th>
          <th scope="col">Producto</th>
          <!-- <th scope="col">Categoria</th> -->
          <!-- <th scope="col">Medida</th> -->
          <th scope="col">Precio Compra</th>
          <th scope="col">Precio Venta</th>   
          <th scope="col">Fecha</th>   
          <th scope="col">Stock</th> 
        </tr>
      </thead>
      <tbody id="table-bogy">
        <?php
          foreach ($query as $row) {
            ?>
            <tr class="products">
              <td class="text-center"><?php echo ($row['codigo'] == NULL)? '<a class="btn-tb-info" href="index.php?p=productos&nombre='.$row['producto'].'"><i class="fa-solid fa-circle-plus"></i></a>' : '<a href="index.php?p=productos&ver='.$row['codigo'].'">'.$row['codigo'].'</a>' ?></td>
              <td><?php echo $row['producto']; ?></td>
              <td><?php echo $row['pcompra']; ?></td>
              <td><?php echo $row['pventa']; ?></td>
              <td><?php echo $row['fecha']; ?></td>
              <td><?php echo $row['cantidad']; ?></td>
              <td class="text-center"><a href="" class="btn-tb-delete deshabilitar"><i class="fa-solid fa-trash-can"></i></a></td>
              <td class="text-center"><a href="" class="btn-tb-update deshabilitar"><i class="fa-solid fa-pen"></i></a></td>
              <td class="text-center"><a href="" class="btn-tb-info deshabilitar"><i class="fa-solid fa-circle-info"></i></a></td>
            </tr>
            <?php
          }
        ?>
      </tbody> 
    </table>
  </div>
</section>

<div class="modal fade" id="codigo-barras" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Generar código de barras para <?php echo $nombre; ?></h5>
            <span data-dismiss="modal" aria-label="Close" class="close"><i class="fa-solid fa-xmark"></i></span>
        </div>
        <div class="modal-body">
            <div class="permisos">
              <div class="codigo-existente">
                <!-- <a href="http://">Seleccionar existente:</a> -->
              </div>
              <!-- <hr> -->
              <div class="generar-codigo">
                <p>Generar un nuevo código de barras (CODE128):</p>
                <form id="formCodigo">
                  <input type="number" name="codigo" id="codigo" placeholder="Código del producto" pattern="[\d]" required>
                  <input type="hidden" name="producto" id="producto" value="<?php echo $nombre; ?>">
                  <!-- <input type="text" placeholder="Formato de código"> -->
                  <input type="submit" value="Generar">
                </form>
                <svg id="barcode"></svg>
              </div>
            </div>
            <br>
        </div>
        <div class="input-submit modal-footer">
          <!-- <button type="button" class="btn-close-modal" data-dismiss="modal">Cerrar</button> -->
          <input type="submit" class="btn-cfg" value="Agregar" id="btn-add">
        </div>
    </div>
  </div>
</div>
<div class="modal fade" id="mostrarCodigo" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Código de Barras <span id="verCodigo"><?php echo $ver; ?></span></h5>
            <span data-dismiss="modal" aria-label="Close" class="close"><i class="fa-solid fa-xmark"></i></span>
        </div>
        <div class="modal-body">
            <div class="permisos">
              <div class="">
                <svg id="ver-barcode"></svg>
              </div>
            </div>
            <br>
        </div>
        <div class="input-submit modal-footer">
          <!-- <button type="button" class="btn-close-modal" data-dismiss="modal">Cerrar</button> -->
          <input type="submit" class="btn-cfg" value="Cerrar" id="btn-cerrar">
        </div>
    </div>
  </div>
</div>

<script src="../assets/js/productos.js" type="module"></script>