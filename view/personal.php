<?php
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
            <div class="product-chart">
                <a href="" class="btn-prm btn-cancelar" data-bs-toggle="modal" data-bs-target=".agregarPersonal"><i class="fa-solid fa-plus fa-lg"></i> Agregar</a>
            </div>
        </div>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
          <?php
          $result1 = $query->selectTable('personal');
            foreach ($result1 as $row) {
          ?>
            <div class="col-lg-4">
              <div class="profile-card-4 z-depth-3">
                <div class="card margen">
                  <div class="card-body1 text-center">
                    <div class="user-box">
                      <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="user avatar">
                    </div>
                    <h5 class="text-white"><?php echo $row['nombre']; ?></h5>
                  </div>
                  <div class="card-body">
                    <ul class="list-group shadow-none">
                      <li class="list-group-item">
                        <div class="list-icon">
                          <i class="fa fa-phone-square">
                          </i>
                        </div>
                        <div class="list-details">
                          <?php echo ($row['telefono'] == NULL) ? "<b>Sin telefono</b>" : $row['telefono']; ?>
                          <small>Número de Teléfono</small>
                        </div>
                      </li>
                      <li class="list-group-item">
                          <div class="list-icon">
                            <i class="fa fa-envelope"></i>
                          </div>
                          <div class="list-details">
                            <?php echo ($row['correo'] == NULL) ? "<b>Sin Correo</b>" : $row['correo']; ?>
                            <small>Correo Electronico</small>
                          </div>
                        </li>
                        <li class="list-group-item">
                          <div class="list-icon">
                          <i class="fa-sharp fa-solid fa-user-tie"></i>
                          </div>
                          <div class="list-details">
                            <?php
                            $rol = $query->readFieldSelected($row['id_rol'], 'rol', 'id_rol', 'rol');
                            if($rol) $userRol = $rol->fetch()['rol'];
                            ?>
                            <span><?php echo $userRol; ?></span>
                            <small>Rol</small>
                          </div>
                        </li>
                    </ul>
                    <div class="row text-center mt-2">
                      <div class="col p-2">
                        <a href="index.php?p=personal&delete=<?php echo $row['id_personal']; ?>" class="btn-tb-delete"><i class="fa-solid fa-trash-can"></i></a>
                      </div>
                      <div class="col p-2">
                        <a href="index.php?p=personal&edit=<?php echo $row['id_personal']; ?>" class="btn-tb-update"><i class="fa-solid fa-pen"></i></a>
                      </div>
                      <div class="col p-2 btn-tb-info">
                        <a href="" data-bs-toggle="modal" data-bs-target="#static<?php echo $row['id_personal'] ?>" class="btn-tb-info"><i class="fa-solid fa-circle-info"></i></a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          <?php
            }
          ?>

        </div>
    </section>

    <!-- AGREGAR -->
<div class="modal fade agregarPersonal " tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-xl" id="seccion-modal">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Agregar personal nuevo</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            <button type="button" class="btn-fullscreen fullscreen-no" id="btn-fullscreen"><i class="fa-solid fa-up-right-and-down-left-from-center"></i></button> <!-- fullscreeen-modal.js|  COPIAR Y PEGAR ESTE BOTON -->
        </div>
        <div class="modal-body">
            <div class="permisos">
                <form class="form-user" id="formulario" method="POST" action="logic/createData.php">
              <input type="hidden" name="table" id="action_per" value="agregarPersonal">
              <div class="input-user-name input-user" id="group-nombre">
                <label for="">Nombre</label>
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
              <div class="input-user-tel input-user" id="group-domicilio">
                <label for="">Domicilio</label>
                <input type="text" name="domicilio" id="domicilio" class="input" placeholder="Introduce tu domicilio">
                <p class="input-error">*El nombre no debe quedar vacío, puede tener letras y acentos.</p>
              </div>
              <div class="input-user-tel input-user" id="group-ciudad">
                <label for="">Ciudad</label>
                <input type="text" name="ciudad" id="ciudad" class="input" placeholder="Introduce tu ciudad">
                <p class="input-error">*El nombre no debe quedar vacío, puede tener letras y acentos.</p>
              </div>
              <div class="input-user-rol input-user">
                <label for="">Sucursal</label>
                <select name="id_sucursal" id="id_sucursal" class="select-user-rol">
                  <?php
                  $sucursal = $query->selectTable('sucursal'); // Hacer consulta para leer los tipos de negocios.

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
                  $caja = $query->selectTable('caja'); // Hacer consulta para leer los tipos de negocios.
                  foreach ($caja as $row) {
                  ?>
                    <option value="<?php echo $row['id_caja']; ?>" >Caja <?php echo $row['caja']; ?></option>
                  <?php
                  }
                  ?>
                </select>
              </div>
              <div class="input-user-rol input-user">
                <label for="">Rol</label>
                <select name="id_rol" id="id_rol" class="select-user-rol">
                  <?php
                  $rol = $query->selectTable('rol'); // Hacer consulta para leer los tipos de negocios.
                  foreach ($rol as $row) {
                  ?>
                    <option value="<?php echo $row['id_rol']; ?>" ><?php echo $row['rol']; ?></option>
                  <?php
                  }
                  ?>
                </select>
              </div>
              <div class="input-user-name input-user password-field" id="group-pass">
                <label for="">Contraseña</label>
                <input type="password" name="pass" id="pass" class="input" placeholder="Introduce tu contraseña">
                <span><i id="togg" class="far fa-eye"></i></span>
                <p class="input-error">*El nombre no debe quedar vacío, Minimo 5 caracteres</p>
              </div>
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
    $id_rol = $row['id_rol'];
    }
  ?>
