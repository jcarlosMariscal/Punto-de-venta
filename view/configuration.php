<section class="above">
    <div class="above__info">En desarrollo</div>
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
<section class="content">
    <div class="config">
        <div class="config__form">
            <h4>Datos del negocio</h4>
            <form action="" class="form">
                <div class="form-inputs">
                    <div class="input-nombre input-cfg">
                        <label for="" class="label">Razón Social:</label>
                        <input type="text" class="input input-config" placeholder="Introduce la razón social de la empresa" name="" required >
                        <p class="input-error">*Rellena el este campo correctamente por favor</p>
                    </div>
                    <div class="input-rfc input-cfg">
                        <label for="" class="label">R. F. C.: </label>
                        <input type="text" class="input input-config" placeholder="Introduce la rfc" name="" required >
                        <p class="input-error">*Rellena el este campo correctamente por favor</p>
                    </div>
                    <div class="input-domicilio input-cfg">
                        <label for="" class="label">Domicilio: </label>
                        <input type="text" class="input input-config" placeholder="Introduce el domicilio" name="" required >
                    </div>
                    <div class="input-cPostal input-cfg">
                        <label for="" class="label">C. Postal: </label>
                        <input type="text" class="input input-config" placeholder="Introduce el código postal" name="" required >
                    </div>
                    <div class="input-telefono input-cfg">
                        <label for="" class="label">Teléfono: </label>
                        <input type="text" class="input input-config" placeholder="Introduce el teléfono" name="" required >
                    </div>
                </div>
                <div class="form-logo">
                    <div class="logo-current">
                        <img class="currently" src="https://i.pinimg.com/originals/33/b8/69/33b869f90619e81763dbf1fccc896d8d.jpg" alt="">
                    </div>
                    <div class="custom-input-file col-md-6 col-sm-6 col-xs-6">
                        <input type="file" id="fichero-tarifas" class="input-file" value="">
                        Subir Logo
                    </div>
                </div>
                <div class="input-submit">
                    <input type="submit" class="btn-cfg" value="Guardar Cambios">
                </div>
            </form>
        </div>
        <hr>
        <div class="config__permissions">
            <div class="permissions-admin">
                <a href="#" class="btn-prm" data-toggle="modal" data-target=".bd-example-modal-lg">Permisos de Administrador</a>
            </div>
            <div class="permissions-seller">
                <a href="" class="btn-prm">Permisos del Personal de Ventas</a>
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