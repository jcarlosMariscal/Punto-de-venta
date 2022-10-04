<?php
  require_once "config/Connection.php";
  require_once "logic/Read.php";
  $query = new Read();

  $readNegocio = $query->readNegocio($_SESSION['id_negocio']); // Hacer una consulta a tabla negocios
  $resNegocio = $readNegocio->fetch(); // Obtener el registro de la consulta
  $readTipo = $query->readTipo(); // Hacer consulta para leer los tipos de negocios.
  $readTipoSelected = $query->readTipoSelected($resNegocio['id_tipo']); // Obtner el tipo de negocio actual

  $buscarDatosFiscales = $query->buscarDatosFiscales($_SESSION['id_negocio']);
  $obtenerDatosFiscales = $query->obtenerDatosFiscales($_SESSION['id_negocio']);
  $resDatosFiscales = $obtenerDatosFiscales->fetch();
  // require_once "../template/header.php";
?>

<section class="content">
    <div class="config">
        <div class="config__form">
            <h4>Datos generales del negocio</h4>
            <form action="logic/updateData.php" method="POST" class="form" enctype="multipart/form-data" id="formulario">
                <div class="form-inputs">
                  <input type="hidden" name="table" value="updateNegocio">
                  <input type="hidden" name="id_negocio" value="<?php echo $_SESSION['id_negocio']; ?>">
                    <div class="input-nombre input-cfg" id="group-nombre">
                        <label for="" class="label">Nombre:</label>
                        <input type="text" class="input input-config" value="<?php echo $resNegocio['nombre']; ?>" name="nombre" id="nombre" >
                        <p class="input-error">*Rellena el este campo correctamente por favor</p>
                    </div>
                    <div class="input-tipo input-cfg" id="group-tipo">
                        <label for="" class="label">Tipo: </label>
                        <select name="tipo" id="tipo">
                          <?php
                          $res = $readTipoSelected->fetch();
                          ?>
                          <option value="<?php echo $res['id_tipo']; ?>" selected><?php echo $res['tipo']; ?></option>
                          <?php
                            foreach ($readTipo as $tipo) {
                              if($tipo['id_tipo'] != $resNegocio['id_tipo']){
                                ?><option value="<?php echo $tipo['id_tipo']; ?>" ><?php echo $tipo['tipo']; ?></option><?php
                              }
                            } 
                          ?>
                        </select>
                    </div>
                    <div class="input-telefono input-cfg" id="group-telefono">
                        <label for="" class="label">Teléfono: </label>
                        <input type="text" class="input input-config" value="<?php echo $resNegocio['telefono']; ?>" name="telefono" id="telefono" >
                        <p class="input-error">*Introduce una teléfono correcto</p>
                    </div>
                    <div class="input-correo input-cfg" id="group-correo">
                        <label for="" class="label">Correo: </label>
                        <input type="text" class="input input-config" value="<?php echo $resNegocio['correo']; ?>" name="correo" id="correo" >
                        <p class="input-error">*Este campo debe ser correo.</p>
                    </div>
                </div>
                <div class="form-logo">
                    <div class="logo-current">
                        <img class="currently" id="img-logo" src="<?php echo '../assets/img/logo/'.$logo; ?>" alt="">
                    </div>
                    <div class="custom-input-file col-md-6 col-sm-6 col-xs-6">
                        <input type="file" name="logo" id="myFile" class="input-file" value="">
                        Sube tu Logo
                    </div>
                </div>
                <div class="input-submit">
                    <input type="submit" class="btn-cfg" value="Guardar Cambios" name="Guardar" id="btn-send">
                </div>
            </form>
        </div>
        <hr>
        <div class="config__permissions">
            <div class="permissions-admin">
                <a  href="#" class="btn-prm" style="display: none" data-toggle="modal" data-target=".bd-example-modal-lg">Revisar Permisos</a>
            </div>
            <div class="permissions-seller">
                <a href="#" class="btn-prm" data-toggle="modal" data-target=".datos_fiscales">Datos Fiscales</a>
            </div>
            <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Permisos de Administrador</h5>
                            <span data-dismiss="modal" aria-label="Close" class="close"><i class="fa-solid fa-xmark"></i></span>
                        </div>
                        <div class="modal-body">
                            <div class="permisos">
                                <form action="" class="form-permisos">
                                    <div class="check">                                       
                                        <input type="checkbox" name="" id="">
                                        <label for="">Ventas</label>
                                    </div>
                                    <div class="check">                                       
                                        <input type="checkbox" name="" id="">
                                        <label for="">Compras</label>
                                    </div>
                                    <div class="check">                                       
                                        <input type="checkbox" name="" id="">
                                        <label for="">Productos</label>
                                    </div>
                                    <div class="check">                                       
                                        <input type="checkbox" name="" id="">
                                        <label for="">Proveedores</label>
                                    </div>
                                    <div class="check">                                       
                                        <input type="checkbox" name="" id="">
                                        <label for="">Mi Personal</label>
                                    </div>
                                    <div class="check">                                       
                                        <input type="checkbox" name="" id="">
                                        <label for="">Configuración</label>
                                    </div>
                                    <div class="check">                                       
                                        <input type="checkbox" name="" id="">
                                        <label for="">Agregar registros</label>
                                    </div>
                                    <div class="check">                                       
                                        <input type="checkbox" name="" id="">
                                        <label for="">Modificar registros</label>
                                    </div>
                                    <div class="check">                                       
                                        <input type="checkbox" name="" id="">
                                        <label for="">Eliminar Registros</label>
                                    </div>
                                    <div class="check">                                       
                                        <input type="checkbox" name="" id="">
                                        <label for="">Configuración</label>
                                    </div>
                                    <div class="check">                                       
                                        <input type="checkbox" name="" id="">
                                        <label for="">Notificaciones de inventario</label>
                                    </div>
                                    <div class="check">                                       
                                        <input type="checkbox" name="" id="">
                                        <label for="">Crear Respaldos</label>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn-close-modal" data-dismiss="modal">Cerrar</button>
                            <button type="button" class="btn-save-modal">Guardar Cambios</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="modales">
  <div class="modal fade datos_fiscales" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Datos Fiscales</h5>
            <span data-dismiss="modal" aria-label="Close" class="close"><i class="fa-solid fa-xmark"></i></span>
        </div>
        <div class="modal-body">
          <div class="datos_fiscales">
            <?php
              if($buscarDatosFiscales[0]){
                if($buscarDatosFiscales[1] == 1){
                  ?>
                  <form class="form-user" id="formulario" method="POST" action="logic/updateData.php">
                    <input type="hidden" name="table" id="table" value="datos_fiscales">
                    <input type="hidden" name="id_negocio" id="id_negocio" value="<?php echo $_SESSION['id_negocio']; ?>">
                    <input type="hidden" name="id_datos" id="id_datos" value="<?php echo $resDatosFiscales['id_datos']; ?>">
                      <div class="input-nombre input-user" id="group-nombre">                                       
                        <label for="">Nombre: </label>
                        <input type="text" class="input" name="nombre" id="nombre" value="<?php echo $resDatosFiscales['nombre']; ?>">
                        <p class="input-error">* Rellena</p>
                      </div>
                      <div class="input-rfc input-user" id="group-rfc">                                       
                        <label for="">R.F.C: </label>
                        <input type="text" class="input" name="rfc" id="rfc" value="<?php echo $resDatosFiscales['rfc']; ?>">
                        <p class="input-error">* Rellena</p>
                      </div>
                      <div class="input-regimen input-user" id="group-regimen">                                       
                        <label for="">R. Fiscal: </label>
                        <input type="text" class="input" name="regimen" id="regimen" value="<?php echo $resDatosFiscales['rFiscal']; ?>">
                        <p class="input-error">* Rellena</p>
                      </div>
                      <br>
                      <div class="input-submit modal-footer">
                        <button type="button" class="btn-close-modal" data-dismiss="modal">Cerrar</button>
                        <input type="submit" class="btn-cfg" value="Actualizar" id="btn-send">
                      </div>
                    </form>
                  <?php
                }else {
                  ?>
                  <h5 id="noDatosFiscales">No hay Datos Fiscales registrados para <?php echo $resNegocio['nombre']; ?> <span hidden id="id_negocio"><?php echo $_SESSION['id_negocio']; ?></span></h5>
                  <button type="button" class="btn-cfg" id="registrarDF">Registrar</button>
                  <div id="formDF"></div>
                  <div class="modal-footer" id="modal-footerNoDatos">
                      <button type="button" class="btn-close-modal" data-dismiss="modal">Cerrar</button>
                      <!-- <input type="submit" class="btn-cfg" value="Agregar" id="btn-send"> -->
                    </div>
                 <?php  
                }
              }
            ?>
          </div>
        </div>
    </div>
  </div>
