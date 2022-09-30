<section class="above">
    <div class="above__info">Sucursal
      <!-- <a href="index.php?p=compras" class="btn-prm btn-cancelar">Atrás</a> -->
    </div>
    <div class="above__user">
        <div class="user__info">
            <p class="user__name"><?php echo $_SESSION['user']?></p>
            <p class="user__rol">
                <?php 
                    if($_SESSION['rol'] == 0){
                        echo "Administrador";
                    }elseif ($_SESSION['rol'] == 1) {
                        echo "Gerente";
                    }elseif ($_SESSION['rol'] == 2) {
                        echo "Ventas";
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

<section class=""></section>
    <!-- AGREGAR -->


<script src="../assets/js/sucursal.js" type="module"></script> <!-- CREAR SOLO SI NECESITA IMPLEMENTAR JS -->

