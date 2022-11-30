const chart1 = document.getElementById("chart1");
const chart2 = document.getElementById("chart2");
const chart3 = document.getElementById("chart3");
if (chart1 || chart2 || chart3 || chart4) {
  chart1.getContext("2d");
  chart2.getContext("2d");
  chart3.getContext("2d");

  // -----grafica 1------------------
  const data1 = {
    datasets: [
      {
        label: "My First Dataset",
        backgroundColor: [
          "rgb(255, 99, 132)",
          "rgb(75, 192, 192)",
          "rgb(255, 205, 86)",
          "rgb(201, 203, 207)",
          "rgb(54, 162, 235)",
        ],
      },
    ],
  };
  const myChart1 = new Chart(chart1, {
    type: "bar",
    data: data1,
    options: {
      radio: 50,
    },
  });

  // -----grafica 2 -----------------
  const data2 = {
    datasets: [
      {
        label: "My First Dataset",
        backgroundColor: [
          "rgb(255, 99, 132)",
          "rgb(54, 162, 235)",
          "rgb(255, 205, 86)",
        ],
        hoverOffset: 4,
      },
    ],
  };
  const myChart2 = new Chart(chart2, {
    type: "line",
    data: data2,
  });
  // -----grafica 3--------
  const myChart3 = new Chart(chart3, {
    type: "bar",
    data: {
      // labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
      datasets: [
        {
          label: "# Productos más vendidos",
          backgroundColor: [
            "rgba(255, 99, 132, 0.2)",
            "rgba(54, 162, 235, 0.2)",
            "rgba(255, 206, 86, 0.2)",
            "rgba(75, 192, 192, 0.2)",
            "rgba(153, 102, 255, 0.2)",
            "rgba(255, 159, 64, 0.2)",
          ],
          borderColor: [
            "rgba(255, 99, 132, 1)",
            "rgba(54, 162, 235, 1)",
            "rgba(255, 206, 86, 1)",
            "rgba(75, 192, 192, 1)",
            "rgba(153, 102, 255, 1)",
            "rgba(255, 159, 64, 1)",
          ],
          borderWidth: 1,
        },
      ],
    },
    options: {
      scales: {
        y: {
          beginAtZero: true,
        },
      },
    },
  });
  // ---------------------

  let url = "./../view/logic/graficar.php";
  fetch(url)
    .then((response) => response.json())
    .then((datos) => mostrar(datos))
    .catch((error) => console.log(error));

  const mostrar = (datos) => {
    console.log(datos);
    datos.productos.forEach((respuesta1) => {
      myChart3.data["labels"].push(respuesta1.nombre);
      myChart3.data["datasets"][0].data.push(respuesta1.cantidad);
      myChart3.update();
    });

    datos.ventas.forEach((respuesta2) => {
      myChart2.data["labels"].push(respuesta2.nombre);
      myChart2.data["datasets"][0].data.push(respuesta2.telefono);
      myChart2.update();
    });
    datos.proveedor.forEach((respuesta3) => {
      myChart1.data["labels"].push(respuesta3.nombre);
      myChart1.data["datasets"][0].data.push(respuesta3.telefono);
      myChart1.update();
    });
  };
}
