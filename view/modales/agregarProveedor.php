<div class="modal fade agregarProveedor" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Agregar proveedor</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="permisos">
              <form class="form-user" id="formulario" method="POST" action="logic/createData.php">
              <input type="hidden" name="table" id="action_per" value="agregarProveedor">
              <div class="input-user-name input-prov" id="group-nombre">
                <label for="">Nombre: </label>
                <input type="text" class="input" name="nombre" id="nombre" placeholder="Introduce un nombre">
                <p class="input-error">*El nombre no debe quedar vacío, puede tener letras y acentos.</p>
              </div>
              <!-- <div class="input-factura input-prov" id="group-factura">                                       
                      <label for="">Tipo factura: </label>
                        <input type="text" class="input" name="factura" id="factura" placeholder="Introduce tipo de factura">
                        <p class="input-error">* Este campo no debe quedar vacío y acepta solo texto.</p>
                    </div> -->
              <div class="input-user-tel input-prov" id="group-telefono">
                <label for="">Teléfono</label>
                <input type="number" name="telefono" id="telefono" class="input" placeholder="Introduce un teléfono">
                <p class="input-error">*Este campo debe ser númerico y tener 10 caracteres.</p>
              </div>
              <div class="input-user-email input-prov" id="group-correo">
                <label for="">Correo</label>
                <input type="email" name="correo" id="correo" class="input" placeholder="Introduce tu correo">
                <p class="input-error">*Este campo debe ser un tipo de E-mail valido.</p>
              </div>
              <div class="input-user-tel input-prov" id="group-contacto">
                <label for="">Contacto</label>
                <input type="text" name="contacto" id="contacto" class="input" placeholder="Introduce tu contacto">
                <p class="input-error">*Este campo debe ser númerico y tener 10 caracteres.</p>
              </div>
              <div class="input-user-name input-prov" id="group-cargo">
                <label for="">Cargo</label>
                <input type="text" name="cargo" id="cargo" class="input" placeholder="Introduce el cargo">
                <p class="input-error">*El nombre no debe quedar vacío, puede tener letras y acentos.</p>
              </div>
              <?php
              if($addProvCompras){
                echo '<input type="hidden" name="modalProveedor" id="modalProveedor" value="provCompra">';
              }
              ?>
              <!-- <hr> -->
              <br>
              <div class="input-submit modal-footer">
                <button type="button" class="btn-close-modal" data-bs-dismiss="modal"><i class="fa-solid fa-xmark fa-lg"></i> Cerrar</button>
                <?php
                if($addProvCompras){
                  echo '<button type="submit" class="btn-cfg" id="btn-send" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target=".seleccionar-prov"><i class="fa-solid fa-plus fa-lg"></i> Agregar.</button>';
                }else{
                  echo '<button type="submit" class="btn-cfg" id="btn-send"><i class="fa-solid fa-plus fa-lg"></i> Agregar</button>';
                }
                ?>
              </div>
            </form>
            </div>
            <br>
        </div>
    </div>
  </div>
</div>