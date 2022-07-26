<?php
include "../conexion/conexion.php";

  $query = "select * from proveedor";
  $resultado = mysqli_query($con, $query);

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
<script>
  function confirmDelete(){
    let res = confirm("Estas seguro que deseas eliminar el registro");

    if(res === true){
      return true;
    }else{
      return false;
    }
  }
</script>

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
                        <td class="text-center"><a href="" class="btn-tb-delete"><i class="fa-solid fa-trash-can"></i></a></td>
                        <td class="text-center"><a href="" class="btn-tb-update"><i class="fa-solid fa-pen"></i></a></td>
                        <td class="text-center"><a href="" class="btn-tb-info"><i class="fa-solid fa-circle-info"></i></a></td>
                      </tr>
                      <?php
                    } 
                  ?>
                      
                </tbody>
            </table>
        </div>
    </section>

    <?php

if(isset($_GET['id'])){
    $id=$_GET['id'];
    $query = "SELECT * FROM agregar_provedor WHERE id=$id";
    $result =  mysqli_query($con,$query);
    if(mysqli_num_rows($result) == 1){
      $row = mysqli_fetch_array($result);
      $identificador = $row['identificador'];
      $nombre = $row['nombre'];
      $rfc = $row['rfc'];
      $telefono = $row['telefono'];
    }
  }
  
  if(isset($_POST['update'])){
    $id = $_GET['id'];
    $identificador = $_POST['identificador'];
    $nombre = $_POST['nombre'];
    $rfc = $_POST['rfc'];
    $rfc = $_POST['telefono'];
    
    $query = "UPDATE agregar_provedor SET identificador='$identificador', nombre='$nombre', rfc='$rfc', telefono='$telefono' WHERE id=$id ";
    mysqli_query($con,$query);
  
  }


    ?>


<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Agregar nuevo Proveedor</h5>
            <span data-dismiss="modal" aria-label="Close" class="close"><i class="fa-solid fa-xmark"></i></span>
        </div>
        <div class="modal-body">
            <div class="permisos">
                <form class="form-user" id="formulario" method="POST" action="logic/proveedor.php">
                  <input type="hidden" name="action_prov" id="action_prov" value="agregar_prov">
                    <div class="input-prov-id input-prov" id="group-prov-id">                                       
                        <label for="">Identificador: </label>
                        <input type="text" class="input" name="identificador" id="identificador" placeholder="Introduce un nombre">
                    </div>
                    <div class="input-user-name input-user" id="group-nombre">                                       
                        <label for="">Nombre: </label>
                        <input type="text" class="input" name="nombre" id="nombre" placeholder="Introduce un nombre">
                    </div>
                    <div class="input-user-rfc input-user" id="group-rfc">                                       
                      <label for="">Tipo factura: </label>
                        <input type="text" class="input" name="factura" id="factura" placeholder="Introduce">
                    </div>
                    <div class="input-user-tel input-user" id="group-telefono">                                       
                      <label for="">Teléfono</label>
                        <input type="number_format" name="telefono" id="telefono" class="input">
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
            <!-- <div class="modal-footer">
                <button type="button" class="btn-close-modal" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn-save-modal">Agregar</button>
            </div> -->
        </div>
    </div>
  </div>
</div>

<!-- <script src="../assets/js/personal.js" type="module"></script> -->

<script>
    let addProv = localStorage.getItem("addProv");
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
</script>