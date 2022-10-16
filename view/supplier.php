<?php
  include "config/Connection.php";
  require_once "logic/Read.php";
  $query = new Read();

  $deleteProv = (isset($_GET['delete']) ? $_GET['delete'] : NULL);
  $editProv = (isset($_GET['edit']) ? $_GET['edit'] : NULL);


  if($deleteProv){
  ?>
  <script>
    Swal.fire({
        title: "¿Está seguro de eliminar el proveedor <b><?php echo $deleteProv; ?></b>?",
        text: "Esta acción eliminará el proveedor y los productos de la base de de datos",
        icon: "question",
        showCancelButton: true,
        confirmButtonText: 'Eliminar',
        confirmButtonColor: "#D13513",
        cancelButtonText: 'Cancelar',
        allowOutsideClick: false
    }).then((button)=>{
        if(button.isConfirmed === true){
          window.location.href="logic/deleteData.php?proveedor=<?php echo $deleteProv; ?>"
        }     
        if(button.isDismissed === true) window.location.href="index.php?p=proveedor";
    });
  </script>
  <?php
}
?>

<section class="content">
    <section class="table-ver-product">
        <div class="table-above">
            <div class="product-chart">
                <a href="" class="btn-prm btn-cancelar" data-bs-toggle="modal" data-bs-target=".agregarProveedor"><i class="fa-solid fa-plus fa-lg"></i> Agregar</a>
            </div>
        </div>
        <div class="table-ver content rounded-3 p-3">
            <table table bgcolor= "#FFFFFF"  class="table table-bordered">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">NOMBRE</th>
                    <th scope="col">TELÉFONO</th>
                    <th scope="col">CORREO</th>
                    <th scope="col">CONTACTO</th>
                    <th scope="col">CARGO</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $result = $query->selectProveedor();
                    foreach ($result as $row) {
                      ?>
                      <tr class="prod">
                        <td><?php echo $row['id_proveedor']; ?></td>
                        <td><?php echo $row['nombre']; ?></td>
                        <td><?php echo $row['telefono']; ?></td>
                        <td><?php echo $row['correo']; ?></td>
                        <td><?php echo $row['contacto']; ?></td>
                        <td><?php echo $row['cargo']; ?></td>
                        <td class="text-center"><a href="index.php?p=proveedor&delete=<?php echo $row['id_proveedor']; ?>" class="btn-tb-delete"><i class="fa-solid fa-trash-can"></i></a></td>
                        <td class="text-center"><a href="index.php?p=proveedor&edit=<?php echo $row['id_proveedor']; ?>" class="btn-tb-update"><i class="fa-solid fa-pen"></i></a></td>
                        <td class="text-center"><a href="" data-bs-toggle="modal" data-bs-target="#static<?php echo $row['id_proveedor'] ?>" class="btn-tb-info"><i class="fa-solid fa-circle-info"></i></a></td>
                      </tr>
                      <?php
                    } 
                  ?>
                      
                </tbody>
            </table>
        </div>
    </section>

    <!-- AGREGAR -->
<div class="modal fade agregarProveedor" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Agregar proveedor</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="permisos">
              <form class="form-user" id="formulario" method="POST" action="logic/createData.php">
              <input type="hidden" name="table" id="action_per" value="agregarProveedor">
              <div class="input-user-name input-prov" id="group-nombre">
                <label for="">Nombre: </label>
                <input type="text" class="input" name="nombre" id="nombre" placeholder="Introduce un nombre">
                <p class="input-error">*El nombre no debe quedar vacío, puede tener letras y acentos.</p>
              </div>
              <!-- <div class="input-factura input-prov" id="group-factura">                                       
                      <label for="">Tipo factura: </label>
                        <input type="text" class="input" name="factura" id="factura" placeholder="Introduce tipo de factura">
                        <p class="input-error">* Este campo no debe quedar vacío y acepta solo texto.</p>
                    </div> -->
              <div class="input-user-tel input-prov" id="group-telefono">
                <label for="">Teléfono</label>
                <input type="number" name="telefono" id="telefono" class="input" placeholder="Introduce un teléfono">
                <p class="input-error">*Este campo debe ser númerico y tener 10 caracteres.</p>
              </div>
              <div class="input-user-email input-prov" id="group-correo">
                <label for="">Correo</label>
                <input type="email" name="correo" id="correo" class="input" placeholder="Introduce tu correo">
                <p class="input-error">*Este campo debe ser un tipo de E-mail valido.</p>
              </div>
              <div class="input-user-tel input-prov" id="group-contacto">
                <label for="">Contacto</label>
                <input type="text" name="contacto" id="contacto" class="input" placeholder="Introduce tu contacto">
                <p class="input-error">*Este campo debe ser númerico y tener 10 caracteres.</p>
              </div>
              <div class="input-user-name input-prov" id="group-cargo">
                <label for="">Cargo</label>
                <input type="text" name="cargo" id="cargo" class="input" placeholder="Introduce el cargo">
                <p class="input-error">*El nombre no debe quedar vacío, puede tener letras y acentos.</p>
              </div>
              <!-- <hr> -->
              <br>
              <div class="input-submit modal-footer">
                <button type="button" class="btn-close-modal" data-bs-dismiss="modal"><i class="fa-solid fa-xmark fa-lg"></i> Cerrar</button>
                <button type="submit" class="btn-cfg" id="btn-send"><i class="fa-solid fa-plus fa-lg"></i> Agregar</button>
              </div>
            </form>
            </div>
            <br>
        </div>
    </div>
  </div>
