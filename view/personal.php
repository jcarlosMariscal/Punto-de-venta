<?php
  $deletePer = (isset($_GET['delete']) ? $_GET['delete'] : NULL);
  $editPer = (isset($_GET['edit']) ? $_GET['edit'] : NULL);
    $readNegocio = $query->readNegocio($_SESSION['user']['id_negocio']); 
  
  foreach($readNegocio as $row){
    $logoNegocio = $row['logo'];
    $nombreNegocio = $row['nombre'];
  }

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
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3 mt-1">
          <?php
          if($_SESSION['rol'] == 0){
            $getAdmin = $query->selectTable('administrador');
            foreach ($getAdmin as $get) {
          ?>
            <div class="col-lg-4">
              <div class="profile-card-4 z-depth-3">
                <div class="card margen">
                  <div class="card-body1 text-center">
                    <div class="user-box">
                      <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="user avatar">
                    </div>
                    <h5 class="text-white"><?php echo $get['nombre']; ?></h5>
                  </div>
                  <div class="card-body">
                    <ul class="list-group shadow-none">
                      <li class="list-group-item">
                        <div class="list-icon">
                          <i class="fa fa-phone-square">
                          </i>
                        </div>
                        <div class="list-details">
                          <?php echo ($get['telefono'] == NULL) ? "<b>Sin telefono</b>" : $get['telefono']; ?>
                          <small>Número de Teléfono</small>
                        </div>
                      </li>
                      <li class="list-group-item">
                          <div class="list-icon">
                            <i class="fa fa-envelope"></i>
                          </div>
                          <div class="list-details">
                            <?php echo ($get['correo'] == NULL) ? "<b>Sin Correo</b>" : $get['correo']; ?>
                            <small>Correo Electronico</small>
                          </div>
                        </li>
                        <li class="list-group-item">
                          <div class="list-icon">
                          <i class="fa-sharp fa-solid fa-user-tie"></i>
                          </div>
                          <div class="list-details">
                            <span>Administrador</span>
                            <small>Rol</small>
                          </div>
                        </li>
                    </ul>
                    <div class="row text-center mt-2">
                      <div class="col p-2">
                        <a href="#" data-bs-toggle="modal" data-bs-target="#adminEdit" class="btn-tb-update"><i class="fa-solid fa-pen"></i></a>
                      </div>
                      <div class="col p-2 btn-tb-info">
                        <a href="" data-bs-toggle="modal" data-bs-target="#adminInfo" class="btn-tb-info"><i class="fa-solid fa-circle-info"></i></a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          <?php
            }
          }
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
    // $telefono = $telefono || 0;
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
    <!-- EDITAR ADMIN -->
  <?php
    $editAdmin = $query->selectTableId("administrador", "id_admin",$_SESSION['user']['id_user'], "nombre, correo, telefono");
    foreach($editAdmin as $row){
    $nombre = $row['nombre'];
    $correo = $row['correo'];
    $telefono = $row['telefono'];
    }
  ?>
<div class="modal fade" id="adminEdit" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Editar Administrador</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="permisos">
                <form class="form-user" id="formularioEdit" method="POST" action="logic/updateData.php">
              <input type="hidden" name="table" id="action_per" value="editarAdmin">
              <input type="hidden" name="id_admin" id="id_admin" value="<?php echo $_SESSION['user']['id_user']; ?>">
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

<!-- INFORMACIÓN ADMIN -->
  <div class="modal fade" id="adminInfo">
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
          <p class="fech">Fecha: <?php echo date("d/m/y"); ?></p>
          <p class="title-subsp">Datos de Administraodr</p>
          <p>
            El presente documento muestra la infomación del administrador <span class="remarc"><?php echo $nombre ?></span> quien se encarga de gestionar el negocio <span class="remarc"><?php echo $nombreNegocio; ?></span>, así como las sucursales de la misma, el número de contacto registrado en la base de datos es <span class="remarc"><?php echo $telefono;?></span> y el correo es <span class="remarc"><?php echo $correo; ?></span>
          </p>
        </div>
        <address>
          <p>Documento Generado por: <span class="remarca">Easy Sale</span></p>
          <p>Teléfono de <?php echo $nombreNegocio; ?>: <span class="remarca"><?php echo $telefonoNegocio; ?></span></p>
          <p class="correoinfo"><span class="remarca"><?php echo $correoNegocio; ?></span></p>
        </address>
      </article>
      </div>
        <div class="modal-footer">
          <button type="button" class="btn-close-modal" data-bs-dismiss="modal">Cerrar</button>
          <button type="button" class="btn-save-modal" id="descargarReporte">Descargar</button>
        </div>
      </div>
    </div>
  </div>

