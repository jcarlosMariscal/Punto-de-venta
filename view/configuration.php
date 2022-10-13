<?php
  require_once "config/Connection.php";
  require_once "logic/Read.php";
  $query = new Read();

  $readNegocio = $query->readNegocio($_SESSION['user']['id_negocio']); // Hacer una consulta a tabla negocios
  $resNegocio = $readNegocio->fetch(); // Obtener el registro de la consulta
  $readTipo = $query->readTipo(); // Hacer consulta para leer los tipos de negocios.
  $readTipoSelected = $query->readTipoSelected($resNegocio['id_tipo']); // Obtner el tipo de negocio actual

  $buscarDatosFiscales = $query->buscarDatosFiscales($_SESSION['user']['id_negocio']);
  $obtenerDatosFiscales = $query->obtenerDatosFiscales($_SESSION['user']['id_negocio']);
  $resDatosFiscales = $obtenerDatosFiscales->fetch();
  // require_once "../template/header.php";
  $sucursales = $query->obtenerSucursales();
?>

<section class="content">
    <div class="album bg-light">
    <div class="container">

      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
        <div class="col">
          <div class="card shadow-sm card-configuracion">
            <div class="card-title">
              <img src="https://wallpaperaccess.com/full/2886065.jpg" class="title__img bd-placeholder-img card-img-top">
              <div class="title__text"><p>Negocio</p></div>
            </div>

            <div class="card-body">
              <p class="card-text">Aquí puede agregar la información general de su negocio.</p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <button type="button" class="btn btn-sm btn-outline-secondary">Ver</button>
                  <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target=".editarNegocio">Editar</button>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card shadow-sm card-configuracion">
            <div class="card-title">
              <img src="https://wallpaperaccess.com/full/2886065.jpg" class="title__img bd-placeholder-img card-img-top">
              <div class="title__text"><p>Datos Fiscales</p></div>
            </div>

            <div class="card-body">
              <p class="card-text">Aquí puede agregar o actualizar los datos fiscales de su negocio.</p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <button type="button" class="btn btn-sm btn-outline-secondary">Ver</button>
                  <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target=".datos_fiscales">Editar</button>
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php
        foreach($sucursales as $sucursal){
          ?>
          <div class="col">
            <div class="card shadow-sm card-configuracion">
              <div class="card-title">
                <img src="https://wallpaperaccess.com/full/2886065.jpg" class="title__img bd-placeholder-img card-img-top">
                
                <div class="title__text"><p>Sucursal <?php echo $sucursal['nombre']; ?></p></div>
              </div>
  
              <div class="card-body">
                <p class="card-text">Teléfono: <?php echo $sucursal['telefono']; ?></p> <br>
                <div class="d-flex justify-content-between align-items-center">
                  <div class="btn-group">
                    <button type="button" class="btn btn-sm btn-outline-secondary">Ver</button>
                    <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#static<?php echo $sucursal['id_sucursal'] ?>">Editar</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <?php
        }
        
        ?>
      </div>
    </div>
  </div>
</section>

