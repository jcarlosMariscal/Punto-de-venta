<?php
  include "config/Connection.php";
  require_once "logic/Read.php";
  $query = new Read();

  $deletePer = (isset($_GET['delete']) ? $_GET['delete'] : NULL);
  $editPer = (isset($_GET['edit']) ? $_GET['edit'] : NULL);

  if($deletePer){
  ?>
  <script>
    Swal.fire({
        title: "¿Está seguro de eliminar a este personal?",
        text: "Esta acción eliminará al personal de la base de de datos",
        icon: "question",
        showCancelButton: true,
        confirmButtonText: 'Eliminar',
        confirmButtonColor: "#D13513",
        cancelButtonText: 'Cancelar',
        allowOutsideClick: false
    }).then((button)=>{
        if(button.isConfirmed === true){
          window.location.href="logic/deleteData.php?personal=<?php echo $deletePer; ?>"
        }     
        if(button.isDismissed === true) window.location.href="index.php?p=personal";
    });
  </script>
  <?php
}
?>
<section class="content">
    <section class="table-ver-product">
        <div class="table-above">
            <div class="product-filter">
                <p>Recuerde que puede modificar los permisos en <a href="index.php?p=configuration">Configuración</a></p>
            </div>
            <div class="product-chart">
                <a href="" class="btn-prm btn-cancelar" data-bs-toggle="modal" data-bs-target=".agregarPersonal">Agregar</a>
            </div>
        </div>
        <div class="table-ver">
            <table table bgcolor= "#FFFFFF"  class="table table-bordered">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">NOMBRE</th>
                    <th scope="col">CORREO</th>
                    <th scope="col">TELEFONO</th>
                    <th scope="col">ID_SUCURSAL</th>
                    <th scope="col">ID_ROL</th>

                  </tr>
                </thead>
                <tbody>
                  <?php
                  $result1 = $query->selectPersonal();
                    foreach ($result1 as $row) {
                      ?>
                        <tr class="prod">
                          <td><?php echo $row['id_personal']; ?></td>
                          <td><?php echo $row['nombre']; ?></td>
                          <td><?php echo ($row['correo'] == NULL) ? "<b>Sin Correo</b>" : $row['correo']; ?></td>
                          <td><?php echo ($row['telefono'] == NULL) ? "<b>Sin telefono</b>" : $row['telefono']; ?></td>
                          <td><?php echo ($row['id_sucursal'] == NULL) ? "<b>Sin dato</b>" : $row['id_sucursal']; ?></td>
                          <td><?php echo $row['id_rol'] == 1 ? "Gerente" : "Ventas"; ?></td>
                          <td class="text-center"><a href="index.php?p=personal&delete=<?php echo $row['id_personal']; ?>" class="btn-tb-delete"><i class="fa-solid fa-trash-can"></i></a></td>
                          <td class="text-center"><a href="index.php?p=personal&edit=<?php echo $row['id_personal']; ?>" class="btn-tb-update"><i class="fa-solid fa-pen"></i></a></td>
                          <td class="text-center"><a href="" data-bs-toggle="modal" data-bs-target="#static<?php echo $row['id_personal'] ?>" class="btn-tb-info"><i class="fa-solid fa-circle-info"></i></a></td>
                      </tr>
                      <?php
                    }
                  ?>
                </tbody>
            </table>
        </div>
    </section>

    <!-- AGREGAR -->
