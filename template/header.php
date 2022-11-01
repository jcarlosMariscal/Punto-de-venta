<?php
  require_once "config/Connection.php";
  require_once "logic/Read.php";
  $query = new Read();
  $readNameSucursal = $query->selectTableId('sucursal', 'id_sucursal', $_SESSION['user']['id_sucursal'], 'nombre');
  $readName = $readNameSucursal->fetch(); // Obtener el registro de la consulta
?>

<header class="py-3 mb-3 border-bottom">
  <div class="container-fluid header-container">
    <div class="dropdown">
      <div class="header-toggle" id="header-toggle"><i class="fa-solid fa-bars"></i></div>
      <a href="#" class="d-flex align-items-center col-lg-4 mb-2 mb-lg-0 link-white text-white text-decoration-none dropdown-toggle" id="dropdownNavLink" data-bs-toggle="dropdown" aria-expanded="false"><?php echo $nombreSeccion; ?></a>

      <!-- <a href="ver-compras.php" class="btn btn-prm">Ver Compras</a> -->
      <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownNavLink">
          <li><a class="dropdown-item" href="index.php?p=ver-compras" aria-current="page">Ver compras</a></li>
          <li><a class="dropdown-item" href="#">Productos</a></li>
          <li><a class="dropdown-item" href="#">Proveedores</a></li>
          <li><a class="dropdown-item" href="#">Products</a></li>
          <li><hr class="dropdown-divider"></li>
          <li><a class="dropdown-item" href="#">Ayuda</a></li>
      </ul>
    </div>

    <div class="align-items-center header-user">
        <div class="information">
          <a href="index.php?p=information"><i class="fa-solid fa-circle-question"></i></a>
        </div>
        <div class="rol-user">
          <span class="text-white">
            <?php 
              if($_SESSION['rol'] == 0){
                echo "Administrador";
              }else if($_SESSION['rol'] == 1){
                echo "Gerente";
              }else if($_SESSION['rol'] == 2){
                echo "Vendedor";
              }?>
          </span>
        </div>
        <div class="flex-shrink-0 dropdown">
          <a href="#" class="d-block text-decoration-none dropdown-toggle" id="dropdownUser2" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="https://github.com/mdo.png" alt="mdo" width="32" height="32" class="rounded-circle">
          </a>
          <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser2">
            <li><a href="#" class="dropdown-item"><span><?php echo $_SESSION['user']['nombre']; ?></span></a></li>
            <!-- <li><span>
              <?php 
              if($_SESSION['rol'] == 0){
                echo "Administrador";
              }else if($_SESSION['rol'] == 1){
                echo "Gerente";
              }else if($_SESSION['rol'] == 2){
                echo "Vendedor";
              }?>
            </span></li> -->
            <li><a href="#" class="dropdown-item"><span class=" d-flex align-items-center"><span id="nombre_sucursal"><?php echo $readName['nombre']; ?></span> <span id="id_sucursal" hidden><?php echo $_SESSION['user']['id_sucursal']; ?></span></span> </a></li>
            <li><a class="dropdown-item" href="#">Reportes</a></li>
            <li><a class="dropdown-item" href="#">Mi información</a></li>
            <!-- <li><a class="dropdown-item" href="#">Profile</a></li> -->
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="../cerrar_session/cerrar_session.php">Cerrar sesión</a></li>
          </ul>
        </div>
      </div>
    </div>
  </header>

