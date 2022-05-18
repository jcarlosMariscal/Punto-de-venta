<section class="above">
    <div class="above__info">Mi Personal
      <!-- <a href="index.php?p=compras" class="btn-prm btn-cancelar">Atrás</a> -->
    </div>
    <div class="above__user">
        <div class="user__info">
            <p class="user__name">Carlos Mariscal</p>
            <p class="user__rol">Administrador</p>
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
                  </tr>
                </thead>
                <tbody>
                  <tr class="prod">
                      <td>1</td>
                      <td>Carlos Mariscal</td>
                      <td>prueba@gmail.com</td>
                      <td>123456789</td>
                      <td>Administrador</td>
                      <td>Eliminar</td>
                      <td>Editar</td>
                      <td>Ver</td>
                  </tr>
                  <tr class="prod">
                      <td>1</td>
                      <td>Carlos Mariscal</td>
                      <td>prueba@gmail.com</td>
                      <td>123456789</td>
                      <td>Administrador</td>
                      <td>Eliminar</td>
                      <td>Editar</td>
                      <td>Ver</td>
                  </tr>
                  <tr class="prod">
                      <td>1</td>
                      <td>Carlos Mariscal</td>
                      <td>prueba@gmail.com</td>
                      <td>123456789</td>
                      <td>Administrador</td>
                      <td>Eliminar</td>
                      <td>Editar</td>
                      <td>Ver</td>
                  </tr>
                </tbody>
            </table>
        </div>
    </section>

<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Agregar nuevo usuario</h5>
            <span data-dismiss="modal" aria-label="Close" class="close"><i class="fa-solid fa-xmark"></i></span>
        </div>
        <div class="modal-body">
            <div class="permisos">
                <form action="" class="form-user">
                    <div class="input-user-name input-user">                                       
                        <label for="">Nombre: </label>
                        <input type="text" name="" id="" class="input" placeholder="Introduce un nombre">
                    </div>
                    <div class="input-user-rfc input-user">                                       
                      <label for="">R.F.C.: </label>
                        <input type="text" name="" id="" class="input" placeholder="Introduce">
                    </div>
                    <div class="input-user-fnac input-user">                                       
                      <label for="">Fecha de Nacimiento</label>
                        <input type="date" name="" id="" class="input">
                    </div>
                    <div class="input-user-tel input-user">                                       
                      <label for="">Teléfono</label>
                        <input type="number_format" name="" id="" class="input">
                    </div>
                    <div class="input-user-email input-user">                                       
                      <label for="">Correo</label>
                        <input type="text" name="" id="" class="input">
                    </div>
                    <div class="input-user-rol input-user">                                       
                      <label for="">Seleccione el Rol:</label>
                      <select name="" id="" class="select-user-rol">
                        <option value="">Administrador</option>
                        <option value="">Ventas</option>
                      </select>
                    </div>
                    <div class="input-user-caja input-user">                                       
                      <label for="">Caja</label>
                        <input type="text" name="" id="" class="input">
                    </div>
                    <div class="input-user-password input-user">                                       
                      <label for="">Contraseña</label>
                        <input type="text" name="" id="" class="input">
                    </div>
                  </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-close-modal" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn-save-modal">Agregar</button>
            </div>
        </div>
    </div>
  </div>
</div>