<div class="modal fade agregarPersonal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Agregar personal nuevo</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="permisos">
                <form class="form-user" id="formulario" method="POST" action="logic/createData.php">
              <input type="hidden" name="table" id="action_per" value="agregarPersonal">
              <div class="input-user-name input-user" id="group-nombre">
                <label for="">Nombre: </label>
                <input type="text" class="input" name="nombre" id="nombre" placeholder="Introduce tu nombre">
                <p class="input-error">*El nombre no debe quedar vacío, puede tener letras y acentos.</p>
              </div>
              <div class="input-user-email input-user" id="group-correo">
                <label for="">Correo</label>
                <input type="email" name="correo" id="correo" class="input" placeholder="Introduce tu correo">
                <p class="input-error">*Este campo debe ser un tipo de E-mail valido.</p>
              </div>
              <div class="input-user-tel input-user" id="group-telefono">
                <label for="">Teléfono</label>
                <input type="number_format" name="telefono" id="telefono" class="input" placeholder="Introduce tu telefono">
                <p class="input-error">*Este campo debe ser númerico y tener 10 caracteres. </p>
              </div>
              <div class="input-user-ciudad input-user" id="group-ciudad">
                <label for="">Ciudad</label>
                <input type="text" name="ciudad" id="ciudad" class="input" placeholder="Introduce tu telefono">
                <p class="input-error">*El nombre no debe quedar vacío, puede tener letras y acentos.</p>
              </div>
              <div class="input-user-domicilio input-user" id="group-domicilio">
                <label for="">Domicilio</label>
                <input type="text" name="domicilio" id="domicilio" class="input" placeholder="Introduce tu telefono">
                <p class="input-error">*El nombre no debe quedar vacío, puede tener letras y acentos.</p>
              </div>
              <div class="input-user-rol input-user">
                <label for="">Sucursal:</label>
                <select name="id_sucursal" id="id_sucursal" class="select-user-rol">
                  <!-- <option value="1">Administrador</option> -->
                  <!-- <option value="2">Vendedor</option> -->
                  <?php
                  $sucursal = $query->idSucursal(); // Hacer consulta para leer los tipos de negocios.

                  foreach ($sucursal as $row) {
                  ?>
                    <option value="<?php echo $row['id_sucursal']; ?>" ><?php echo $row['nombre']; ?></option>
                  <?php
                  }
                  ?>

                </select>
              </div>
              <div class="input-user-rol input-user">
                <label for="">Caja:</label>
                <select name="id_caja" id="id_caja" class="select-user-rol">
                  <?php
                  $caja = $query->idCaja(); // Hacer consulta para leer los tipos de negocios.

                  foreach ($caja as $row) {
                  ?>
                    <option value="<?php echo $row['id_caja']; ?>" ><?php echo $row['caja']; ?></option>
                  <?php
                  }
                  ?>
                </select>
              </div>
              <div class="input-user-rol input-user">
                <label for="">Rol:</label>
                <select name="id_rol" id="id_rol" class="select-user-rol">
                  <!-- <option value="1">Administrador</option> -->
                  <?php
                  $rol = $query->idRol(); // Hacer consulta para leer los tipos de negocios.

                  foreach ($rol as $row) {
                  ?>
                    <option value="<?php echo $row['id_rol']; ?>" ><?php echo $row['rol']; ?></option>
                  <?php
                  }
                  ?>
                </select>
              </div>
              <div class="input-user-pass input-user" id="group-pass">
                <label for="">Contraseña</label>
                <input type="password" name="pass" id="pass" class="input" placeholder="Introduce tu contraseña">
                <p class="input-error">*El nombre no debe quedar vacío, Minimo 5 caracteres</p>
              </div>
              <!-- <hr> -->
              <br>
              <div class="input-submit modal-footer">
                <button type="button" class="btn-close-modal" data-bs-dismiss="modal">Cerrar</button>
                <input type="submit" class="btn-cfg" value="Agregar" id="btn-send">
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
    $edit = $query->editPersonal($editPer);
    foreach($edit as $row){
    $id_user = $row['id_personal'];
    $nombre = $row['nombre'];
    $correo = $row['correo'];
    $telefono = $row['telefono'];
    $ciudad = $row['ciudad'];
    $domicilio = $row['domicilio'];
    $id_sucursal = $row['id_sucursal'];
    $id_caja = $row['id_caja'];

    }
  ?>
