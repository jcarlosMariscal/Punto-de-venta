<?php
// -------------
$deletProducto = (isset($_GET['delete']) ? $_GET['delete'] : NULL);
$editProducto = (isset($_GET['edit']) ? $_GET['edit'] : NULL);
// -------------
    $readNegocio = $query->readNegocio($_SESSION['user']['id_negocio']); 
  
  foreach($readNegocio as $row){
    $logoNegocio = $row['logo'];
    $nombreNegocio = $row['nombre'];
  }

$nombre = (isset($_GET['nombre']) ? $_GET['nombre'] : NULL);
$ver = (isset($_GET['ver']) ? $_GET['ver'] : NULL);
if ($deletProducto) {
?>
  <script>
    Swal.fire({
      title: "¿Está seguro de eliminar el producto <b><?php echo $deletProducto; ?></b>?",
      text: "Esta acción eliminará los productos de la base de de datos",
      icon: "question",
      showCancelButton: true,
      confirmButtonText: 'Eliminar',
      confirmButtonColor: "#D13513",
      cancelButtonText: 'Cancelar',
      allowOutsideClick: false
    }).then((button) => {
      if (button.isConfirmed === true) {
        window.location.href = "logic/deleteData.php?productos=<?php echo $deletProducto; ?>"
      }
      if (button.isDismissed === true) window.location.href = "index.php?p=productos";
    });
  </script>
<?php
}
// error_reporting(E_ERROR);

?>


