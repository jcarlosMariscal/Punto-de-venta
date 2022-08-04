<?php
  include ("../conexion/conexion.php");

  $query = "select * from configuracion ORDER BY id DESC LIMIT 1";
  $resultado = mysqli_query($con, $query);
  foreach ($resultado as $row) {
    $razon_social = $row['razon_social'];
    $rfc = $row['rfc'];
    $domicilio = $row['domicilio'];
    $cpostal = $row['cpostal'];
    $telefono = $row['telefono'];
    $imagen = $row['imagen'];
  } 
?>

<section class="above">
    <div class="above__info">
      <p>Configuración</p>
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
<section class="content">
  <?php
    if($razon_social === "Tech"){
      echo "<p>Agregue información de su negocio para personalizar el sistema.</p>";
    }else{
      echo "<p>Puede cambiar la información de su negocio en el momento que desee.</p>";
      }
  ?>
    <div class="config">
        <div class="config__form">
            <h4>Datos del negocio</h4>
            <form action="./logic/confi.php" method="POST" class="form" enctype="multipart/form-data" id="formulario">
                <div class="form-inputs">
                    <div class="input-nombre input-cfg" id="group-razon_social">
                        <label for="" class="label">Razón Social:</label>
                        <input type="text" class="input input-config" value="<?php echo $razon_social; ?>" name="razon_social" id="razon_social" >
                        <p class="input-error">*Rellena el este campo correctamente por favor</p>
                    </div>
                    <div class="input-rfc input-cfg" id="group-rfc">
                        <label for="" class="label">R. F. C.: </label>
                        <input type="text" class="input input-config" value="<?php echo $rfc ?>" name="rfc" id="rfc" >
                        <p class="input-error">*Introduce un RFC con un formato correcto.</p>
                    </div>
                    <div class="input-domicilio input-cfg" id="group-domicilio">
                        <label for="" class="label">Domicilio: </label>
                        <input type="text" class="input input-config" value="<?php echo $domicilio ?>" name="domicilio" id="domicilio" >
                        <p class="input-error">*Introduce una dirección correcta</p>
                    </div>
                    <div class="input-cPostal input-cfg" id="group-cpostal">
                        <label for="" class="label">C. Postal: </label>
                        <input type="text" class="input input-config" value="<?php echo $cpostal ?>" name="cpostal" id="cpostal" >
                        <p class="input-error">*Este campo debe ser númerico y tener 5 caracteres.</p>
                    </div>
                    <div class="input-telefono input-cfg" id="group-telefono">
                        <label for="" class="label">Teléfono: </label>
                        <input type="text" class="input input-config" value="<?php echo $telefono ?>" name="telefono" id="telefono" >
                        <p class="input-error">*Este campo debe ser númerico y tener 10 caracteres.</p>
                    </div>
                </div>
                <div class="form-logo">
                    <div class="logo-current">
                        <img class="currently" id="img-logo" src="<?php echo '../imagenes/'.$imagen; ?>" alt="">
                    </div>
                    <div class="custom-input-file col-md-6 col-sm-6 col-xs-6">
                        <input type="file" name="imagen" id="myFile" class="input-file" value="">
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
                <a  href="#" class="btn-prm deshabilitar" data-toggle="modal" data-target=".bd-example-modal-lg">Permisos de Administrador</a>
            </div>
            <div class="permissions-seller">
                <a href="" class="btn-prm deshabilitar">Permisos del Personal de Ventas</a>
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
<script src="../assets/js/configuration.js" type="module"></script>

<script>
    let confi = localStorage.getItem("confi");
    if(confi === "true"){
      if("<?php echo $razon_social; ?>" === "Tech"){
        Swal.fire({
            title: "<b>SISTEMA <?php echo $razon_social; ?></b>",
            text: "Información recibida correctamente.",
            icon: "success",//error, 
            timer: 3000,
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            confirmButtonColor: '#47874a',
            // imageUrl: '../imagenes/<?php echo $imagen; ?>',
            // imageHeight: 100,
            // imageWidth: 100,
            // imageAlt: 'A tall image'
        });
      }else{
        Swal.fire({
            title: "<b>SISTEMA <?php echo $razon_social; ?></b>",
            text: "La información de su negocio ha sido actualizada",
            icon: "success",//error, 
            timer: 3000,
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            confirmButtonColor: '#47874a',
            // imageUrl: '../imagenes/<?php echo $imagen; ?>',
            // imageHeight: 100,
            // imageAlt: 'A tall image'
        });
      }
    } 
    setTimeout(function(){
        localStorage.removeItem("confi");
    }, 1500);
</script>