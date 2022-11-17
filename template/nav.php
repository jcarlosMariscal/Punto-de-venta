<?php
require_once "config/Connection.php";
  require_once "logic/Read.php";
  $query = new Read();
  $readNegocio = $query->readNegocio($_SESSION['user']['id_negocio']); 
  
  foreach($readNegocio as $row){
    $logo = $row['logo'];
    $nombreNegocio = $row['nombre'];
    $telefonoNegocio = $row['telefono'];
    $correoNegocio = $row['correo'];
  }
?>
<nav id="navbar">
  <div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-transparent" style="width: 22vw">
    <div class="info-pv">
      <a href="index.php?p=main" class="d-flex align-items-center mb-3 mb-md-0 text-white text-decoration-none">
        <img src="../assets/img/logo/<?php echo $logo; ?>" class="imag img-fluid" alt="...">
        <span class="nombre-pv"><?php echo $nombreNegocio; ?></span>
      </a>
      <div class="close-toggle" id="close-toggle"><i class="fa-sharp fa-solid fa-xmark"></i></div>
    </div>
    <!-- <span>Bienvenido(a) al sistema</span> -->
    <hr>
    <ul class="navbar__ul">
      <li class="nav-item navbar__li">
        <a href="index.php?p=productos" class="ul__link" aria-current="page">
          <i class="nav-icon fa-solid fa-boxes-stacked"></i><span class="li__info">Productos</span>
        </a>
      </li>
      <li class="navbar__li">
        <a href="index.php?p=proveedor" class="text-white ul__link">
          <i class="nav-icon fa-solid fa-hands-holding-circle"></i>
          <span class="li__info">Proveedor</span>
        </a>
      </li>
      <li class="navbar__li">
        <a href="index.php?p=ventas" class="text-white ul__link">
          <i class="nav-icon fa-solid fa-file-invoice-dollar"></i>
          <span class="li__info">Ventas</span>
        </a>
      </li>
      <?php
      if($_SESSION['rol'] == 0){
        ?>
        <li class="navbar__li">
          <a href="index.php?p=compras" class="text-white ul__link">
            <i class="nav-icon fa-solid fa-handshake"></i>
            <span class="li__info">Compras</span>
          </a>
        </li>
        <li class="navbar__li">
          <a href="index.php?p=personal" class="text-white ul__link">
            <i class="nav-icon fa-solid fa-user-group"></i>
            <span class="li__info">Personal</span>
          </a>
        </li>
        <li class="navbar__li">
          <a href="index.php?p=configuration" class="text-white ul__link">
            <i class="nav-icon fa-solid fa-gears"></i>
            <span class="li__info">Configuración</span>
          </a>
        </li>
        <?php
      }
      ?>
    </ul>
    <hr>
    <div class="dropdown nav-final">
      <div class="system__logout">
        <a href="../cerrar_session/cerrar_session.php" class="logout"><i class="nav-icon fa-solid fa-arrow-left"></i><span class="li__info">Salir del Sistema</span></a>
      </div>
      <div class="fijar-nav">
        <label for="fijar">Fijar <span class="fij-men">menú</span></label>
        <input type="checkbox" name="fijar" id="fijar_nav">
      </div>
      <!-- <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
        <li><a class="dropdown-item" href="#">New project...</a></li>
        <li><a class="dropdown-item" href="#">Settings</a></li>
        <li><a class="dropdown-item" href="#">Profile</a></li>
        <li><hr class="dropdown-divider"></li>
        <li><a class="dropdown-item" href="#">Sign out</a></li>
      </ul> -->
    </div>
  </div>
</nav>