<section class="content">
    <div class="box-main">
        <div class="box box-1">
            <canvas id="chart1"></canvas>
            <!-- <p>Ventas de Personal de ventas</p> -->
        </div>
        <div class="box box-2">
            <canvas id="chart2"></canvas>
        </div>
        <div class="box box-3">
            <canvas id="chart3"></canvas>
        </div>
        <div class="box box-4">
            <canvas id="chart4"></canvas>
        </div>
        <div class="box box-4">
            <div class="main-btns">
                <div class="btn-charts">
                    <a href="" data-bs-toggle="modal" data-bs-target="#graficas" class="btn-chart"><span><i class="fa-solid fa-chart-simple"></i></span> Generar Gráfica</a>
                </div>
                <div class="btn-reports">
                    <a href="" class="btn-chart"><span><i class="fa-solid fa-file-circle-plus"></i></i></span> Ver Reportes</a>
                </div>
                <div class="btn-code">
                    <a href="" class="btn-chart"><span><i class="fa-solid fa-barcode"></i></span> Código de Barras</a>
                </div>
            </div>
        </div>
    </div>
</section>
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
<?php
$respuesta = $query->graficaFechas();
$arr = [];
foreach($respuesta as $row) {
    $fecha = $row['fecha'];
    $total = $row['total'];
    $json = '{"fecha":"'.$fecha.'","total":"'.$total.'"}';
    array_push($arr, $json);  
}
$dividir = implode(', ', $arr); 
$json1 = '['.$dividir.']';
$deco = json_decode($json1);
?>

<script src="../assets/js/chart.js" type="module"></script>
<script>
  
    // ----grafica 4   -------------esto me lo llevo a user_main
    
        const data4 = {
        labels: [<?php foreach ($deco as $d) { ?> 
                  "<?php echo  $d->fecha ?>",
                 <?php }; ?>
        ],
        datasets: [{
            label: "# Ventas de anteriores meses",
            data: [<?php foreach ($deco as $d) { ?> 
                    "<?php echo  $d->total ?>",
                  <?php }; ?>
            ],
            fill: true,
            borderColor: "rgb(75, 192, 192)",
            tension: 0.3,
        }, ],
    };
    const myChart4 = new Chart(chart4, {
        type: "line",
        data: data4,
    });
    
   
</script>
<!-- https://getcssscan.com/css-box-shadow-examples -->
