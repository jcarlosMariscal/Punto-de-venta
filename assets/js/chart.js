const chart1 = document.getElementById("chart1");
const chart2 = document.getElementById("chart2");
const chart3 = document.getElementById("chart3");
if (chart1 || chart2 || chart3) {
  chart1.getContext("2d");
  chart2.getContext("2d");
  chart3.getContext("2d");

  // -----grafica 1------------------
  const data1 = {
    datasets: [
      {
        label: "My First Dataset",
        backgroundColor: [
          "rgb(127, 255, 212)",
          "rgb(0, 206, 209)",
          "rgb(135, 206, 250)",
          "rgb(32, 178, 170)",
          "rgb(147, 112, 219)",
        ],
      },
    ],
  };

  const myChart1 = new Chart(chart1, {
    type: "pie",
    data: data1,
    options: {
      indexAxis: "y",
      responsive: true,
      maintainAspectRatio: false,
    },
  });

  // -----grafica 2 -----------------
  const myChart2 = new Chart(chart2, {
    type: "bar",
    data: {
      // labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
      datasets: [
        {
          label: "# Personal de Ventas",
          backgroundColor: [
            "rgb(100, 149, 237)",
            "rgb(173, 216, 230)",
            "rgb(60, 179, 113)",
            "rgb(64, 224, 208)",
            "rgb(30, 144, 255)",
          ],
          borderColor: [
            "rgb(100, 149, 237)",
            "rgb(173, 216, 230)",
            "rgb(60, 179, 113)",
            "rgb(64, 224, 208)",
            "rgb(30, 144, 255)",
          ],
          borderWidth: 1,
        },
      ],
    },
    options: {
      indexAxis: "y",
    },
  });
  // -----grafica 3--------
  const myChart3 = new Chart(chart3, {
    type: "bar",
    data: {
      // labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
      datasets: [
        {
          label: "# Productos más comprados",
          backgroundColor: [
            "rgb(32, 178, 170)",
            "rgb(147, 112, 219)",
            "rgb(64, 224, 208)",
            "rgb(173, 216, 230)",
            "rgb(30, 144, 255)",
          ],
          borderColor: [
            "rgb(32, 178, 170)",
            "rgb(147, 112, 219)",
            "rgb(64, 224, 208)",
            "rgb(173, 216, 230)",
            "rgb(30, 144, 255)",
          ],
          borderWidth: 1,
        },
      ],
    },
    options: {
      scales: {
        x: {
          min: 0,
          max: 10,
        },
        y: {
          beginAtZero: true,
        },
      },
    },
  });

  //scroll para poder mover la grafica 3
  function scroller(scroll, chart) {
    console.log(scroll);
    const dataLength = myChart3.data.labels.length;
    if (scroll.deltaY > 0) {
      if (myChart3.options.scales.x.max >= dataLength) {
        myChart3.options.scales.x.min = dataLength - 10;
        myChart3.options.scales.x.max = dataLength;
      } else {
        myChart3.options.scales.x.min += 1;
        myChart3.options.scales.x.max += 1;
      }
    } else if (scroll.deltaY < 0) {
      if (myChart3.options.scales.x.min <= 0) {
        myChart3.options.scales.x.min = 0;
        myChart3.options.scales.x.max = 6;
      } else {
        myChart3.options.scales.x.min -= 1;
        myChart3.options.scales.x.max -= 1;
      }
    }
    myChart3.update();
  }

  myChart3.canvas.addEventListener("wheel", (e) => {
    e.preventDefault();
    scroller(e, myChart3);
  });
  //---------------------------------------------

  let url = "./../view/logic/graficar.php";
  fetch(url)
    .then((response) => response.json())
    .then((datos) => mostrar(datos))
    .catch((error) => console.log(error));

  const mostrar = (datos) => {
    // console.log(datos);
    //función para mostrar el json

    //datos.compra_producto accedemos al json, expecificamente a compra_producto
    datos.compra_producto.forEach((respuesta1) => {
      myChart3.data["labels"].push(respuesta1.productos);
      myChart3.data["datasets"][0].data.push(respuesta1.total);
      myChart3.update();
    });
    //datos.personal accedemos al json, expecificamente a personal
    datos.personal.forEach((respuesta2) => {
      myChart2.data["labels"].push(respuesta2.nombre);
      myChart2.data["datasets"][0].data.push(respuesta2.id_personal);
      myChart2.update();
    });
    //datos.proveedor accedemos al json, expecificamente a proveedor
    // for (let i = 0; i < datos.proveedor.length; i++) {// Descomentame para no ver el proveedor por defecto
    //   if (datos.proveedor[i].nombre == 'Proveedor en general') {
    //     datos.proveedor.splice(i, 1);
    //     break;
    //   }
    // }
    datos.proveedor.forEach((respuesta3) => {
      myChart1.data["labels"].push(respuesta3.nombre);
      myChart1.data["datasets"][0].data.push(respuesta3.id_proveedor);
      myChart1.update();
    });

    // console.log(datos);
  };
}