</div>
    <!-- EDITAR -->
  <?php
     $edit = $query->editProveedor($editProv);
    foreach($edit as $row){
      $id_prov = $row['id_proveedor'];
      $nombre = $row['nombre'];
      $telefono = $row['telefono'];
      $correo = $row['correo'];
      $contacto = $row['contacto'];
      $cargo = $row['cargo'];
    }
  ?>
<div class="modal fade bd-example-modal-lg" id="modProv" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Editar Proveedor <?php echo $nombre; ?></h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="permisos">
          <form class="form-user" id="formularioEdit" method="POST" action="logic/updateData.php">
              <input type="hidden" name="table" id="action_per" value="editarProveedor">
              <input type="hidden" name="id_proveedor" id="id_proveedor" value="<?php echo $id_prov; ?>">
              <input type="hidden" class="input" name="id_proveedor" id="id_proveedor" value="<?php echo $id_prov; ?>">
              <div class="input-user-name input-prov" id="group-nombre">
                <label for="">Nombre </label>
                <input type="text" class="input" name="nombre" id="nombre" value="<?php echo $nombre; ?>">
                <p class="input-error">* Rellena este campo correctamente</p>
              </div>
              <div class="input-user-tel input-prov" id="group-telefono">
                <label for="">Telefono </label>
                <input type="number" class="input" name="telefono" id="telefono" value="<?php echo $telefono; ?>">
                <p class="input-error">* Rellena este campo correctamente</p>
              </div>
              <div class="input-user-email input-prov" id="group-correo">
                <label for="">Correo </label>
                <input type="email" class="input" name="correo" id="correo" value="<?php echo $correo; ?>">
                <p class="input-error">* Rellena este campo correctamente</p>
              </div>
              <div class="input-user-tel input-prov" id="group-contacto">
                <label for="">Contacto </label>
                <input type="text" class="input" name="contacto" id="contacto" value="<?php echo $contacto; ?>">
                <p class="input-error">* Rellena este campo correctamente</p>
              </div>
              <div class="input-user-name input-prov" id="group-cargo">
                <label for="">Cargo </label>
                <input type="text" class="input" name="cargo" id="cargo" value="<?php echo $cargo; ?>">
                <p class="input-error">* Rellena este campo correctamente</p>
              </div>

              <!-- <hr> -->
              <br>
              <div class="input-submit modal-footer">
                <button type="button" class="btn-close-modal" id="cerrarForm2" data-bs-dismiss="modal"><i class="fa-solid fa-xmark fa-lg"></i> Cerrar</button>
                <button type="submit" class="btn-cfg" id="btn-send"><i class="fa-solid fa-pencil"></i> Modificar</button>
                <!-- <input type="submit" class="btn-cfg" value="Modificar" id="btn-send"> -->
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
  $result = $query->selectInfo(); //Mostramos los resultados

  foreach ($result as $row) {
    $id_prov = $row['id_proveedor'];
    $nombre = $row['nombre'];
    $telefono = $row['telefono'];
    $correo = $row['correo'];
    $contacto = $row['contacto'];
    $cargo = $row['cargo'];      
  ?>


<div class="modal fade" id="static<?php echo $row['id_proveedor'] ?>">
  <div class="modal-dialog">
    <div class="borde modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLabel">Información del Proveedor🧾</h3>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body margen1">
          <div class="modal-left-content">
              <img class="centrar-logo" src="../assets/img/favicon.png" alt="Logo">
              <h3 class="title-name text-center"> Easy </h3>
              <h3 class="title-name text-center"><span> Sale </span></h3>
          </div>
          <div class="modal-main-content1">
              <div class="form-group ">
              <section class="ticket__section">
                <h5>Nombre: <?php echo $nombre ?></h5>
              </section>
              <section class="ticket__section">
                <h5>Telefono: <?php echo $telefono ?></h5>
              </section>
              <section class="ticket__section">
                <h5>Correo: <?php echo $correo ?></h5>
              </section>
              <section class="ticket__section">
                <h5>Contacto: <?php echo $contacto ?></h5>
              </section>
              <section class="ticket__section">
                <h5>Cargo: <?php echo $cargo ?></h5>
              </section>
              </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn-close-modal" data-bs-dismiss="modal">Cerrar</button>
        <a href="pdf/per_pdf.php" target="_blank"><button type="button" class="btn-imprimir">Imprimir</button></a>
      </div>
    </div>
  </div>
</div>
<?php
}
  ?>


<script src="../assets/js/proveedor.js" type="module"></script>

<script>
    let addProv = localStorage.getItem("addProv");
    let modProv = localStorage.getItem("modProv");
    let deleteProv = localStorage.getItem("deleteProv");
    if(addProv === "true"){
      Swal.fire({
            title: "Registro agregado",
            text: "El proveedor se ha agregado correctamente",
            icon: "success",//error, 
            timer: 3000,
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            confirmButtonColor: '#47874a',
        });
    } 
    setTimeout(function(){
        localStorage.removeItem("addProv");
    }, 1500);
    if(modProv === "true"){
      Swal.fire({
            title: "Registro modificado",
            text: "La información del proveedor se ha cambiado correctamente.",
            icon: "success",//error, 
            timer: 3000,
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            confirmButtonColor: '#47874a',
        });
    } 
    setTimeout(function(){
        localStorage.removeItem("modProv");
    }, 1500);
        if (deleteProv === "true") {
      Swal.fire({
        title: "Registro eliminado correctamente",
        text: "La información del proveedor se ha eliminado correctamente",
        icon: "success", //error, 
        timer: 3000,
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        confirmButtonColor: '#47874a',
      });
    }
    setTimeout(function() {
      localStorage.removeItem("deleteProv");
    }, 1500);
</script>