<div class="modal fade" id="modPer" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Editar personal</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="permisos">
                <form class="form-user" id="formularioEdit" method="POST" action="logic/updateData.php">
              <input type="hidden" name="table" id="action_per" value="editarPersonal">
              <input type="hidden" name="id_personal" id="id_personal" value="<?php echo $id_user; ?>">
              <div class="input-user-name input-user" id="group-nombre">
                <label for="">Nombre </label>
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
              <div class="input-user-name input-user" id="group-ciudad">
                <label for="">Ciudad</label>
                <input type="text" name="ciudad" id="ciudad" class="input" value="<?php echo $ciudad; ?>">
                <p class="input-error">*El nombre no debe quedar vacío, puede tener letras y acentos.</p>
              </div>
              <div class="input-user-name input-user" id="group-domicilio">
                <label for="">Domicilio</label>
                <input type="text" name="domicilio" id="domicilio" class="input" value="<?php echo $domicilio; ?>">
                <p class="input-error">*El nombre no debe quedar vacío, puede tener letras y acentos.</p>
              </div>
              <div class="input-user-rol input-user" id="group-sucursal">
                <label for="">Sucursal</label>
                <select name="id_sucursal" id="id_sucursal" class="select-user-rol">
                  <?php
                    $readSucursalSelected = $query->readFieldSelected($id_sucursal, 'sucursal', 'id_sucursal', 'nombre');
                    $resS = $readSucursalSelected->fetch();

                    $sucursales = $query->readFieldNoSelected($id_sucursal, 'sucursal', 'id_sucursal');
                  ?>
                    <option value="<?php echo $resS['id_sucursal']; ?>" selected><?php echo $resS['nombre']; ?></option>
                  <?php
                    if($sucursales->rowCount() > 0){
                      foreach ($sucursales as $s) {
                        ?><option value="<?php echo $s['id_sucursal']; ?>" ><?php echo $s['nombre']; ?></option><?php
                      } 
                    }
                  ?>
                </select>
              </div>
              <div class="input-user-rol input-user" id="group-caja">
                <label for="">Caja</label>
                <select name="id_caja" id="id_rol" class="select-user-rol">
                  <?php
                    $readCajaSelected = $query->readFieldSelected($id_caja, 'caja', 'id_caja', 'caja');
                    $resC = $readCajaSelected->fetch();

                    $cajas = $query->readFieldNoSelected($id_caja, 'caja', 'id_caja');
                  ?>
                    <option value="<?php echo $resC['id_caja']; ?>" selected> Caja <?php echo $resC['caja']; ?></option>
                  <?php
                    if($cajas->rowCount() > 0){
                      foreach ($cajas as $c) {
                        ?><option value="<?php echo $c['id_caja']; ?>" >Caja <?php echo $c['caja']; ?></option><?php
                      } 
                    }
                  ?>
                </select>
              </div>
              <div class="input-user-rol input-user">
                <label for="">Rol</label>
                <select name="id_rol" id="id_rol" class="select-user-rol">
                  <?php
                    $readRolSelected = $query->readFieldSelected($id_rol, 'rol', 'id_rol', 'rol');
                    $resR = $readRolSelected->fetch();

                    $roles = $query->readFieldNoSelected($id_rol, 'rol', 'id_rol');
                  ?>
                    <option value="<?php echo $resR['id_rol']; ?>" selected><?php echo $resR['rol']; ?></option>
                  <?php
                    foreach ($roles as $rol) {
                      ?><option value="<?php echo $rol['id_rol']; ?>" ><?php echo $rol['rol']; ?></option><?php
                    } 
                  ?>
                </select>
              </div>
              <br>
              <div class="input-submit modal-footer">
                <button type="button" class="btn-close-modal" data-bs-dismiss="modal"><i class="fa-solid fa-xmark fa-lg"></i> Cerrar</button>
                <button type="submit" class="btn-cfg" id="btn-send"><i class="fa-solid fa-plus fa-lg"></i> Actualizar</button>
                <!-- <input type="submit" class="btn-cfg" value="Agregar" id="btn-send"> -->
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


  <div class="modal fade  modal-dialog-scrollable" id="static<?php echo $row['id_personal'] ?>">
  <div class="modal-dialog">
    <div class="borde modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLabel">Información del Personal🧾</h3>
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
                      <h5>Correo: <?php echo $correo ?></h5>
                  </section>
                  <section class="ticket__section">
                      <h5>Teléfono: <?php echo $telefono ?></h5>
                  </section>
                  <section class="ticket__section">
                      <h5>Ciudad:   <?php echo $ciudad ?></h5>
                  </section>
                  <section class="ticket__section">
                      <h5>Domicilio:  <?php echo $domicilio ?></h5>
                  </section>
                  <section class="ticket__section">
                      <h5>Sucursal:   <?php echo $id_sucursal ?></h5>
                  </section>
                  <section class="ticket__section">
                      <h5>Caja:   <?php echo $id_caja ?></h5>
                  </section>
                  <section class="ticket__section">
                      <h5>Rol:  <?php echo $id_rol ?></h5>
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