<section class="container">
  <section class="table-productos">
    <div class="product-filter">
      <div class="search-p alinearp">
        <div class="searchproduc">
          <!-- <button type="submit" class="searchCode"><i class="fa fa-barcode fa-lg"></i></button>
          <button type="submit" class="searchButton"><i class="fa fa-search fa-lg"></i></button>
          <input type="text" class="searchTerm" placeholder="Buscar Producto"> -->
        </div>
        <a href="compras" class="btn-prm btn-prod">
          <i class="fa-solid fa-plus fa-lg"></i> Agregar Producto
        </a>
        <div class="cargarP col-md-6 col-sm-6 col-xs-6">
          <div class="input-file btn-prodsubir">
            <a href="#"  data-bs-toggle="modal" data-bs-target="#excel" class="text-white" style="text-decoration:none"><i class="fa-solid fa-arrow-up-from-bracket fa-lg"></i> Cargar productos</a>
          </div>
            <!-- <input type="file" name="logo" id="myFile" class="input-file btn-prodsubir" value="">
            <i class="fa-solid fa-arrow-up-from-bracket fa-lg"></i> Cargar Productos -->
        </div>
      </div>
    </div>
    <br>
    <div class="table-produc">
      <table table bgcolor="#FFFFFF" class="table table-bordered">
        <thead>
          <tr>
            <th scope="col">Código</th>
            <th scope="col">Nombre</th>
            <!-- <th scope="col">Categoria</th> -->
            <!-- <th scope="col">Medida</th> -->
            <th scope="col">Cantidad</th>
            <th scope="col">P. Compra</th>
            <th scope="col">P. Venta</th>
            <th scope="col">unidad</th>
            <th scope="col">Categoria</th>
          </tr>
        </thead>
        <tbody id="table-body">
          <?php
          $result = $query->selectProductos();
          foreach ($result as $row) {
          ?>
            <tr class="products">
              <td class="text-center"><?php echo ($row['codigo'] == NULL) ? '<a class="btn-tb-info" href="index.php?p=productos&nombre=' . $row['nombre'] . '"><i class="fa-solid fa-circle-plus"></i></a>' : '<a href="index.php?p=productos&ver=' . $row['codigo'] . '">' . $row['codigo'] . '</a>' ?></td>
              <td><?php echo $row['nombre']; ?></td>
              <td><?php echo $row['cantidad']; ?></td>
              <td><?php echo $row['pcompra']; ?></td>
              <td><?php echo $row['pventa']; ?></td>
              <td>
                <?php  
                $getUnidad = $query->selectTableId("unidad", "id_unidad", $row['id_unidad'], "unidad");
                $miUnidad = $getUnidad->fetch()['unidad'];
                $getCategoria = $query->selectTableId("categoria", "id_categoria", $row['id_categoria'], "categoria");
                $miCategoria = $getCategoria->fetch()['categoria']
                ?>
              <?php echo $miUnidad; ?></td>
              <td><?php echo $miCategoria; ?></td>
              <td class="text-center"><a href="index.php?p=productos&delete=<?php echo $row['id_producto']; ?>" class="btn-tb-delete"><i class="fa-solid fa-trash-can"></i></a></td>
              <td class="text-center"><a href="#" class="btn-tb-update" data-bs-toggle="modal" data-bs-target="#modProduct<?php echo $row['id_producto'] ?>"><i class="fa-solid fa-pen"></i></a></td>
              <td class="text-center"><a href="" data-bs-toggle="modal" data-bs-target="#pro<?php echo $row['id_producto'] ?>" class="btn-tb-info"><i class="fa-solid fa-circle-info"></i></a></td>
            </tr>
          <?php
          }
          ?>
        </tbody>
      </table>
    </div>
  </section>
  <!-- EDITAR -->
    <?php
  $result = $query->selectProductos(); //Mostramos los resultados

  foreach ($result as $row) {
    $id_producto = $row['id_producto'];
    $codigo = $row['codigo'];
    $nombre = $row['nombre'];
    $cantidad = $row['cantidad'];
    $pcompra = $row['pcompra'];
    $pventa = $row['pventa'];
    $id_unidad = $row['id_unidad'];
  ?>
  <div class="modal fade" id="modProduct<?php echo $id_producto; ?>" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Editar Producto <?php echo $nombre; ?></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="permisos">
            <form class="form-user" id="formularioEdit" method="POST" action="logic/updateData.php">
              <input type="hidden" name="table" id="action_per" value="editarProducto">
              <input type="hidden" name="id_producto" id="id_producto" value="<?php echo $id_producto; ?>">
              <input type="hidden" class="input" name="id_producto" id="id_producto" value="<?php echo $id_producto; ?>">
              <div class="input-nombre input-prov" id="group-nombre">
                <label for="">Codigo: </label>
                <input type="text" class="input" name="codigo" id="codigo" value="<?php echo $codigo; ?>">
                <p class="input-error">* Rellena este campo correctamente</p>
              </div>
              <div class="input-telefono input-prov" id="group-telefono">
                <label for="">Nombre: </label>
                <input type="text" class="input" name="nombre" id="nombre" value="<?php echo $nombre; ?>">
                <p class="input-error">* Rellena este campo correctamente</p>
              </div>
              <div class="input-correo input-prov" id="group-correo">
                <label for="">Cantidad: </label>
                <input type="text" class="input" name="cantidad" id="cantidad" value="<?php echo $cantidad; ?>">
                <p class="input-error">* Rellena este campo correctamente</p>
              </div>
              <div class="input-contacto input-prov" id="group-contacto">
                <label for="">pcompra: </label>
                <input type="text" class="input" name="pcompra" id="pcompra" value="<?php echo $pcompra; ?>">
                <p class="input-error">* Rellena este campo correctamente</p>
              </div>
              <div class="input-cargo input-prov" id="group-cargo">
                <label for="">pventa: </label>
                <input type="text" class="input" name="pventa" id="pventa" value="<?php echo $pventa; ?>">
                <p class="input-error">* Rellena este campo correctamente</p>
              </div>
              <div class="input-user-rol input-user" id="group-unidad">
                <label for="">Unidad:</label>
                <p class="input-error">* Rellena este campo correctamente</p>
                <select name="id_unidad" id="id_unidad" class="select-user-rol">
                  <?php
                  $unidad = $query->idUnidad(); //Hacer consulta para leer los tipos de negocios.
                  ?>
                  <?php
                  foreach ($unidad as $tipo) {
                  ?>
                    <option value="<?php echo $tipo['id_unidad']; ?>" selected><?php echo $tipo['unidad']; ?></option>
                  <?php
                  }
                  ?>

                </select>
              </div>

              <!-- <hr> -->
              <br>
              <div class="input-submit modal-footer">
                <button type="button" class="btn-close-modal" id="cerrarForm2" data-bs-dismiss="modal">Cerrar</button>
                <input type="submit" class="btn-cfg" value="Modificar" id="btn-send">
              </div>
            </form>

          </div>
          <br>
        </div>
      </div>
    </div>
  </div>
  <?php
  }
  ?>
  <!-- Mostrar información -->
  <?php
  $result2 = $query->selectProductos(); //Mostramos los resultados

  foreach ($result2 as $row) {
    $id_producto = $row['id_producto'];
    $codigo = $row['codigo'];
    $nombre = $row['nombre'];
    $cantidad = $row['cantidad'];
    $pcompra = $row['pcompra'];
    $pventa = $row['pventa'];
    $id_unidad = $row['id_unidad'];
  ?>

  <div class="modal fade" id="pro<?php echo $row['id_producto'] ?>">
    <div class="modal-dialog modal-fullscreen-xxl-down">
      <div class="borde modal-content">
        <div class="modal-header">
          <h3 class="modal-title" id="exampleModalLabel">Información del Administrador</h3>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
       <article id="ticket">
        <div class="contenedor-head">
          <img src="../assets/img/logo/<?php echo $logoNegocio; ?>" class="ticon" alt="">
          <p class="title-princ"><span>Nova Tech</span></p>
          <p class="title-subp"><span>Easy Sal</span></p>
          <p class="title-subsp">Datos de producto</p>
          <p>
            El presente documento muestra la infomación del producto <span class="remarc"><?php echo $nombre ?></span> con el codigo<span class="remarc"><?php echo $codigo; ?></span>. En el almacén hay una cantidad de <span class="remarc"><?php echo $cantidad;?></span> de este producto, el precio por unidad la cuál se adquirio fue de <span class="remarc"><?php echo $pcompra; ?></span> y el precio de venta es de  <span class="remarc"><?php echo $pventa; ?></span>
          </p>
      </article>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn-close-modal" data-bs-dismiss="modal">Cerrar</button>
          <!-- <button type="button" class="btn-save-modal" id="descargarReporte">Descargar</button> -->
            <!-- <a href="pdf/prod_pdf.php?p=productos&id_producto=<?php echo $row['id_producto'] ?>" target="_blank"><button type="button" class="btn btn2">Imprimir</button></a> -->
          </div>
      </div>
    </div>
  </div>
  <?php
  }
  ?>
  <!-- Importar datos de Excel -->
  <div class="modal fade" id="excel">
    <div class="modal-dialog modal-lg">
      <div class="borde modal-content">
        <div class="modal-header">
          <h3 class="modal-title" id="exampleModalLabel">Importar datos de Excel🧾</h3>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body margen1">
          <!-- <div class="modal-left-content">
            <img class="centrar-logo" src="../assets/img/favicon.png" alt="Logo">
            <h3 class="title-name text-center"> Easy </h3>
            <h3 class="title-name text-center"><span> Sale </span></h3>
          </div> -->
          <div class="modal-main-content1">
            <div class="form-group">
              <form action="logic/createData.php" method="post" name="frmExcelImport" id="frmExcelImport" enctype="multipart/form-data">
                
                <input required class="form-control" type="file" name="file" id="file" accept=".xls,.xlsx" multiple>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn1" data-bs-dismiss="modal">Cerrar</button>
          <button type="submit" id="archivo" name="import" class="btn btn-primary subir">Importar</button>
          <!-- <input type="submit" id="archivo" name="import" class="btn btn-danger subir" value="Importar"> -->
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="codigo-barras" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle">Generar código de barras para <?php echo $nombre; ?></h5>
              <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
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
              <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
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
</section>

