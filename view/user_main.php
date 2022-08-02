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
<section class="content">
    <div class="box-main">
        <div class="box box-1">
            <canvas id="chart1" ></canvas>
            <!-- <p>Ventas de Personal de ventas</p> -->
        </div>
        <div class="box box-2">
            <canvas id="chart2" ></canvas>
        </div>
        <div class="box box-3">
            <canvas id="chart3" ></canvas>
        </div>
        <div class="box box-4">
            <div class="main-btns">
                <div class="btn-charts">
                    <a href="" class="btn-chart"><span><i class="fa-solid fa-chart-simple"></i></span> Generar Gráficas</a>
                </div>
                <div class="btn-reports">
                    <a href="" class="btn-chart"><span><i class="fa-solid fa-file-circle-plus"></i></i></span> Ver Reportes</a>
                </div>
                <div class="btn-code">
                    <a href="" class="btn-chart"><span><i class="fa-solid fa-barcode"></i></span> Código de Barras</a>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="../assets/js/chart.js" type="module"></script>

<!-- https://getcssscan.com/css-box-shadow-examples -->