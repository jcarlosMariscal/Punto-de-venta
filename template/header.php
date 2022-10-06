<header class="py-3 mb-3 border-bottom">
  <div class="container-fluid header-container">
    <div class="dropdown">
      <div class="header-toggle" id="header-toggle"><i class="fa-solid fa-bars"></i></div>
      <!-- <a href="#" class="d-flex align-items-center col-lg-4 mb-2 mb-lg-0 link-white text-white text-decoration-none dropdown-toggle" id="dropdownNavLink" data-bs-toggle="dropdown" aria-expanded="false"> -->
      <a href="#" class="d-flex align-items-center col-lg-4 mb-2 mb-lg-0 link-white text-white text-decoration-none name-section" id="dropdownNavLink">
          <?php echo $nombreSeccion; ?>
      </a>
      <!-- <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownNavLink">
          <li><a class="dropdown-item active" href="#" aria-current="page">Overview</a></li>
          <li><a class="dropdown-item" href="#">Inventory</a></li>
          <li><a class="dropdown-item" href="#">Customers</a></li>
          <li><a class="dropdown-item" href="#">Products</a></li>
          <li><hr class="dropdown-divider"></li>
          <li><a class="dropdown-item" href="#">Reports</a></li>
          <li><a class="dropdown-item" href="#">Analytics</a></li>
      </ul> -->
    </div>

    <div class="align-items-center header-user">
      <div class="info-sucursal">
        <p class="text-white">Sucursal: <span id="id_sucursal"><?php echo $_SESSION['user']['id_sucursal']; ?></span></p>
      </div>
        <div class="information">
          <a href="index.php?p=information"><i class="fa-solid fa-circle-question"></i></a>
        </div>
        <!-- <div class="rol-name-user">
          <span></span>
        </div> -->
        <div class="flex-shrink-0 dropdown">
          <a href="#" class="d-block text-decoration-none dropdown-toggle" id="dropdownUser2" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="https://github.com/mdo.png" alt="mdo" width="32" height="32" class="rounded-circle">
          </a>
          <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser2">
            <li><span><?php echo $_SESSION['user']['nombre']; ?></span></li>
            <li><span>
              <?php 
              if($_SESSION['rol'] == 0){
                echo "Administrador";
              }else if($_SESSION['rol'] == 1){
                echo "Gerente";
              }else if($_SESSION['rol'] == 2){
                echo "Vendedor";
              }?>
            </span></li>
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