<section class="modales">
  <div class=" modal fade editarNegocio" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Datos Generales del negocio</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
                  <div class="config__form">
            <form action="logic/updateData.php" method="POST" class="form" enctype="multipart/form-data" id="formulario">
                <div class="form-inputs">
                  <input type="hidden" name="table" value="updateNegocio">
                  <input type="hidden" name="id_negocio" value="<?php echo $_SESSION['user']['id_negocio']; ?>">
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
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade datos_fiscales" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Datos Fiscales</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="datos_fiscales">
            <?php
              if($buscarDatosFiscales[0]){
                if($buscarDatosFiscales[1] == 1){
                  ?>
                  <form class="form-user" id="formulario" method="POST" action="logic/updateData.php">
                    <input type="hidden" name="table" id="table" value="datos_fiscales">
                    <input type="hidden" name="id_negocio" id="id_negocio" value="<?php echo $_SESSION['user']['id_negocio']; ?>">
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
                        <button type="button" class="btn-close-modal" data-bs-dismiss="modal">Cerrar</button>
                        <input type="submit" class="btn-cfg" value="Actualizar" id="btn-send">
                      </div>
                    </form>
                  <?php
                }else {
                  ?>
                  <h5 id="noDatosFiscales">No hay Datos Fiscales registrados para <?php echo $resNegocio['nombre']; ?> <span hidden id="id_negocio"><?php echo $_SESSION['user']['id_negocio']; ?></span></h5>
                  <button type="button" class="btn-cfg" id="registrarDF">Registrar</button>
                  <div id="formDF"></div>
                  <div class="modal-footer" id="modal-footerNoDatos">
                      <button type="button" class="btn-close-modal" data-bs-dismiss="modal">Cerrar</button>
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

  <?php
  $result = $query->obtenerSucursales(); //Mostramos los resultados

  foreach ($result as $row) {
    $id_sucursal = $row['id_sucursal'];
    $nombre = $row['nombre'];
    $estado = $row['estado'];
    $ciudad = $row['ciudad'];
    $colonia = $row['colonia'];
    $direccion = $row['direccion'];
    $codigo_postal = $row['codigo_postal'];
    $telefono = $row['telefono'];
    $correo = $row['correo'];
  ?>


  <div class="modal fade modal-dialog-scrollable" id="static<?php echo $row['id_sucursal'] ?>">
  <div class="modal-dialog">
    <div class="borde modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLabel">Editar Sucursal</h3>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="form-user" id="formularioEdit" method="POST" action="logic/updateData.php">
              <input type="hidden" name="table" id="action_per" value="editarSucursal">
              <input type="hidden" name="id_sucursl" id="id_sucursal" value="<?php echo $id_sucursal; ?>">
              <div class="input-user-name input-user" id="group-nombre">
                <label for="">Nombre: </label>
                <input type="text" class="input" name="nombre" id="nombre" value="<?php echo $nombre; ?>">
                <p class="input-error">*El nombre no debe quedar vacío, puede tener letras y acentos.</p>
              </div>
              <div class="input-user-email input-user" id="group-correo">
                <label for="">Estado</label>
                <input type="text" name="correo" id="correo" class="input" value="<?php echo $estado; ?>">
                <p class="input-error">*Este campo debe ser un tipo de E-mail valido.</p>
              </div>
              <div class="input-user-email input-user" id="group-correo">
                <label for="">Ciudad</label>
                <input type="text" name="correo" id="correo" class="input" value="<?php echo $ciudad; ?>">
                <p class="input-error">*Este campo debe ser un tipo de E-mail valido.</p>
              </div>
              <div class="input-user-email input-user" id="group-correo">
                <label for="">Colonia</label>
                <input type="text" name="correo" id="correo" class="input" value="<?php echo $colonia; ?>">
                <p class="input-error">*Este campo debe ser un tipo de E-mail valido.</p>
              </div>
              <div class="input-user-email input-user" id="group-correo">
                <label for="">Direccion</label>
                <input type="text" name="correo" id="correo" class="input" value="<?php echo $direccion; ?>">
                <p class="input-error">*Este campo debe ser un tipo de E-mail valido.</p>
              </div>
              <div class="input-user-email input-user" id="group-correo">
                <label for="">CP</label>
                <input type="text" name="correo" id="correo" class="input" value="<?php echo $codigo_postal; ?>">
                <p class="input-error">*Este campo debe ser un tipo de E-mail valido.</p>
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
              <!-- <hr> -->
              <br>
              <div class="input-submit modal-footer">
                <button type="button" class="btn-close-modal" data-bs-dismiss="modal">Cerrar</button>
                <input type="submit" class="btn-cfg" value="Agregar" id="btn-send">
              </div>
            </form>
      </div>
    </div>
  </div>
</div>
<?php
}
  ?>
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