<div class="modal fade" id="modPer" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Editar usuario</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="permisos">
                <form class="form-user" id="formularioEdit" method="POST" action="logic/updateData.php">
              <input type="hidden" name="table" id="action_per" value="editarPersonal">
              <input type="hidden" name="id_personal" id="id_personal" value="<?php echo $id_user; ?>">
              <div class="input-user-name input-user" id="group-nombre">
                <label for="">Nombre: </label>
                <input type="text" class="input" name="nombre" id="nombre" value="<?php echo $nombre; ?>">
                <p class="input-error">*El nombre no debe quedar vacío, puede tener letras y acentos.</p>
              </div>
              <div class="input-user-email input-user" id="group-correo">
                <label for="">Correo</label>
                <input type="email" name="correo" id="correo" class="input" value="<?php echo $correo; ?>">
                <p class="input-error">*Este campo debe ser un tipo de E-mail valido.</p>
              </div>
              <div class="input-user-tel input-user" id="group-telefono">
                <label for="">Teléfono</label>
                <input type="number_format" name="telefono" id="telefono" class="input" value="<?php echo $telefono; ?>">
                <p class="input-error">*Este campo debe ser númerico y tener 10 caracteres.</p>
              </div>
              <div class="input-user-ciudad input-user" id="group-ciudad">
                <label for="">Ciudad</label>
                <input type="text" name="ciudad" id="ciudad" class="input" value="<?php echo $ciudad; ?>">
                <p class="input-error">*El nombre no debe quedar vacío, puede tener letras y acentos.</p>
              </div>
              <div class="input-user-domicilio input-user" id="group-domicilio">
                <label for="">Domicilio</label>
                <input type="text" name="domicilio" id="domicilio" class="input" value="<?php echo $domicilio; ?>">
                <p class="input-error">*El nombre no debe quedar vacío, puede tener letras y acentos.</p>
              </div>
              <div class="input-user-rol input-user" id="group-sucursal">
                <label for="">Sucursal</label>
                <select name="id_sucursal" id="id_sucursal" class="select-user-rol">
                  <!-- <option value="1">Administrador</option> -->
                  <!-- <option value="2">Vendedor</option> -->
                  <?php
                  $sucursal = $query->idSucursal(); // Hacer consulta para leer los tipos de negocios.

                  foreach ($sucursal as $tipo) {
                  ?>
                    <option value="<?php echo $tipo['id_sucursal']; ?>"selected><?php echo $tipo['alias_sucursal']; ?></option>
                  <?php
                  }
                  ?>

                </select>
                <!-- <input type="text" name="id_sucursal" id="id_sucursal" class="input" value="<?php echo $id_sucursal; ?>"> -->
              </div>
              <div class="input-user-rol input-user" id="group-caja">
                <label for="">Caja</label>
                <!-- <input type="text" name="id_caja" id="id_caja" class="input" value="<?php echo $id_caja; ?>"> -->
                <select name="id_caja" id="id_rol" class="select-user-rol">
                  <!-- <option value="1">Administrador</option> -->
                  <!-- <option value="2">Vendedor</option> -->
                  <?php
                  $caja = $query->idCaja(); // Hacer consulta para leer los tipos de negocios.

                  foreach ($caja as $tipo) {
                  ?>
                    <option value="<?php echo $tipo['id_caja']; ?>" selected><?php echo $tipo['caja']; ?></option>
                  <?php
                  }
                  ?>
                </select>
              </div>
              <div class="input-user-rol input-user">
                <label for="">Seleccione el Rol:</label>
                <select name="id_rol" id="id_rol" class="select-user-rol">
                  <?php
                  $rol = $query->idRol(); // Hacer consulta para leer los tipos de negocios.

                  foreach ($rol as $row) {
                  ?>
                    <option value="<?php echo $row['id_rol']; ?>" selected><?php echo $row['rol']; ?></option>
                  <?php
                  }
                  ?>
                </select>
              </div>
              <div class="input-user-pass input-user" id="group-pass">
                <label for="">Contraseña</label>
                <input type="password" name="pass" id="pass" class="input">
                <p class="input-error">*El nombre no debe quedar vacío, Minimo 5 caracteres</p>
              </div>
              <!-- <hr> -->
              <br>
              <div class="input-submit modal-footer">
                <button type="button" class="btn-close-modal" data-bs-dismiss="modal">Cerrar</button>
                <input type="submit" class="btn-cfg" value="Agregar" id="btn-send">
              </div>
            </form>
            </div>
            <br>
        </div>
    </div>
  </div>