<script src="../assets/js/productos.js" type="module"></script>


<script>
  let modProducto = localStorage.getItem("modProducto");
  let deletProducto = localStorage.getItem("deletProducto");
  let excel = localStorage.getItem("excel");
  if (modProducto === "true") {
    Swal.fire({
      title: "Registro modificado",
      text: "La información del producto se ha cambiado correctamente.",
      icon: "success", //error, 
      timer: 3000,
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      confirmButtonColor: '#47874a',
    });
  }
  setTimeout(function() {
    localStorage.removeItem("modProducto");
  }, 1500);
  if (deletProducto === "true") {
    Swal.fire({
      title: "Registro eliminado correctamente",
      text: "La información del producto se ha eliminado correctamente",
      icon: "success", //error, 
      timer: 3000,
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      confirmButtonColor: '#47874a',
    });
  }
  setTimeout(function() {
    localStorage.removeItem("deletProducto");
  }, 1500);

  if (excel === "true") {
    Swal.fire({
      title: "Archivo importado correctamente",
      text: "Se han subido tus productos a la base de datos",
      icon: "success", //error, 
      timer: 3000,
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      confirmButtonColor: '#47874a',
    });
  }else if(excel === "false"){
    Swal.fire({
      title: "Productos no registrados",
      text: "No se ha podido subir tus productos a la base de datos",
      icon: "error", //error, 
      timer: 3000,
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      confirmButtonColor: '#47874a',
    });

  }
  setTimeout(function() {
    localStorage.removeItem("excel");
  }, 1500);
</script>
