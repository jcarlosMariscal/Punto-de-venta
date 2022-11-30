<?php
  $readNegocio = $query->readNegocio($_SESSION['user']['id_negocio']); // Hacer una consulta a tabla negocios
  $resNegocio = $readNegocio->fetch(); // Obtener el registro de la consulta
  $readTipo = $query->readTipo(); // Hacer consulta para leer los tipos de negocios.
  $readTipoSelected = $query->readFieldSelected($resNegocio['id_tipo'], 'tipo_negocio', 'id_tipo', 'tipo'); // Obtner el tipo de negocio actual

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
        <div class="col-12"><h3 class="section__name">Negocio</h3></div>
        <!-- Prueba Configuración victor -->
        <div class="col tam-card">
          <div class="card shadow-sm card-configuracion">
            <div class="row g-0">
                <div class="col-md-4 left-column background-left-column">
                  <h5 class="text-subconf">Negocio</h2>
                  <i class="fa-solid fa-store fa-4x" style="color: white"></i>
                </div>
                <div class="col-md-8">
                  <div class="card-body">
                    <p class="card-text text-configu">Aquí puede agregar la información general de su negocio. </p>
                    <div class="d-flex justify-content-center align-items-center space">
                        <div class="btn-group">
                          <button type="button" class="btn btn-sm btn-outline-success" data-bs-toggle="modal" data-bs-target="#informacion-negocio">Ver</button>
                          <button type="button" class="btn btn-sm btn-outline-success" data-bs-toggle="modal" data-bs-target=".editarNegocio">Editar</button>
                        </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </div>
        <!-- ///////////////////////////////// -->
        <!-- Prueba Configuración victor -->
        <div class="col tam-card">
          <div class="card shadow-sm card-configuracion">
            <div class="row g-0">
                <div class="col-md-4 left-column background-left-column">
                  <h5 class="text-subconf text-center">Datos Fiscales</h2>
                  <i class="fa-solid fa-id-card fa-4x" style="color: white"></i>
                </div>
                <div class="col-md-8">
                  <div class="card-body">
                    <p class="card-text text-configu">Aquí puede agregar o actualizar los datos fiscales de su negocio.</p>
                    <div class="d-flex justify-content-center align-items-center space">
                      <div class="btn-group">
                        <?php
                        // Verificar datos fiscales
                        if($buscarDatosFiscales[0]){
                          if($buscarDatosFiscales[1] == 1){
                            ?>
                            <button type="button" class="btn btn-sm btn-outline-success" data-bs-toggle="modal" data-bs-target="#informacion-fiscal">Ver</button>
                            <button type="button" class="btn btn-sm btn-outline-success" data-bs-toggle="modal" data-bs-target=".datos_fiscales">Editar</button>
                            <?php
                          }else{
                            ?>
                            <button type="button" class="btn btn-sm btn-outline-success" data-bs-toggle="modal" data-bs-target=".datos_fiscales">Agregar</button>
                            <?php
                          }
                        }
                        ?>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </div>
        <!-- ///////////////////////////////// -->
      </div>
      <br>
      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
        <div class="col-12"><h3 class="section__name">Sucursales</h3></div>
        <?php
        foreach($sucursales as $sucursal){
          $selectPersonal = $query->selectTableId("personal","id_sucursal", $sucursal['id_sucursal'],"nombre");
          $getPersonal = $selectPersonal->fetch();
          ?>
          <div class="col tam-card">
          <div class="card shadow-sm card-configuracion">
            <div class="row g-0">
                <div class="col-md-4 left-column background-left-column">
                  <h5 class="text-subconf text-center">Sucursal <?php echo $sucursal['estado']; ?></h2>
                  <i class="fa-solid fa-building fa-4x" style="color: white"></i>
                </div>
                <div class="col-md-8">
                  <div class="card-body">
                    <p class="card-text text-sucursal"><?php echo $sucursal['nombre']; ?></p>
                    <p class="card-text text-sucursal">Gerente: <?php echo $getPersonal['nombre']; ?></p>
                    <p class="card-text text-sucursal">Teléfono: <?php echo $sucursal['telefono']; ?></p>
                    <!-- <p class="card-text text-sucursal">Correo: <?php echo $sucursal['correo']; ?></p> -->
                    <div class="d-flex justify-content-center align-items-center space">
                      <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-outline-success" data-bs-toggle="modal" data-bs-target="#verInfo<?php echo $sucursal['id_sucursal'] ?>">Ver</button>
                        <button type="button" class="btn btn-sm btn-outline-success" data-bs-toggle="modal" data-bs-target="#static<?php echo $sucursal['id_sucursal'] ?>">Editar</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </div>
        <!-- ///////////////////////////////// -->
          <?php
        }
        
        ?>
      </div>
    </div>
  </div>
</section>

