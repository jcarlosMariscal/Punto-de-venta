<?php
  include "../conexion/conexion.php";
  $dProv = (isset($_GET['dProv']) ? $_GET['dProv'] : NULL);
  $eProv = (isset($_GET['eProv']) ? $_GET['eProv'] : NULL);
  $query = "SELECT * FROM proveedor";
  $resultado = mysqli_query($con, $query);


  if($dProv){
  ?>
  <script>
    Swal.fire({
        title: "¿Está seguro de eliminar el proveedor <b><?php echo $dProv; ?></b>?",
        text: "Esta acción eliminará el proveedor y los productos de la base de de datos",
        icon: "question",
        showCancelButton: true,
        confirmButtonText: 'Eliminar',
        confirmButtonColor: "#D13513",
        cancelButtonText: 'Cancelar',
        allowOutsideClick: false
    }).then((button)=>{
        if(button.isConfirmed === true){
          window.location.href="logic/proveedor.php?dProv=<?php echo $dProv; ?>"
        }     
        if(button.isDismissed === true) window.location.href="index.php?p=proveedor";
    });
  </script>
  <?php
}
?>

<section class="above">
    <div class="above__info">Proveedores
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
                    <th scope="col">TIPO  DE FACTURA</th>
                    <th scope="col">TELÉFONO</th>
                  </tr>
                </thead>
                <tbody>
                  
                  <?php
                    foreach ($resultado as $row) {
                      ?>
                      <tr class="prod">
                        <td><?php echo $row['identificador']; ?></td>
                        <td><?php echo $row['nombre']; ?></td>
                        <td><?php echo $row['factura']; ?></td>
                        <td><?php echo $row['telefono']; ?></td>
                        <td class="text-center"><a href="index.php?p=proveedor&dProv=<?php echo $row['identificador']; ?>" class="btn-tb-delete"><i class="fa-solid fa-trash-can"></i></a></td>
                        <td class="text-center"><a href="index.php?p=proveedor&eProv=<?php echo $row['identificador']; ?>" class="btn-tb-update"><i class="fa-solid fa-pen"></i></a></td>
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
            <h5 class="modal-title" id="exampleModalLongTitle">Agregar proveedor</h5>
            <span data-dismiss="modal" aria-label="Close" class="close"><i class="fa-solid fa-xmark"></i></span>
        </div>
        <div class="modal-body">
            <div class="permisos">
                <form class="form-user" id="formulario" method="POST" action="logic/proveedor.php">
                  <input type="hidden" name="action_prov" id="action_prov" value="agregar_prov">
                    <div class="input-identificador input-prov" id="group-identificador">                                       
                        <label for="">Identificador: </label>
                        <input type="text" class="input" name="identificador" id="identificador" placeholder="Introduce identificador">
                        <p class="input-error">*Este campo solo acepta caracteres númericos.</p>
                    </div>
                    <div class="input-nombre input-prov" id="group-nombre">                                       
                        <label for="">Nombre: </label>
                        <input type="text" class="input" name="nombre" id="nombre" placeholder="Introduce un nombre">
                        <p class="input-error">*El nombre no debe quedar vacío, puede tener letras y acentos.</p>
                    </div>
                    <div class="input-factura input-prov" id="group-factura">                                       
                      <label for="">Tipo factura: </label>
                        <input type="text" class="input" name="factura" id="factura" placeholder="Introduce tipo de factura">
                        <p class="input-error">* Este campo no debe quedar vacío y acepta solo texto.</p>
                    </div>
                    <div class="input-telefono input-prov" id="group-telefono">                                       
                      <label for="">Teléfono</label>
                        <input type="number" name="telefono" id="telefono" class="input" placeholder="Introduce un teléfono">
                        <p class="input-error">*Este campo debe ser númerico y tener 10 caracteres.</p>
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
    $sql = "SELECT * FROM proveedor WHERE identificador = '$eProv'";
    $res = mysqli_query($con, $sql);
    foreach($res as $row){
      $id_prov = $row['id'];
      $identificador = $row['identificador'];
      $nombre = $row['nombre'];
      $factura = $row['factura'];
      $telefono = $row['telefono'];
    }
  ?>
<div class="modal fade bd-example-modal-lg" id="modProv" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Editar Proveedor <?php echo $nombre; ?></h5>
        <span data-dismiss="modal" id="cerrarForm" aria-label="Close" class="close"><i class="fa-solid fa-xmark"></i></span>
      </div>
      <div class="modal-body">
        <div class="permisos">
          <form class="form-user" id="formularioEdit" method="POST" action="logic/proveedor.php">
            <input type="hidden" name="action_prov" id="action_prov" value="editar_prov">
            <input type="hidden" name="id_prov" id="id_prov" value="<?php echo $id_prov; ?>">
            <div class="input-identificador input-prov" id="group-identificador">                                       
              <label for="">Identificador: </label>
              <input type="text" class="input" name="identificador" id="identificador" value="<?php echo $identificador; ?>">
              <p class="input-error">* Rellena este campo correctamente</p>
            </div>
            <div class="input-nombre input-prov" id="group-nombre">                                       
              <label for="">Nombre: </label>
              <input type="text" class="input" name="nombre" id="nombre" value="<?php echo $nombre; ?>">
              <p class="input-error">* Rellena este campo correctamente</p>
            </div>
            <div class="input-factura input-prov" id="group-factura">                                       
              <label for="">Tipo factura: </label>
              <input type="text" class="input" name="factura" id="factura" value="<?php echo $factura; ?>">
              <p class="input-error">* Rellena este campo correctamente</p>
            </div>
            <div class="input-telefono input-prov" id="group-telefono">                                       
              <label for="">Telefono: </label>
              <input type="number" class="input" name="telefono" id="telefono" value="<?php echo $telefono; ?>">
              <p class="input-error">* Rellena este campo correctamente</p>
            </div>
            <!-- <hr> -->
            <br>
            <div class="input-submit modal-footer">
              <button type="button" class="btn-close-modal" id="cerrarForm2" data-dismiss="modal">Cerrar</button>
              <input type="submit" class="btn-cfg" value="Modificar" id="btn-send">
            </div>
          </form>
        </div>
        <br>
      </div>
    </div>
  </div>
</div>

<script src="../assets/js/proveedor.js" type="module"></script>

<script>
    let addProv = localStorage.getItem("addProv");
    let modProv = localStorage.getItem("modProv");
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
</script>
