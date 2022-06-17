<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/bootstrap.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@100;200&family=Hind+Siliguri:wght@300&family=Montserrat:ital,wght@1,300&family=Roboto:wght@100&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js" integrity="sha512-QSkVNOCYLtj73J4hbmVoOV6KVZuMluZlioC+trLpewV8qMjsWqlIQvkn1KGX2StWvPMdWGBqim1xlC8krl1EKQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <title>Sistema Punto de ventas</title>
    <link rel="shortcut icon" href="../assets/img/favicon.png" type="image/x-icon">
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
                    require_once "configuration.php";
                    break;
                case '0':
                    require_once "system_start.php";
                    break;
                case 'information':
                    require_once "system_start.php";
                    break;
                case 'test':
                    require_once "test.php";
                    break;
                case 'personal':
                    require_once "personal.php";
                    break;
                case 'ventas':
                    require_once "ventas.php";
                    break;
                case 'compras':
                    require_once "compras.php";
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
                default:
                    # code...
                    break;
            }
        ?>
    </main>
    <script src="../assets/js/chart.js"></script>
    <script src="../assets/js/formularios.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.js" integrity="sha512-TsDUjQW16/G8fz4gmgTOBW2s2Oi6TPUtQ6/hm+TxZZdkQtQrK5xEFIE0rgDuz5Cl1xQU1u3Yer7K5IuuBeiCqw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>