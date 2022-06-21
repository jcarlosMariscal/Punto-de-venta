<?php  
    require_once '../vendor/autoload.php';
    $access_token='TEST-7206761180429716-061901-1941277a15f51f42ba9db1fcfd04396b-1016596979';
    MercadoPago\SDK::setAccessToken($access_token);
    $preference=new MercadoPago\Preference();

    $preference->back_urls=array(
        "success"=>"http://localhost/Punto-de-venta-main/view/index.php?p=compras",
        "failure"=>"http://localhost/Punto-de-venta-main/view/index.php",
        "pending"=>"http://localhost/Punto-de-venta-main/view/index.php"
    );

    $productos=[];
    $item=new MercadoPago\Item();
    $item->title='Galletas, Refresco, Detergente';
    $item->quantity=1;
    $item->unit_price=4900;
    array_push($productos, $item);

    $preference->items=$productos;
    $preference->save();

?>
<section class="above">
    <div class="above__info">En desarrollo</div>
    <div class="above__user">
        <div class="user__info">
            <p class="user__name">Víctor Manuel</p>
            <p class="user__rol">Administrador</p>
        </div>
        <div class="user__icon">
            <span class="icon-user"><i class="icon-font fa-solid fa-user"></i></span>
        </div>
    </div>
</section>
<hr>
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
        <td> Eliminar</td>
      </tr>
    </tbody>
    <tbody id="table-body">
      <tr class="prod">
        <td>Refreco</td>
        <td>10</td>
        <td> 19.00</td>
        <td> 1900.00</td>
        <td> Eliminar</td>
      </tr>
    </tbody>
    <tbody id="table-body">
      <tr class="prod">
        <td>Detergente</td>
        <td>100</td>
        <td> 20.00</td>
        <td> 2000.00</td>
        <td> Eliminar</td>
      </tr>
    </tbody>
  </table>
</section>
<section>
        <div class="contenedor-btn"></div>
        <script src="https://sdk.mercadopago.com/js/v2"></script>
        <script>
        // Agrega credenciales de SDK
        var public_key='TEST-4353f843-68ae-4db0-8311-db9130fa7618';
        const mp = new MercadoPago(public_key, {
            locale: "es-PE"
        });

        // Inicializa el checkout
        const checkout = mp.checkout({
            preference: {
            id: '<?php echo $preference->id; ?>',
            },
            render: {
            container: ".contenedor-btn", // Indica el nombre de la clase donde se mostrará el botón de pago
            label: "Realizar Pago", // Cambia el texto del botón de pago (opcional)
            },
        });
        </script>
</section>

