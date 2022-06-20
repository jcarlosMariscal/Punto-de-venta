<section class="above">

    <div class="above__info">En desarrollo Ventas

<button type="button" class="btn btn-danger">Mis Ventas</button>
<button type="button" class="btn btn-danger">Mi reporte</button>
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

<h3><div class="above__info">Informacion de ventas  </div></h3>

<div class="card-group">
    <div class="card-body">
    <div class="above__info">Venta realizada por:  </div>
    <div class="above__info">No. de transaccion:   </div>
    </div>
  
  
    <div class="card-body">
    <div class="above__info">No. de caja:   </div>
    <div class="above__info">Fecha Venta: </div>
    </div>
 
  
    <div class="card-body">
    <div class="above__info">Total en caja:  </div>
    </div>
  
</div>

<br>
<table table bgcolor= "#FFFFFF"  class="table table-bordered">
  <thead>
    <tr>
      <th scope="col">Id. Producto</th>
      <th scope="col">Nombre</th>
      <th scope="col">Categoria</th>
      <th scope="col">Precio Unidad</th>
      <th scope="col">Stok</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">255685336363</th>
      <td>Arroz</td>
      <td> Alimentos</td>
      <td> $850.00</td>
      <td> 50</td>
    </tr>
    <tr>
      <th scope="row">1</th>
      <td> </td>
      <td> </td>
      <td> </td>
      <td> </td>
    </tr>
    <tr>
      <th scope="row">2</th>
      <td> </td>
      <td> </td>
      <td> </td>
      <td> </td>
    </tr>
    <th scope="row">2</th>
      <td> </td>
      <td> </td>
      <td> </td>
      <td> </td>
    </tr>
    <th scope="row">3</th>
      <td> </td>
      <td> </td>
      <td> </td>
      <td> </td>
    </tr>
    <th scope="row">3</th>
      <td> </td>
      <td> </td>
      <td> </td>
      <td> </td>
    </tr>
    <th scope="row">3</th>
      <td> </td>
      <td> </td>
      <td> </td>
      <td> </td>
    </tr>
  </tbody>
</table>

<div class="card-group">
  
        <div class="card-body">
    <div class="above__info">Total de venta  </div>
    <div class="above__info">$  </div>
    </div>
  
 
    <div class="card-body">
    <div class="above__info">Efectivo cliente:   </div>
    <input class="form-control"  placeholder="$" readonly>
 
  </div>
  
    <div class="card-body">
    <div class="above__info">Cambio de cliente:  </div>
    <div class="above__info">$:  </div>
    
  </div>
  
    <div class="card-body">
    <button type="button" class="btn btn-danger">Imprimir tiket</button>
    <button type="button" class="btn btn-danger">Realizar venta</button>
    
  </div>
</div>
