<?php
  include "../conexion/conexion.php";
  $dPer = (isset($_GET['dPer']) ? $_GET['dPer'] : NULL);
  $ePer = (isset($_GET['ePer']) ? $_GET['ePer'] : NULL);
  $query = "SELECT * FROM usuarios";
  $resultado = mysqli_query($con, $query);


  if($dPer){
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
          window.location.href="logic/personal.php?dPer=<?php echo $dPer; ?>"
        }     
        if(button.isDismissed === true) window.location.href="index.php?p=personal";
    });
  </script>
  <?php
}
?>
<section class="above">
    <div class="above__info">Mi Personal
      <!-- <a href="index.php?p=compras" class="btn-prm btn-cancelar">Atrás</a> -->
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

<section class="">
    <section class="table-ver-product">
        <div class="table-above">
            <div class="product-filter">
                <p>Recuerde que puede modificar los permisos en <a href="index.php?p=configuration">Configuración</a></p>
            </div>
            <div class="product-chart">
                <a href="" class="btn-prm btn-cancelar" data-toggle="modal" data-target=".bd-example-modal-lg">Agregar</a>
            </div>
        </div>
        <div class="table-ver">
            <table table bgcolor= "#FFFFFF"  class="table table-bordered">
                <thead>
                  <tr>
                      <th scope="col">#</th>
                      <th scope="col">NOMBRE</th>
                      <th scope="col">CORREO</th>
                      <th scope="col">TELÉFONO</th>
                      <th scope="col">ROL</th>
                      <th scope="col">CAJA</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    foreach ($resultado as $row) {
                      ?>
                        <tr class="prod">
                          <td><?php echo $row['id_user']; ?></td>
                          <td><?php echo $row['username']; ?></td>
                          <td><?php echo ($row['correo'] == NULL) ? "<b>Sin Correo</b>" : $row['correo']; ?></td>
                          <td><?php echo ($row['telefono'] == NULL) ? "<b>Sin telefono</b>" : $row['telefono'];; ?></td>
                          <td><?php echo $row['id_rol'] == 1 ? "Administrador": "Vendedor"; ?></td>
                          <td><?php echo ($row['id_caja'] == NULL) ? "<b>Sin Caja</b>" : $row['id_caja'];; ?></td>
                          <td class="text-center"><a href="index.php?p=personal&dPer=<?php echo $row['id_user']; ?>" class="btn-tb-delete"><i class="fa-solid fa-trash-can"></i></a></td>
                          <td class="text-center"><a href="index.php?p=personal&ePer=<?php echo $row['id_user']; ?>" class="btn-tb-update"><i class="fa-solid fa-pen"></i></a></td>
                          <td class="text-center"><a href="" class="btn-tb-info deshabilitar"><i class="fa-solid fa-circle-info"></i></a></td>
                      </tr>
                      <?php
                    }
                  ?>
                </tbody>
            </table>
        </div>
    </section>

    <!-- AGREGAR -->
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Agregar nuevo usuario</h5>
            <span data-dismiss="modal" aria-label="Close" class="close"><i class="fa-solid fa-xmark"></i></span>
        </div>
        <div class="modal-body">
            <div class="permisos">
                <form class="form-user" id="formulario" method="POST" action="logic/personal.php">
                  <input type="hidden" name="action_per" id="action_per" value="agregar_per">
                    <div class="input-user-name input-user" id="group-nombre">                                       
                        <label for="">Nombre: </label>
                        <input type="text" class="input" name="nombre" id="nombre" placeholder="Introduce tu nombre">
                        <p class="input-error">* Rellena</p>
                    </div>
                    <!-- <div class="input-user-rfc input-user" id="group-rfc">                                       
                      <label for="">R.F.C.: </label>
                        <input type="text" class="input" name="rfc" id="rfc" placeholder="Introduce">
                    </div> -->
                    <!-- <div class="input-user-fnac input-user" id="group-fecha_nac">                                       
                      <label for="">Fecha de Nacimiento</label>
                        <input type="date" name="fecha_nac" id="fecha_nac" class="input">
                    </div> -->
                    <div class="input-user-tel input-user" id="group-telefono">                                       
                      <label for="">Teléfono</label>
                      <input type="number_format" name="telefono" id="telefono" class="input" placeholder="Introduce tu telefono">
                      <p class="input-error">* Rellena</p>
                    </div>
                    <div class="input-user-email input-user" id="group-correo">                                       
                      <label for="">Correo</label>
                      <input type="text" name="correo" id="correo" class="input" placeholder="Introduce tu correo">
                      <p class="input-error">* Rellena</p>
                    </div>
                    <div class="input-user-rol input-user">                                       
                      <label for="">Seleccione el Rol:</label>
                      <select name="rol" id="rol" class="select-user-rol">
                        <!-- <option value="1">Administrador</option> -->
                        <option value="2">Vendedor</option>
                      </select>
                    </div>
                    <div class="input-user-caja input-user" id="group-caja">                                       
                      <label for="">Caja: </label>
                        <input type="text" name="caja" id="caja" class="input" placeholder="Introduce la caja del personal">
                        <p class="input-error">* Rellena</p>
                    </div>
                    <div class="input-user-pass input-user" id="group-pass">                                       
                      <label for="">Contraseña</label>
                      <input type="password" name="pass" id="pass" class="input" placeholder="Introduce tu contraseña">
                      <p class="input-error">* Rellena</p>
                    </div>
                    <!-- <hr> -->
                    <br>
                    <div class="input-submit modal-footer">
                      <button type="button" class="btn-close-modal" data-dismiss="modal">Cerrar</button>
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
    $sql = "SELECT * FROM usuarios WHERE id_user = '$ePer'";
    $res = mysqli_query($con, $sql);
    foreach($res as $row){
      $id_user = $row['id_user'];
      $nombre = $row['username'];
      $correo = $row['correo'];
      $telefono = $row['telefono'];
      $caja = $row['id_caja'];
    }
  ?>
