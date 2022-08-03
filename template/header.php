<?php

include ("../conexion/conexion.php");

$query = "select * from configuracion ORDER BY id DESC LIMIT 1";
$resultado = mysqli_query($con, $query);
foreach ($resultado as $row) { 
  $imagen = $row['imagen'];
  $razon_social = $row['razon_social'];
}

?>

<header class="header">
  <div class="system">
    <div class="system__info">
      <div class="info__logo">
        <a href="index.php?p=main" class="ul__link"><img style="border-radius: 50px ;" src="../imagenes/<?php echo $imagen; ?>" class="imag img-fluid" alt="..."></a>
      </div>
      <div class="info__text">
        <h3 class="info__name"><?php echo $razon_social; ?></h3>
        <!-- <h5 class="info__welcome">Bienvenido(a) al sistema</h5> -->
      </div>
    </div>
    <hr class="separate">
    <div class="system__logout">
      <a href="../cerrar_session/cerrar_session.php" class="logout"><i class="nav-icon fa-solid fa-arrow-left"></i><span class="li__info">Salir del Sistema</span></a>
    </div>
  </div>
  <nav class="navbar">
    <ul class="navbar__ul">
      <li class="navbar__li"><a href="index.php?p=productos" class="ul__link"><i class="nav-icon fa-solid fa-boxes-stacked"></i><span class="li__info">Productos</span></a></li>
      <li class="navbar__li"><a href="index.php?p=proveedor" class="ul__link"><i class="nav-icon fa-solid fa-hands-holding-circle"></i><span class="li__info">Proveedor</span></a></li>
      <li class="navbar__li"><a href="index.php?p=ventas" class="ul__link"><i class="nav-icon fa-solid fa-file-invoice-dollar"></i><span class="li__info">Ventas</span></a></li>
      <!-- PERMITIR EL ACCESO A ESTAS SECCIONES A SOLO EL ADMINISTRADOR -->
      <?php
        if($_SESSION['rol'] == 1){
      ?>
      <li class="navbar__li"><a href="index.php?p=compras" class="ul__link"><i class="nav-icon fa-solid fa-handshake"></i><span class="li__info">Compras</span></a></li>
      <li class="navbar__li"><a href="index.php?p=personal" class="ul__link"><i class="nav-icon fa-solid fa-user-group"></i><span class="li__info">Mi personal</span></a></li>
      <li class="navbar__li"><a href="index.php?p=configuration" class="ul__link"><i class="nav-icon fa-solid fa-gears"></i><span class="li__info">Configuración</span></a></li>
      <?php
        }
      ?>
      <li class="navbar__li"><a href="index.php?p=information" class="ul__link"><i class="nav-icon fa-solid fa-circle-info"></i><span class="li__info">Información del Sistema</span></a></li>
    </ul>
  </nav>
</header>