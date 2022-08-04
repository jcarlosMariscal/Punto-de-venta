<?php
session_start();//iniciamos una sesión
if(empty($_SESSION['active'])){
    header('location: ../index.php');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/bootstrap.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/style-print.css">
    <link rel="stylesheet" href="../assets/css/responsive.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@100;200&family=Hind+Siliguri:wght@300&family=Montserrat:ital,wght@1,300&family=Roboto:wght@100&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js" integrity="sha512-QSkVNOCYLtj73J4hbmVoOV6KVZuMluZlioC+trLpewV8qMjsWqlIQvkn1KGX2StWvPMdWGBqim1xlC8krl1EKQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <title>Sistema Punto de ventas</title>
    <link rel="shortcut icon" href="../assets/img/favicon.png" type="image/x-icon">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.5/dist/JsBarcode.all.min.js"></script>
</head>
<body>
    <?php 
        require_once "../template/header.php"; 
        $p = (isset($_GET['p']) ? $_GET['p'] : "main")
    ?>

    <main class="main">
        <?php
            switch ($p) {
                case 'main':
                    require_once "user_main.php";
                    break;
                case 'configuration':
                    ($_SESSION['rol'] == 1 ) ? require_once "configuration.php" : header('Location: index.php');
                    break;
                case 'information':
                    require_once "system_start.php";
                    break;
                case 'personal':
                    ($_SESSION['rol'] == 1 ) ? require_once "personal.php" : header('Location: index.php');
                    break;
                case 'ventas':
                    require_once "ventas.php";
                    break;
                case 'compras':
                    ($_SESSION['rol'] == 1 ) ? require_once "compras.php" : header('Location: index.php');
                    break;
                case 'ver-compras':
                    require_once "verCompras.php";
                    break;
                case 'proveedor':
                    require_once "supplier.php";
                    break;
                case 'reporte':
                    require_once "reporte.php";
                    break;
                case 'add_supplier':
                    require_once "add_supplier.php";
                    break;               
                case 'ver-compras':
                    require_once "verCompras.php";
                    break;
                case 'productos':
                    require_once "productos.php";
                    break;
                default:
                    # code...
                    break;
            }
        ?>
    </main>
    <!-- <script src="../assets/js/chart.js"></script> -->
    <!-- <script src="../assets/js/formularios.js" type="module"></script> -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.js" integrity="sha512-TsDUjQW16/G8fz4gmgTOBW2s2Oi6TPUtQ6/hm+TxZZdkQtQrK5xEFIE0rgDuz5Cl1xQU1u3Yer7K5IuuBeiCqw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <!-- <script src="../assets/js/profile.js" type="module"></script> -->
    
</body>
</html>

<script>
    let msj = localStorage.getItem("login");
    let confiError = localStorage.getItem("confiError");
    if(msj === "true"){
      Swal.fire({
            title: "Bienvenido <?php echo $_SESSION['user']?>",
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
$eProv = (isset($_GET['eProv']) ? $_GET['eProv'] : NULL);
  if($eProv): 
?>
  <script>
    $(function(){
      $('#modProv').modal('show');
    })
  </script>;
<?php endif; ?>
<!-- MOSTRAR MODAL DE EDITAR PERSONAL -->
<?php
$ePer = (isset($_GET['ePer']) ? $_GET['ePer'] : NULL);
  if($ePer): 
?>
  <script>
    $(function(){
      $('#modPer').modal('show');
    })
  </script>;
<?php endif; ?>
<!-- MOSTRAR MODAL PARA GENERAR CODIGO DE BARRAS -->
<?php
$nombre = (isset($_GET['nombre']) ? $_GET['nombre'] : NULL);
  if($nombre): 
?>
  <script>
    $(function(){
      $('#codigo-barras').modal('show');
    })
  </script>;
<?php endif; ?>
<!-- MOSTRAR MODAL con vista previa del codigo -->
<?php
$ver = (isset($_GET['ver']) ? $_GET['ver'] : NULL);
  if($ver): 
?>
  <script>
    $(function(){
      $('#mostrarCodigo').modal('show');
    })
  </script>;
<?php endif; ?>