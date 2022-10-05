<?php
ob_start();

include "../config/Connection.php";
$cnx = Connection::connectDB();
$id_personal = (isset($_GET['id_personal']) ? $_GET['id_personal'] : NULL);
$id_img = (isset($_GET['logo']) ? $_GET['logo'] : NULL);

?>


  <style>
*,
*::after {
  box-sizing: border-box;
  margin: 0;
}

body {
  display: flex;
  align-items: center;
  justify-content: center;
  min-height: 100vh;
  color: #454f54;
  
  background-color: #f4f5f6;
  background-image: linear-gradient(to bottom left, #abb5ba, #d5dadd);
}

.ticket {
  display: grid;
  grid-template-rows: auto 1fr auto;
  max-width: 24rem;
}
.ticket__header, .ticket__body, .ticket__footer {
  padding: 1.25rem;
  background-color: #F4F4F4;
  border: 1px solid #abb5ba;
  box-shadow: 0 2px 4px rgba(41, 54, 61, 0.25);
}
.ticket__header {
  font-size: 1.5rem;
  border-top: 0.50rem solid #0c2a2e;
  border-bottom: none;
  box-shadow: none;
}
.ticket__wrapper {
  box-shadow: 0 2px 4px rgba(41, 54, 61, 0.25);
  border-radius: 0.375em 0.375em 0 0;
  overflow: hidden;
}
.ticket__divider {
  position: relative;
  height: 1rem;
  background-color: #5F939A;
  margin-left: 0.5rem;
  margin-right: 0.5rem;
}
.ticket__divider::after {
  content: "";
  position: absolute;
  height: 50%;
  width: 100%;
  top: 0;
  border-bottom: 2px dashed #e9ebed;
}
.ticket__notch {
  position: absolute;
  left: -0.5rem;
  width: 1rem;
  height: 1rem;
  overflow: hidden;
}
.ticket__notch::after {
  content: "";
  position: relative;
  display: block;
  width: 2rem;
  height: 2rem;
  right: 100%;
  top: -50%;
  border: 0.5rem solid white;
  border-radius: 50%;
  box-shadow: inset 0 2px 4px rgba(41, 54, 61, 0.25);
}
.ticket__notch--right {
  left: auto;
  right: -0.5rem;
}
.ticket__notch--right::after {
  right: 0;
}
.ticket__body {
  border-bottom: none;
  border-top: none;
}
.ticket__body > * + * {
  margin-top: 1.5rem;
  padding-top: 1.5rem;
  border-top: 1px solid #e9ebed;
}
.ticket__section > * + * {
  margin-top: 0.25rem;
}
.ticket__section > h3 {
  font-size: 1.125rem;
  margin-bottom: 0.5rem;
}
.ticket__header, .ticket__footer {
  font-weight: bold;
  font-size: 1.25rem;
  display: flex;
  justify-content: space-between;
}
.ticket__footer {
  border-top: 2px dashed #e9ebed;
  border-radius: 0 0 0.325rem 0.325rem;
}
    
</style>
  <!-- <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css'> -->


  <?php
$sql = "SELECT * FROM personal WHERE id_personal = ?";
$query = $cnx->prepare($sql);
$query->bindParam(1, $id_personal);
$query->execute();
$res = $query;
foreach ($res as $row) {
    $id_user = $row['id_personal'];
    $nombre = $row['nombre'];
    $correo = $row['correo'];
    $telefono = $row['telefono'];
    $ciudad = $row['ciudad'];
    $domicilio = $row['domicilio'];
    $id_sucursal = $row['id_sucursal'];
    $id_caja = $row['id_caja'];     
    $id_rol = $row['id_rol']; 
}
?>

  
<div class="ticket">
  <header class="ticket__wrapper">
    <div class="ticket__header">
      <?php
    include("../../conexion/conexion.php");
    $query = "select * from negocio ORDER BY id_negocio DESC LIMIT 1";
    $resultado = mysqli_query($con, $query);
    foreach ($resultado as $row) {
    $logo = $row['logo'];
    $nomb = $row['nombre'];
    }

    ?>
    <img src="http://localhost/Punto-de-venta-develop/assets/img/logo/<?php echo $logo ?>" width="50" alt="">
    <h3>Información del personal</h3>      
    </div>
  </header>
  <div class="ticket__divider">
    <div class="ticket__notch"></div>
    <div class="ticket__notch ticket__notch--right"></div>
  </div>
  <div class="ticket__body">
    <section class="ticket__section">
    <h4>Nombre</h4>      
    <?php echo $nombre ?>
    </section>
    <section class="ticket__section">
      <h4>Correo</h4>
      <?php echo $correo ?>
    </section>
    <section class="ticket__section">
      <h4>Telefono</h4>
      <?php echo $telefono ?>
    </section>
    <section class="ticket__section">
      <h4>Ciudad</h4>
      <?php echo $ciudad ?>
    </section>
    <section class="ticket__section">
    <h4>Domicilio</h4>
    <?php echo $domicilio ?>
    </section>
    <section class="ticket__section">
    <h4>Sucursal</h4>
    <?php echo $id_sucursal ?>
    </section>
    <section class="ticket__section">
    <h4>Caja</h4>
    <?php echo $id_caja ?>
    </section>
    <section class="ticket__section">
    <h4>Rol</h4>
    <?php echo $id_rol ?>
    </section>
  </div>
</div>


