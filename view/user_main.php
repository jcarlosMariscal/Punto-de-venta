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
$respuesta = $query->graficaFechas();//Llmamos al metodo
$arr = [];
foreach ($respuesta as $row) {//iteramos
    $fecha = $row['fecha'];
    $total = $row['total'];
    $json = '{"fecha":"' . $fecha . '","total":"' . $total . '"}';
    array_push($arr, $json);//empujar el array
}
$dividir = implode(', ', $arr);//separamos por comas
$json1 = '[' . $dividir . ']';
$deco = json_decode($json1);//Decodificamos un string de JSON
?>

<script src="../assets/js/chart.js" type="module"></script>
<script>
    // ----grafica 4   --------------esto me lo llevo a user_main

    const data4 = {
        labels: [<?php foreach ($deco as $d) { ?> "<?php echo  $d->fecha ?>",//iteramos, para poder acceder a cada elemento
            <?php }; ?>
        ],
        datasets: [{
            label: "# Ventas de anteriores meses",
            data: [<?php foreach ($deco as $d) { ?> "<?php echo  $d->total ?>",//iteramos, para poder acceder a cada elemento
                <?php }; ?>
            ],
            fill: {
                target: 'origin',
                above: 'rgb(175, 238, 238)', // Area
            },
            borderColor: "rgb(0, 206, 209)",
            tension: 0.3,
        }, ],
    };
    const myChart4 = new Chart(chart4, {
        type: "line",
        data: data4,
        options: {
            scales: {
                x: {
                    min: 0,
                    max: 5
                },
                y: {
                    beginAtZero: true,
                },
            },
            animations: {
                tension: {
                    duration: 2000,
                    easing: 'linear',
                    from: 1,
                    to: 0,
                    loop: true
                }
            },
        }
    });
    //scroll para poder mover la grafica 4   
    function scroller(scroll, chart) {
        console.log(scroll)
        const dataLength = myChart4.data.labels.length;
        if (scroll.deltaY > 0) {
            if (myChart4.options.scales.x.max >= dataLength) {
                myChart4.options.scales.x.min = dataLength - 5;
                myChart4.options.scales.x.max = dataLength;
            } else {
                myChart4.options.scales.x.min += 1;
                myChart4.options.scales.x.max += 1;
            }
        } else if (scroll.deltaY < 0) {
            if (myChart4.options.scales.x.min <= 0) {
                myChart4.options.scales.x.min = 0;
                myChart4.options.scales.x.max = 5;
            } else {
                myChart4.options.scales.x.min -= 1;
                myChart4.options.scales.x.max -= 1;
            }
        }
        myChart4.update();
    }

    myChart4.canvas.addEventListener('wheel', (e) => {
        e.preventDefault()
        scroller(e, myChart4)
    })
    //---------------------------------------------
</script>