</div>
</section>




<script src="../assets/js/configuration.js" type="module"></script>

<script>
    let configuration = localStorage.getItem("configuration");
    console.log(configuration);
    if(configuration == "actualizado") console.log("hola");
    switch (configuration) {
      case 'actualizado': 
        Swal.fire({
          title: "<b>SISTEMA <?php echo $resNegocio['nombre']; ?></b>",
          text: "La información de su negocio ha sido actualizada",
          icon: "success",//error, 
          timer: 3000,
          toast: true,
          position: 'top-end',
          showConfirmButton: false,
          confirmButtonColor: '#47874a',
        });
        break;
      case 'error': 
        Swal.fire({
          title: "<b>SISTEMA <?php echo $resNegocio['nombre']; ?></b>",
          text: "Ha ocurrido un error. Intente cambiar los datos más tarde o comuniquese con soporte técnico.",
          icon: "error",//error, 
          timer: 3000,
          toast: true,
          position: 'top-end',
          showConfirmButton: false,
          confirmButtonColor: '#47874a',
        });
        break;
      case 'errExtension': 
        Swal.fire({
          title: "<b>SISTEMA <?php echo $resNegocio['nombre']; ?></b>",
          text: "Elija una imágen de tipo PNG para su logo.",
          icon: "error",//error, 
          timer: 3000,
          toast: true,
          position: 'top-end',
          showConfirmButton: false,
          confirmButtonColor: '#47874a',
        });
        break;
      case 'DFAgregado': 
        Swal.fire({
          title: "<b>SISTEMA <?php echo $resNegocio['nombre']; ?></b>",
          text: "Los datos fiscales han sido agregados",
          icon: "success",//error, 
          timer: 3000,
          toast: true,
          position: 'top-end',
          showConfirmButton: false,
          confirmButtonColor: '#47874a',
        });
        break;
      case 'DFActualizado': 
        Swal.fire({
          title: "<b>SISTEMA <?php echo $resNegocio['nombre']; ?></b>",
          text: "Los datos fiscales han sido actualizados",
          icon: "success",//error, 
          timer: 3000,
          toast: true,
          position: 'top-end',
          showConfirmButton: false,
          confirmButtonColor: '#47874a',
        });
        break;
    
      default:
        break;
    }
    setTimeout(function(){
        localStorage.removeItem("configuration");
    }, 1500);
</script>