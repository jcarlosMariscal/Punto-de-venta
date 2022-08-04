<section class="above">
    <div class="above__info"><a href="index.php?p=main" class="btn-prm btn-above">Inicio</a>
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
<section class="content">
    <div class="content__start">
        <article class="start__details">
            <div class="details">                        
                <h3 class="details__title">Mi punto de venta </h3>
                <p class="details__text">Enfocarse en la sección de configuración, en donde se va a agregar la información del negocio, por defecto en la base de datos estarán cierta información genérica, cuándo el usuario decida cargar su propia información esta reemplazará a los datos genéricos. Por el momento ignorar los permisos para enfocarse en las funcionalidades.
                <br>
                También debería de quedar este fin de semana, tanto la configuración y el registro de personal.
                </p>
            </div>
            <div class="details__img">
                <img src="../assets/img/imagen.jpg" alt="">
            </div>
        </article>
        <article class="start__details row-reverse">
            <div class="details">                        
                <h3 class="details__title">Detalles de uso: </h3>
                <p class="details__text">
                  <ol>
                    <li>Registrarse (Información básica)</li>
                    <li>Dirigirse a su perfil para añadir más información relevante [EN DESARROLLO]</li>
                    <li>Agregar la información del negocio en <b>CONFIGURACIÓN</b>. [Los permisos quedan pendiente]</li>
                    <li>Agregar personal de ventas en <b>Mi Personal</b>. Agregar funcionalidad de eliminar y editar</li>
                    <li>Las otras secciones están en DESARROLLO</li>
                  </ol>
                </p>
            </div>
            <div class="details__img">
                <img src="../assets/img/imagen.jpg" alt="">
            </div>
        </article>
    </div>
</section>