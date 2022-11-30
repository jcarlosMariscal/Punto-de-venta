<?php
  session_start();//iniciamos una sesión
  if(empty($_SESSION['user'])){
      header('location: ../index.php');
  }
  $p = (isset($_GET['p']) ? $_GET['p'] : "main");
  switch ($p) {
    case 'main':
      $getPage = "user_main.php";
      $nombreSeccion = "Inicio";
      break;
    case 'configuration':
      if ($_SESSION['rol'] != 0 ){
          ?> <script>
            alert("Acceso no autorizado");
            window.location.href="index.php";
            </script> <?php
        }else{
          $getPage = "configuration.php";
          $nombreSeccion = "Configuración";
        }
    break;
    case 'information':
      $getPage = "system_start.php";
      $nombreSeccion = "Información";
        break;
    case 'personal':
        if ($_SESSION['rol'] == 2){
          ?> <script>
            alert("Acceso no autorizado");
            window.location.href="index.php";
            </script> <?php
        }
        if($_SESSION['rol'] == 0 || $_SESSION['rol'] == 1){
          $getPage = "personal.php";
          $nombreSeccion = "Personal";
        }
        break;
    case 'ventas':
        $getPage = "ventas.php";
        $nombreSeccion = "Ventas";
        break;
    case 'compras':
      if ($_SESSION['rol'] != 0 ){
          ?> <script>
            alert("Acceso no autorizado");
            window.location.href="index.php";
            </script> <?php
        }else{
          $getPage = "compras.php";
          $nombreSeccion = "Compras";
        }
        break;
    case 'ver-compras':
        $getPage = "verCompras.php";
        $nombreSeccion = "Ver Compras";
        break;
    case 'ver-ventas':
        $getPage = "verVentas.php";
        $nombreSeccion = "Ver Ventas";
        break;
    case 'proveedor':
        $getPage = "supplier.php";
        $nombreSeccion = "Proveedor";
        break;
    case 'reporte':
        $getPage = "reporte.php";
        $nombreSeccion = "Reporte";
        break;            
    case 'productos':
        $getPage = "productos.php";
        $nombreSeccion = "Productos";
        break;
    case 'sucursal':
        $getPage = "sucursal.php";
        $nombreSeccion = "";
        break;
    default:
      # code...
    break;
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="../assets/css/bootstrap.css"> -->
    <link href="../assets/css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style-print.css">
    <link rel="stylesheet" href="../assets/css/responsive.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@100;200&family=Hind+Siliguri:wght@300&family=Montserrat:ital,wght@1,300&family=Roboto:wght@100&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js" integrity="sha512-QSkVNOCYLtj73J4hbmVoOV6KVZuMluZlioC+trLpewV8qMjsWqlIQvkn1KGX2StWvPMdWGBqim1xlC8krl1EKQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <title>NV | <?php echo $nombreSeccion; ?></title>
    <link rel="shortcut icon" href="../assets/img/favicon.png" type="image/x-icon">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.5/dist/JsBarcode.all.min.js"></script>
</head>
<body>
    <?php 
    require_once "../template/nav.php"; 
    ?>
    <main class="main" id="main">
      <?php
      require_once "../template/header.php";
        require_once $getPage;
        ?>
    </main>
    <div class="modal fade" id="graficas">
    <div class="modal-dialog modal-lg">
        <div class="borde modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLabel">Generar graficas📉</h3>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <form method="post" name="frmExcelImport" id="frmExcelImport">
                        <div class="row">
                            <div class="col-6">
                                <label for="">Fecha inicio</label>
                                <input type="date" name="fecha1" required>
                            </div>
                            <div class="col-6">
                                <label for="">Fecha fin</label>
                                <input type="date" name="fecha2" required>
                            </div>
                        </div>
                </div>
            </div>
            <br><br><br><br><br>
            <div class="modal-footer">
                <button type="button" class="btn btn1" data-bs-dismiss="modal">Cerrar</button>
                <button type="submit"  class="btn btn-primary subir">Visualizar</button>
                <!-- <input type="submit" id="archivo" name="import" class="btn btn-danger subir" value="Importar"> -->
                </form>
            </div>
        </div>
    </div>
</div>
    <script src="../assets/js/index.js" type="module"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.js" integrity="sha512-TsDUjQW16/G8fz4gmgTOBW2s2Oi6TPUtQ6/hm+TxZZdkQtQrK5xEFIE0rgDuz5Cl1xQU1u3Yer7K5IuuBeiCqw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    
</body>
</html>

<script>
    let msj = localStorage.getItem("login");
    let confiError = localStorage.getItem("confiError");
    if(msj === "true"){
      Swal.fire({
            title: "Bienvenido <?php echo $_SESSION['user']['nombre']?>",
            text: "Ha iniciado sesión en el sistema.",
            icon: "success",//error, 
            timer: 3000,
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            confirmButtonColor: '#47874a',
        });
    } 
    setTimeout(function(){
        localStorage.removeItem("login");
    }, 1500);
    if(confiError === "true"){
      Swal.fire({
            title: "Error",
            text: "Los datos son obligatorios.",
            icon: "error",//error, 
            timer: 3000,
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            confirmButtonColor: '#47874a',
        });
    } 
    setTimeout(function(){
        localStorage.removeItem("confiError");
    }, 1500);
</script>


<!-- MOSTRAR MODAL DE EDITAR PROVEEDOR -->
<?php
$editProv = (isset($_GET['edit']) ? $_GET['edit'] : NULL);
  if($editProv): 
?>
  <script>
    var modProveedor = new bootstrap.Modal(
      document.getElementById("modProv"),
      {
            keyboard: false,
          }
    );
    modProveedor.show();
  </script>;
<?php endif; ?>
<!-- MOSTRAR MODAL DE EDITAR PERSONAL -->
<?php
$editPer = (isset($_GET['edit']) ? $_GET['edit'] : NULL);
  if($editPer): 
?>
  <script>
        let modPersonal = new bootstrap.Modal(
      document.getElementById("modPer"),
      {
            keyboard: false,
          }
    );
    modPersonal.show();
  </script>;
<?php endif; ?>
<!-- MOSTRAR MODAL PARA GENERAR CODIGO DE BARRAS -->
<?php
$nombre = (isset($_GET['nombre']) ? $_GET['nombre'] : NULL);
  if($nombre): 
?>
  <script>
    let modGenerarCodigo = new bootstrap.Modal(
      document.getElementById("codigo-barras"),
      {
            keyboard: false,
          }
    );
    modGenerarCodigo.show();
  </script>;
<?php endif; ?>
<!-- MOSTRAR MODAL con vista previa del codigo -->
<?php
$ver = (isset($_GET['ver']) ? $_GET['ver'] : NULL);
  if($ver): 
?>
  <script>
    let modVerCodigo = new bootstrap.Modal(
      document.getElementById("mostrarCodigo"),
      {
            keyboard: false,
          }
    );
    modVerCodigo.show();
  </script>;
<?php endif; ?>


<!-- - Mostrar modal para seleccionar proveedor después de agregar uno en la sección de compras ------ -->
<script>
    let nameProv = localStorage.getItem("nameProv");
    if(nameProv) nombre_prov.value = nameProv;
    setTimeout(function(){
        localStorage.removeItem("nameProv");
    }, 1500);
    let addProd = localStorage.getItem("addProd");
    if(addProd) nombre_prov.value = nameProv;
    setTimeout(function(){
        localStorage.removeItem("addProd");
    }, 1500);

</script>