<!-- Información -->
  <?php
  $result = $query->selectTable('personal'); //Mostramos los resultados
  date_default_timezone_set('America/Mexico_City');

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
    
    $nameSucursal = $query->selectTableId('sucursal', 'id_sucursal',$id_sucursal, 'nombre');
    $getName = $nameSucursal->fetch(); // Obtener el registro de la consulta
  ?>


  <div class="modal fade" id="static<?php echo $row['id_personal'] ?>">
    <div class="modal-dialog modal-fullscreen-xxl-down">
      <div class="borde modal-content">
        <div class="modal-header">
          <h3 class="modal-title" id="exampleModalLabel">Información del Personal🧾</h3>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <article id="ticket">
        <div class="contenedor-head">
          <img src="../assets/img/logo/<?php echo $logoNegocio; ?>" class="ticon" alt="">
          <p class="title-princ"><span>Nova Tech</span></p>
          <p class="title-subp"><span>Easy Sal</span></p>
          <p class="fech">Fecha: <?php echo date("d/m/y"); ?></p>
          <p class="title-subsp">Datos de personal</p>
          <p>
            El presente documento muestra la infomación del personal <span class="remarc"><?php echo $nombre ?></span>
            que labora en el negocio <span class="remarc"><?php echo $nombreNegocio; ?></span>, desempeñandose bajo el rol de <span class="remarc"><?php echo ($id_rol == 1) ? "Gerente": "Vendedor";?></span>
            en la sucursal <span class="remarc"><?php echo $getName['nombre']; ?></span> siendo sus principales actividades las siguientes:
          </p>
          <ul>
            <li>Registrar la venta de productos</li>
            <li>Realizar su corte de caja</li>
            <li>Realizar reportes</li>
          </ul>
          <p>
            <span>En caso de requerir la corrección de algún dato dirigirse al gerente/encargado de la
              suscursal donde labora o comunicarse a los datos de contacto de la sucursal.
            </span>
          </p>
          <p class="infp">
            <span>Información de Personal y datos de contacto</span>
          </p>
          <div class="contact">
            <p class="nomper"><?php echo $nombre ?></p>
            <p class="correoper"><?php echo $correo ?></p>
            <p class="nomper1">Nombre y apellido</p>
            <p class="correoper1">Correo de personal</p>
          </div>
          <div class="contact1">
            <p class="telefinf"><?php echo $telefono ?></p>
            <p class="direcinf"><?php echo $ciudad.", ".$domicilio; ?></p>
            <p class="telefinf1">Teléfono de Personal</p>
            <p class="direcinf1">Dirección de personal</p>
          </div>
          <p class="infp1">
            <span>Información de lugar de trabajo</span>
          </p>
          <?php
          $selectSucursal = $query->selectTableId("sucursal", "id_sucursal", $id_sucursal, "*");
          foreach($selectSucursal as $s){
            ?>
            <div class="contactsucur">
              <p class="nomper"><?php echo $s['nombre']; ?></p>
              <p class="correoper"><?php echo $correo; ?></p>
              <p class="nomper1">Nombre Sucursal</p>
              <p class="correoper1">Correo de Sucursal</p>
            </div>
            <div class="contactsucur1">
              <p class="direcinf"><?php echo $s['estado']." ".$s['ciudad']." ".$s['colonia']." ".$s['direccion']?></p>
              <p class="direcinf1">Ubicada en</p>
              <p class="cpinf"><?php echo $s['codigo_postal']; ?></p>
              <p class="cpinf1">Código Postal</p>
            </div>
            <div class="contactsucur2">
              <p class="telinf"><?php echo $s['telefono']; ?></p>
              <p class="telinf1">Teléfono</p>
            </div>
            <?php
          }
          ?>
        </div>
        <address>
          <p>Documento Generado por: <span class="remarca">Easy Sale</span></p>
          <p>Teléfono de <?php echo $nombreNegocio; ?>: <span class="remarca"><?php echo $telefonoNegocio; ?></span></p>
          <p class="correoinfo"><span class="remarca"><?php echo $correoNegocio; ?></span></p>
        </address>
      </article>
      </div>
        <div class="modal-footer">
          <button type="button" class="btn-close-modal" data-bs-dismiss="modal">Cerrar</button>
          <button type="button" class="btn-save-modal" id="descargarReporte">Descargar</button>
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
    let modAdmin = localStorage.getItem("modAdmin");
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
    if(modAdmin === "true"){
      Swal.fire({
            title: "Administrador moditicado",
            text: "Los datos del administrador han sido actualizados",
            icon: "success",//error, 
            timer: 3000,
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            confirmButtonColor: '#47874a',
        });
    } 
    setTimeout(function(){
        localStorage.removeItem("modAdmin");
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
    const descargarReporte = document.getElementById("descargarReporte");
    descargarReporte.addEventListener("click", (e) => {
      // alert("m");
      // e.preventDefault();
      console.log("click");
          const element = document.getElementById("ticket");
          html2pdf()
            .set({
              margin: 1,
              filename: "prueba.pdf",
              image: {
                type: "jpeg",
                quality: 0.98,
              },
              html2canvas: {
                scale: 3,
                letterRendering: true,
              },
              jsPDF: {
                unit: "in",
                format: "a3",
              },
            })
            .from(element)
            .save()
            .catch((err) => console);
        });

</script>  