<section class="modales">
  <div class=" modal fade editarNegocio" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-xl" id="seccion-modal"> <!-- fullscreeen-modal.js| COLOCAR ESTE ID AL MODAL --> 
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Datos Generales del negocio</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            <button type="button" class="btn-fullscreen fullscreen-no" id="btn-fullscreen"><i class="fa-solid fa-up-right-and-down-left-from-center"></i></button> <!-- fullscreeen-modal.js|  COPIAR Y PEGAR ESTE BOTON -->
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
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
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
                      <div class="input-user-name input-user" id="group-nombre">                                       
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
  <div class="modal-dialog modal-lg">
    <div class="borde modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLabel">Editar Sucursal</h3>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="form-user" id="formularioEdit" method="POST" action="logic/updateData.php">
              <input type="hidden" name="table" id="action_per" value="editarSucursal">
              <input type="hidden" name="id_sucursl" id="id_sucursal" value="<?php echo $id_sucursal; ?>">
              <div class="input-user-name input-user" id="group-nombre">
                <label for="">Nombre </label>
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

<!-- Información Negocio -->
  <?php
  // $result = $query->selectTable('negocio'); //Mostramos los resultados
  date_default_timezone_set('America/Mexico_City');
  $readNegocio = $query->readNegocio($_SESSION['user']['id_negocio']); 
  
  foreach($readNegocio as $row){
    $logoNegocio = $row['logo'];
    $nombreNegocio = $row['nombre'];
    $telefono = $row['telefono'];
    $correo = $row['correo'];
    $nameTipo = $query->selectTableId('tipo_negocio', 'id_tipo',$row['id_tipo'], 'tipo');
    $getTipoName = $nameTipo->fetch();
  }
  ?>


  <div class="modal fade" id="informacion-negocio">
  <div class="modal-dialog modal-fullscreen-xxl-down">
    <div class="borde modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLabel">Información de <?php echo $nombreNegocio; ?></h3>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <article id="ticket">
      <div class="contenedor-head">
        <img src="../assets/img/logo/<?php echo $logoNegocio; ?>" class="ticon" alt="">
        <p class="title-princ"><span>Nova Tech</span></p>
        <p class="title-subp"><span>Easy Sal</span></p>
        <p class="fech">Fecha: <?php echo date("d/m/y"); ?></p>
        <p class="title-subsp">Datos del negocio</p>
        <p>
          El presente documento muestra la infomación del negocio <span class="remarc"><?php echo $nombreNegocio ?></span> con el número de teléfono <span class="remarc"><?php echo $telefono; ?></span> y correo <span class="remarc"><?php echo $correo; ?></span>, siendo de tipo <span class="remarc"><?php echo $getTipoName['tipo']; ?></span>.
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
<!-- Información Fiscal -->
  <?php
  // $result = $query->selectTable('negocio'); //Mostramos los resultados
  $obtenerDatosFiscales = $query->obtenerDatosFiscales($_SESSION['user']['id_negocio']); 
  
  foreach($obtenerDatosFiscales as $row){
    $nombreFiscal = $row['nombre'];
    $rfc = $row['rfc'];
    $rFiscal = $row['rFiscal'];
  }
  ?>


  <div class="modal fade" id="informacion-fiscal">
  <div class="modal-dialog modal-fullscreen-xxl-down">
    <div class="borde modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLabel">Información de fiscal <?php echo $nombreNegocio; ?></h3>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <article id="ticket">
      <div class="contenedor-head">
        <img src="../assets/img/logo/<?php echo $logoNegocio; ?>" class="ticon" alt="">
        <p class="title-princ"><span>Nova Tech</span></p>
        <p class="title-subp"><span>Easy Sal</span></p>
        <p class="fech">Fecha: <?php echo date("d/m/y"); ?></p>
        <p class="title-subsp">Datos del negocio</p>
        <p>
          El presente documento muestra la infomación fiscal del negocio <span class="remarc"><?php echo $nombreNegocio ?></span> con el nombre fiscal <span class="remarc"><?php echo $nombreFiscal; ?></span>, su rfc es <span class="remarc"><?php echo $rfc; ?></span>y su régimen fiscal es <span class="remarc"><?php echo $rFiscal; ?></span>.
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
<!-- Información Sucursales -->
  <?php
  // $result = $query->selectTable('negocio'); //Mostramos los resultados
  $resultSucursal = $query->selectTable('sucursal'); 

  foreach($resultSucursal as $s){
    $selectPersonal = $query->selectTableId("personal","id_sucursal", $s['id_sucursal'],"nombre");
    $getPersonal = $selectPersonal->fetch();
    ?>
      <div class="modal fade" id="verInfo<?php echo $s['id_sucursal']; ?>">
        <div class="modal-dialog modal-fullscreen-xxl-down">
          <div class="borde modal-content">
            <div class="modal-header">
              <h3 class="modal-title" id="exampleModalLabel">Información de fiscal <?php echo $nombreNegocio; ?></h3>
              <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <article id="ticket">
                <div class="contenedor-head">
                  <img src="../assets/img/logo/<?php echo $logoNegocio; ?>" class="ticon" alt="">
                  <p class="title-princ"><span>Nova Tech</span></p>
                  <p class="title-subp"><span>Easy Sal</span></p>
                  <p class="fech">Fecha: <?php echo date("d/m/y"); ?></p>
                  <p class="title-subsp">Datos del negocio</p>
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
                      <p class="telinf1">Teléfono</p> <br> <br>
                      <p class="telinf"><?php echo $getPersonal['nombre']; ?></p>
                      <p class="telinf1">Gerente</p>
                    </div>
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
