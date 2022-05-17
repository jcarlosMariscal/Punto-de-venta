<section class="above">
    <div class="above__info">En desarrollo mi personal</div>
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


<div class="card-group">
    <div class="card-body">
     <div class="above__info">Recuerde revisar los permisos de usuario en la configuracion</div>
    </div>


  <div class="row" class="card-body">
  <span class="float-right"><button type="button" class=" btn btn-danger " data-toggle="modal" data-target=".bd-example-modal-lg">Agregar</button></span>
  
  </div>
</div>

<table table bgcolor= "#FFFFFF" class="table table-bordered">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Nombre</th>
      <th scope="col">Correo</th>
      <th scope="col">Telefono</th>
      <th scope="col">Rol</th>
      <th scope="col">Eliminar</th>
      <th scope="col">Editar</th>
      <th scope="col">Ver</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td>Mark</td>
      <td>Otto</td>
      <td>@mdo</td>
      <td>@mdo</td>
      <td> </td>
      <td> </td>
    </tr>
    <tr>
      <th scope="row">2</th>
      <td>Jacob</td>
      <td>Thornton</td>
      <td>@fat</td>
      <td>@fat</td>
      <td> </td>
      <td> </td>
    </tr>
    <tr>
      <th scope="row">3</th>
      <td>Mark</td>
      <td>Otto</td>
      <td>@mdo</td>
      <td>@fat</td>
      <td> </td>
      <td> </td>
    </tr>
    <tr>
      <th scope="row">4</th>
      <td>Mark</td>
      <td>Otto</td>
      <td>@mdo</td>
      <td>@fat</td>
      <td> </td>
      <td> </td>
    </tr>
    
  </tbody>
</table>

<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Agregar nuevo usuario</h5>
            <span data-dismiss="modal" aria-label="Close" class="close"><i class="fa-solid fa-xmark"></i></span>
        </div>
        <div class="modal-body">
            <div class="permisos">
                <form action="" class="">
                    <div class="inputs">                                       
                      <label for="">Nombre</label>
                        <input type="text" name="" id="">
                    </div>
                    <div class="inputs">                                       
                      <label for="">R.F.C.</label>
                        <input type="text" name="" id="">
                    </div>
                    <div class="inputs">                                       
                      <label for="">Fecha de Nacimiento</label>
                        <input type="text" name="" id="">
                    </div>
                    <div class="inputs">                                       
                      <label for="">Teléfono</label>
                        <input type="text" name="" id="">
                    </div>
                    <div class="inputs">                                       
                      <label for="">Correo</label>
                        <input type="text" name="" id="">
                    </div>
                    <div class="inputs">                                       
                      <label for="">Rol</label>
                      <select name="" id="">
                        <option value="">Administrador</option>
                        <option value="">Ventas</option>
                      </select>
                    </div>
                    <div class="inputs">                                       
                      <label for="">Caja</label>
                        <input type="text" name="" id="">
                    </div>
                    <div class="inputs">                                       
                      <label for="">Contraseña</label>
                        <input type="text" name="" id="">
                    </div>
                    <div class="inputs">                                       
                      <label for="">Repetir contraseña</label>
                        <input type="text" name="" id="">
                    </div>
                  </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-close-modal" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn-save-modal">Guardar Cambios</button>
            </div>
        </div>
    </div>
  </div>
</div>