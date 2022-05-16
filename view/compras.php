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
    <form action="" class="form-add-product">
        <div class="input-nom-proveedor input-compra">
            <label for="">Nom. Proveedor: </label>
            <input type="text" class="input input-cpr">
            <a href="" class="seleccionar"><i class="fa-solid fa-check-to-slot"></i></a>
        </div>
        <div class="input-nom-producto input-compra">
            <label for="">Nom. Producto: </label>
            <input type="text" class="input input-cpr">
            <a href="" class="seleccionar"><i class="fa-solid fa-check-to-slot"></i></a>
        </div>
        <div class="input-cantidad input-compra">
            <label for="">Cantidad: </label>
            <input type="text" class="input input-cpr">
        </div>
        <div class="input-precio-compra input-compra">
            <label for="">Precio Compra: </label>
            <input type="text" class="input input-cpr">
        </div>
        <div class="input-precio-venta input-compra">
            <label for="">Precio Venta: </label>
            <input type="text" class="input input-cpr">
        </div>
        <div class="input-compra-submit">
            <input type="submit" class="btn-prm btn-compra" value="Agregar Producto">
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
    <tbody>
      <tr class="prod">
        <td>Galleta</td>
        <td>100</td>
        <td> 10.00</td>
        <td> 1000.00</td>
        <td> Eliminar</td>
      </tr>
      <tr>
        <td>1</td>
        <td> </td>
        <td> </td>
        <td> </td>
        <td> </td>
      </tr>
      <tr>
        <td>2</td>
        <td> </td>
        <td> </td>
        <td> </td>
        <td> </td>
      </tr>
      <tr>
        <td>3</td>
        <td> </td>
        <td> </td>
        <td> </td>
        <td> </td>
      </tr>
      <tr>
        <td>3</td>
        <td> </td>
        <td> </td>
        <td> </td>
        <td> </td>
      </tr>
      <tr>
        <td>3</td>
        <td> </td>
        <td> </td>
        <td> </td>
        <td> </td>
      </tr>
      <tr>
        <td>3</td>
        <td> </td>
        <td> </td>
        <td> </td>
        <td> </td>
      </tr>
    </tbody>
  </table>
</section>
<section class="info-compra">
  <div class="compra__total">
    <p class="total">Total a pagar: <b>$1000.00</b></p>
  </div>
  <div class="btns-compra">
    <a href="" class="btn-prm btn-cancelar">Cancelar</a>
    <a href=""class="btn-prm btn-compra">Comprar</a>
  </div>
</section>