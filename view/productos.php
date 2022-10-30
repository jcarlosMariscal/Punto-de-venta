<?php
include "config/Connection.php";
require_once "logic/Read.php";
$query = new Read();

// -------------
$deletProducto = (isset($_GET['delete']) ? $_GET['delete'] : NULL);
$editProducto = (isset($_GET['edit']) ? $_GET['edit'] : NULL);
// -------------


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
      <div class="row">
        <div class="col">
          <form action="">
            <label for="">Buscar por:</label>
            <select name="" id="">
              <option value="">Código</option>
              <option value="">Nombre del Producto</option>
              <!-- <option value="">Categoria</option> -->
            </select>
            <input type="text" name="" id="" class="input" name="buscar" id="buscar">
          </form>
        </div>
        <br>
        <div class="col-2">
          <div class="mb-2">
            <button type="button" data-bs-toggle="modal" data-bs-target="#excel" class="btn btn-primary subir">Importar Excel</button>
          </div>
        </div>
      </div>
    </div>
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
              <td><?php echo $row['id_unidad']; ?></td>
              <td class="text-center"><a href="index.php?p=productos&delete=<?php echo $row['id_producto']; ?>" class="btn-tb-delete"><i class="fa-solid fa-trash-can"></i></a></td>
              <td class="text-center"><a href="index.php?p=productos&edit=<?php echo $row['id_producto']; ?>" class="btn-tb-update"><i class="fa-solid fa-pen"></i></a></td>
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
  $edit = $query->editProducto($editProducto);
  foreach ($edit as $row) {
    $id_producto = $row['id_producto'];
    $codigo = $row['codigo'];
    $nombre = $row['nombre'];
    $cantidad = $row['cantidad'];
    $pcompra = $row['pcompra'];
    $pventa = $row['pventa'];
    $id_unidad = $row['id_unidad'];
    $fecha = $row['fecha'];
  }
  ?>
  <div class="modal fade" id="modProducto" tabindex="-1" role="dialog" aria-hidden="true">
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
              <div class="input-cargo input-prov" id="group-cargo">
                <label for="">fecha: </label>
                <input type="text" class="input" name="fecha" id="fecha" value="<?php echo $fecha; ?>">
                <p class="input-error">* Rellena este campo correctamente</p>
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

  <!-- Mostrar información -->
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


    <div class="modal fade" id="pro<?php echo $row['id_producto'] ?>">
      <div class="modal-dialog">
        <div class="borde modal-content">
          <div class="modal-header">
            <h3 class="modal-title" id="exampleModalLabel">Información del Producto🧾</h3>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body margen1">
            <div class="modal-left-content">
              <img class="centrar-logo" src="../assets/img/favicon.png" alt="Logo">
              <h3 class="title-name text-center"> Easy </h3>
              <h3 class="title-name text-center"><span> Sale </span></h3>
            </div>
            <div class="modal-main-content1">
              <div class="form-group">
                <section class="ticket__section">
                  <h4>Codigo</h4>
                  <?php echo $codigo ?>
                </section>
                <section class="ticket__section">
                  <h4>Nombre</h4>
                  <?php echo $nombre ?>
                </section>
                <section class="ticket__section">
                  <h4>Cantidad</h4>
                  <?php echo $cantidad ?>
                </section>
                <section class="ticket__section">
                  <h4>Precio compra</h4>
                  <?php echo $pcompra ?>
                </section>
                <section class="ticket__section">
                  <h4>Precio venta</h4>
                  <?php echo $pventa ?>
                </section>
                <section class="ticket__section">
                  <h4>Unidad</h4>
                  <?php echo $id_unidad ?>
                </section>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn1" data-bs-dismiss="modal">Cerrar</button>
            <a href="pdf/prod_pdf.php?p=productos&id_producto=<?php echo $row['id_producto'] ?>" target="_blank"><button type="button" class="btn btn2">Imprimir</button></a>
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
                <label for="">Selecciona la unidad a la que quiere insertar datos</label>
                <p class="input-error">* Rellena este campo correctamente</p>
                <select name="id_unidad" id="id_unidad" class="select-user-rol">
                  <?php
                  $unidad = $query->idUnidad(); //Hacer consulta para leer los tipos de negocios.
                  ?>
                  <?php
                  foreach ($unidad as $tipo) {
                  ?>
                    <option value="<?php echo $tipo['id_unidad']; ?>" selected><?php echo $tipo['id_unidad']; ?></option>
                  <?php
                  }
                  ?>
                </select>
                <br>
                <br>
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