<div class="modal fade bd-example-modal-lg" id="modPer" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Editar usuario</h5>
            <span data-dismiss="modal" aria-label="Close" class="close"><i class="fa-solid fa-xmark"></i></span>
        </div>
        <div class="modal-body">
            <div class="permisos">
                <form class="form-user" id="formularioEdit" method="POST" action="logic/personal.php">
                  <input type="hidden" name="action_per" id="action_per" value="editar_per">
            <input type="hidden" name="id_per" id="id_per" value="<?php echo $id_user; ?>">
                    <div class="input-user-name input-user" id="group-nombre">                                       
                        <label for="">Nombre: </label>
                        <input type="text" class="input" name="nombre" id="nombre" value="<?php echo $nombre; ?>">
                        <p class="input-error">* Rellena</p>
                    </div>
                    <!-- <div class="input-user-rfc input-user" id="group-rfc">                                       
                      <label for="">R.F.C.: </label>
                        <input type="text" class="input" name="rfc" id="rfc" placeholder="Introduce">
                    </div> -->
                    <!-- <div class="input-user-fnac input-user" id="group-fecha_nac">                                       
                      <label for="">Fecha de Nacimiento</label>
                        <input type="date" name="fecha_nac" id="fecha_nac" class="input">
                    </div> -->
                    <div class="input-user-tel input-user" id="group-telefono">                                       
                      <label for="">Teléfono</label>
                      <input type="number_format" name="telefono" id="telefono" class="input" value="<?php echo $telefono; ?>">
                      <p class="input-error">* Rellena</p>
                    </div>
                    <div class="input-user-email input-user" id="group-correo">                                       
                      <label for="">Correo</label>
                      <input type="text" name="correo" id="correo" class="input" value="<?php echo $correo; ?>">
                      <p class="input-error">* Rellena</p>
                    </div>
                    <div class="input-user-rol input-user">                                       
                      <label for="">Seleccione el Rol:</label>
                      <select name="rol" id="rol" class="select-user-rol">
                        <option value="1">Administrador</option>
                        <option value="2">Ventas</option>
                      </select>
                    </div>
                    <div class="input-user-caja input-user" id="group-caja">                                       
                      <label for="">Caja</label>
                        <input type="text" name="caja" id="caja" class="input" value="<?php echo $caja; ?>">
                    </div>
                    <div class="input-user-pass input-user" id="group-pass">                                       
                      <label for="">Contraseña</label>
                      <input type="password" name="pass" id="pass" class="input">
                      <p class="input-error">* Rellena</p>
                    </div>
                    <!-- <hr> -->
                    <br>
                    <div class="input-submit modal-footer">
                      <button type="button" class="btn-close-modal" data-dismiss="modal">Cerrar</button>
                      <input type="submit" class="btn-cfg" value="Agregar" id="btn-send">
                    </div>
                  </form>
            </div>
            <br>
        </div>
    </div>
  </div>
</div>

<script src="../assets/js/personal.js" type="module"></script>
<script>
    let addPer = localStorage.getItem("addPer");
    let modPer = localStorage.getItem("modPer");
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
</script>
