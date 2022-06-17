<section class="above">
    <div class="above__info">Compras
      <a href="index.php?p=ver-compras" class="btn-prm btn-cancelar">Ver Compras</a>
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
<section class="add-product">
    <h5><div class="above__info">Realizar una compra</div></h5>
    <form action="" class="form-add-product" id="formulario">
        <div class="input-nom-proveedor input-compra" id="group-nombre_prov">
            <label for="">Nom. Proveedor: </label>
            <input type="text" class="input input-cpr form-incorrecto" id="nombre_prov" name="nombre_prov">
            <a href="" class="seleccionar"><i class="fa-solid fa-check-to-slot"></i></a>
        </div>
        <div class="input-nom-producto input-compra" id="group-producto_prov">
            <label for="">Nom. Producto: </label>
            <input type="text" class="input input-cpr" id="producto_prov" name="producto_prov">
            <a href="" class="seleccionar"><i class="fa-solid fa-check-to-slot"></i></a>
        </div>
        <div class="input-cantidad input-compra" id="group-cantidad_prov">
            <label for="">Cantidad: </label>
            <input type="text" class="input input-cpr" id="cantidad_prov" name="cantidad_prov">
        </div>
        <div class="input-precio-compra input-compra" id="group-pcompra_prov">
            <label for="">Precio Compra: </label>
            <input type="text" class="input input-cpr" id="pcompra_prov" name="pcompra_prov">
        </div>
        <div class="input-precio-venta input-compra" id="group-pventa_prov">
            <label for="">Precio Venta: </label>
            <input type="text" class="input input-cpr" id="pventa_prov" name="pventa_prov">
        </div>
        <div class="input-compra-submit">
            <input type="submit" class="btn-prm btn-compra" value="Agregar Producto" id="btn-send">
        </div>
    </form>
</section>
<section class="table-product">
  <table table bgcolor= "#FFFFFF"  class="table table-bordered">
    <thead>
      <tr>
        <th scope="col">PRODUCTO</th>
        <th scope="col">CANTIDAD</th>
        <th scope="col">PRECIO COMPRA</th>
        <th scope="col">SUB TOTAL</th>
      </tr>
    </thead>
    <tbody id="table-body">
      <tr class="prod">
        <td>Galleta</td>
        <td>100</td>
        <td> 10.00</td>
        <td> 1000.00</td>
        <td class="text-center"><a href="" class="btn-tb-delete"><i class="fa-solid fa-trash-can"></i></a></td>
      </tr>
    </tbody>
  </table>
</section>
<section class="info-compra">
  <div class="compra__total">
    <p class="total">Total a pagar: <b>$</b><b id="total-pagar">1000.00</b></p>
  </div>
  <div class="btns-compra">
    <a href="" class="btn-prm btn-cancelar">Cancelar</a>
    <a href=""class="btn-prm btn-compra">Comprar</a>
  </div>
</section>