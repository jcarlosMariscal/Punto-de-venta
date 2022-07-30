<section class="above">
    <div class="above__info">En desarrollo</div>
    <div class="above__user">
        <div class="user__info" id="user-info">
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
        <div class="user__icon" id="user-icon">
            <a href="" id="profile"><span class="icon-user"><i class="icon-font fa-solid fa-user"></i></span></a>
        </div>
      </div>
      <div class="user__profile" id="user-profile">
        <div class="profile__name"><p class="user__name"><?php echo $_SESSION['user']?></p></div>
        <div class="profile__rol"><p class="">
                <?php 
                    if($_SESSION['rol'] == 1){
                        echo "Administrador";
                    }elseif ($_SESSION['rol'] == 2) {
                        echo "Vendedor";
                    }
                ?>
            </p>
        </div>
        <div class="profile__correo"><?php echo $_SESSION['correo']?></div>
        <div class="profile__telefono"><?php echo $_SESSION['telefono']?></div>
      </div>
</section>
<hr>

<section class="ver-compras">
    <section class="table-ver-product">
        <div class="table-above">
            <div class="product-filter">
                <form action="">
                    <label for="">Buscar por: </label>
                    <select name="" id="">
                        <option value="">Proveedor</option>
                        <option value="">Producto</option>
                        <option value="">Precio</option>
                    </select>
                </form>
            </div>
            <div class="product-chart">
                <a href="index.php?p=compras" class="btn-prm btn-cancelar">Graficar</a>
            </div>
        </div>
        <div class="table-ver">
            <table table bgcolor= "#FFFFFF"  class="table table-bordered">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">PROVEEDOR</th>
                    <th scope="col">CAN. PRODUCTOS</th>
                    <th scope="col">FECHA</th>
                    <th scope="col">TOTAL</th>
                </tr>
                </thead>
                <tbody>
                <tr class="prod">
                    <td>1</td>
                    <td>Pepsi</td>
                    <td>10</td>
                    <td>16/05/2022</td>
                    <td>5.00</td>
                    <td class="text-center"><a href="" class="btn-tb-info"><i class="fa-solid fa-circle-info"></i></a></td>
                    <td class="text-center"><a href="" class="btn-tb-report"><i class="fa-solid fa-file-invoice"></i></a></td>
                </tr>
                <tr class="prod">
                    <td>1</td>
                    <td>Pepsi</td>
                    <td>10</td>
                    <td>16/05/2022</td>
                    <td>5.00</td>
                    <td class="text-center"><a href="" class="btn-tb-info"><i class="fa-solid fa-circle-info"></i></a></td>
                    <td class="text-center"><a href="" class="btn-tb-report"><i class="fa-solid fa-file-invoice"></i></a></td>
                </tr>
                <tr class="prod">
                    <td>1</td>
                    <td>Pepsi</td>
                    <td>10</td>
                    <td>16/05/2022</td>
                    <td>5.00</td>
                    <td class="text-center"><a href="" class="btn-tb-info"><i class="fa-solid fa-circle-info"></i></a></td>
                    <td class="text-center"><a href="" class="btn-tb-report"><i class="fa-solid fa-file-invoice"></i></a></td>
                </tr>
                <tr class="prod">
                    <td>1</td>
                    <td>Pepsi</td>
                    <td>10</td>
                    <td>16/05/2022</td>
                    <td>5.00</td>
                    <td class="text-center"><a href="" class="btn-tb-info"><i class="fa-solid fa-circle-info"></i></a></td>
                    <td class="text-center"><a href="" class="btn-tb-report"><i class="fa-solid fa-file-invoice"></i></a></td>
                </tr>
                <tr class="prod">
                    <td>1</td>
                    <td>Pepsi</td>
                    <td>10</td>
                    <td>16/05/2022</td>
                    <td>5.00</td>
                    <td class="text-center"><a href="" class="btn-tb-info"><i class="fa-solid fa-circle-info"></i></a></td>
                    <td class="text-center"><a href="" class="btn-tb-report"><i class="fa-solid fa-file-invoice"></i></a></td>
                </tr>
                <tr class="prod">
                    <td>1</td>
                    <td>Pepsi</td>
                    <td>10</td>
                    <td>16/05/2022</td>
                    <td>5.00</td>
                    <td class="text-center"><a href="" class="btn-tb-info"><i class="fa-solid fa-circle-info"></i></a></td>
                    <td class="text-center"><a href="" class="btn-tb-report"><i class="fa-solid fa-file-invoice"></i></a></td>
                </tr>
                <tr class="prod">
                    <td>1</td>
                    <td>Pepsi</td>
                    <td>10</td>
                    <td>16/05/2022</td>
                    <td>5.00</td>
                    <td class="text-center"><a href="" class="btn-tb-info"><i class="fa-solid fa-circle-info"></i></a></td>
                    <td class="text-center"><a href="" class="btn-tb-report"><i class="fa-solid fa-file-invoice"></i></a></td>
                </tr>
                <tr class="prod">
                    <td>1</td>
                    <td>Pepsi</td>
                    <td>10</td>
                    <td>16/05/2022</td>
                    <td>5.00</td>
                    <td class="text-center"><a href="" class="btn-tb-info"><i class="fa-solid fa-circle-info"></i></a></td>
                    <td class="text-center"><a href="" class="btn-tb-report"><i class="fa-solid fa-file-invoice"></i></a></td>
                </tr>
                <tr class="prod">
                    <td>1</td>
                    <td>Pepsi</td>
                    <td>10</td>
                    <td>16/05/2022</td>
                    <td>5.00</td>
                    <td class="text-center"><a href="" class="btn-tb-info"><i class="fa-solid fa-circle-info"></i></a></td>
                    <td class="text-center"><a href="" class="btn-tb-report"><i class="fa-solid fa-file-invoice"></i></a></td>
                </tr>
                <tr class="prod">
                    <td>1</td>
                    <td>Pepsi</td>
                    <td>10</td>
                    <td>16/05/2022</td>
                    <td>5.00</td>
                    <td class="text-center"><a href="#" class="btn-tb-info"><i class="fa-solid fa-circle-info"></i></a></td>
                    <td class="text-center"><a href="#" class="btn-tb-report"><i class="fa-solid fa-file-invoice"></i></a></td>
                </tr>
                </tbody>
            </table>
        </div>
    </section>
    <section class="ultima-compra">
        <h5 class="ultima-titulo text-center">Última Compra</h5>
        <div class="ultima-detalles">
            <p class="ultima__data">Día: 16/05/2022</p>
            <p class="ultima__data">Proveedor: Prueba</p>
            <p class="ultima__data">Total: $500.00</p>
            <p class="ultima__data">Total productos: 22</p>
            <hr>
            <p class="product">5 Galletas - $100.00</p>
            <p class="product">10 Paletas - $100.00</p>
            <p class="product">15 refrescos - $100.00</p>
            <p class="product">50 Sabritas - $100.00</p>
            <p class="product">30 Aceites - $100.00</p>
        </div>
        <div class="btn-ultimos-productos">
            <a href="index.php?p=compras" class="btn-prm prm-info"><i class="fa-solid fa-circle-info"></i></a>
            <a href="index.php?p=compras" class="btn-prm prm-report"><i class="fa-solid fa-file-invoice"></i></a>
        </div>
    </section>
</section>