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
    </div>
</section>
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