</div>

<!-- Información -->
  <?php
  $result = $query->selectInfoPer(); //Mostramos los resultados

  foreach ($result as $row) {
    $id_user = $row['id_personal'];
    $nombre = $row['nombre'];
    $correo = $row['correo'];
    $telefono = $row['telefono'];
    $ciudad = $row['ciudad'];
    $domicilio = $row['domicilio'];
    $id_sucursal = $row['id_sucursal'];
    $id_caja = $row['id_caja'];     
    $id_rol = $row['id_rol'];     
  ?>


  <div class="modal fade modal-lg  modal-dialog-scrollable" id="static<?php echo $row['id_personal'] ?>">
  <div class="modal-dialog">
    <div class="borde modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLabel">Información del Provedor🧾</h3>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <article class="ticket">
  <header class="ticket__wrapper">
    <div class="ticket__header">
    
    </div>
  </header>
  <div class="ticket__divider">
    <div class="ticket__notch"></div>
    <div class="ticket__notch ticket__notch--right"></div>
  </div>
  <div class="ticket__body">
    <section class="ticket__section">
      <h4>Nombre</h4>
      <?php echo $nombre ?>
    </section>
    <section class="ticket__section">
      <h4>Correo</h4>
      <?php echo $correo ?>
    </section>
    <section class="ticket__section">
      <h4>Telefono</h4>
      <?php echo $telefono ?>
    </section>
    <section class="ticket__section">
      <h4>Ciudad</h4>
      <?php echo $ciudad ?>
    </section>
    <section class="ticket__section">
    <h4>Domicilio</h4>
    <?php echo $domicilio ?>
    </section>
    <section class="ticket__section">
    <h4>Sucursal</h4>
    <?php echo $id_sucursal ?>
    </section>
    <section class="ticket__section">
    <h4>Caja</h4>
    <?php echo $id_caja ?>
    </section>
    <section class="ticket__section">
    <h4>Rol</h4>
    <?php echo $id_rol ?>
    </section>
  </div>
</article>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn1" data-bs-dismiss="modal">Cerrar</button>
        <a href="pdf/per_pdf.php" target="_blank"><button type="button" class="btn btn2">Imprimir</button></a>
      </div>
    </div>
  </div>
</div>
<?php
}
  ?>



<script src="../assets/js/personal.js" type="module"></script>
<script>
    let addPer = localStorage.getItem("addPer");
    let modPer = localStorage.getItem("modPer");
    let deletPer = localStorage.getItem("deletPer");

    if(addPer === "true"){
      Swal.fire({
            title: "Personal agregado",
            text: "El personal se ha agregado correctamente",
            icon: "success",//error, 
            timer: 3000,
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            confirmButtonColor: '#47874a',
        });
    } 
    setTimeout(function(){
        localStorage.removeItem("addPer");
    }, 1500);
    if(modPer === "true"){
      Swal.fire({
            title: "Personal moditicado",
            text: "La información del personal ha sido modificado",
            icon: "success",//error, 
            timer: 3000,
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            confirmButtonColor: '#47874a',
        });
    } 
    setTimeout(function(){
        localStorage.removeItem("modPer");
    }, 1500);

        if (deletPer === "true") {
      Swal.fire({
        title: "Personal eliminado correctamente",
        text: "La información del personal ha sido eliminado",
        icon: "success", //error, 
        timer: 3000,
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        confirmButtonColor: '#47874a',
      });
    }
    setTimeout(function() {
      localStorage.removeItem("deletPer");
    }, 1500);

</script>
