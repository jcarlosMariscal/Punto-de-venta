import { calcularTotal } from "./helper.js";
import { nota_venta } from "./nota_gec.js";

const d = document;
var table_ventas = d.getElementById("table-body-ventas");
let formCodeProduct = d.getElementById("formCodeProduct");
let efectivo_cliente = d.getElementById("efectivo_cliente");
let cambio_cliente = d.getElementById("cambio_cliente");
let table_body = d.getElementById("table-body-ventas");
let btnVender = d.getElementById("vender");

const validarN = (miInput, campo) => {
  let valor = miInput.value;
  if (!/^\d*$/.test(valor) || valor == "" || valor <= 0) {
    Swal.fire({
      title: "Rellene los campos correctamente.",
      text: `El valor del campo ${campo} debe ser un valor número y ser mayor a cero`,
      icon: "error", //error,
      timer: 2000,
      toast: true,
      position: "top-end",
      showConfirmButton: false,
      confirmButtonColor: "#47874a",
    });
    btnVender.classList.add("deshabilitar");
  } else btnVender.classList.remove("deshabilitar");
};
if (efectivo_cliente) {
  efectivo_cliente.addEventListener("keyup", () =>
    validarN(efectivo_cliente, "efectivo")
  );
  efectivo_cliente.addEventListener("blur", () =>
    validarN(efectivo_cliente, "efectivo")
  );
}

if (formCodeProduct) {
  formCodeProduct.addEventListener("submit", (e) => {
    let code_product = d.getElementById("code-product");
    e.preventDefault();
    if (code_product.value === "") {
      Swal.fire({
        title: "Datos incorrectos",
        text: "Verifique que el nombre o código del producto sea correcto",
        icon: "error", //error,
        timer: 2000,
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        confirmButtonColor: "#47874a",
      });
    } else {
      let consulta = new FormData();
      consulta.append("action", "buscarProducto");
      consulta.append("codNameProducto", code_product.value);
      fetch("logic/readData.php", {
        method: "POST",
        body: consulta,
      })
        .then((res) => res.text())
        .then((data) => {
          // console.log(data);
          if (data == "noEncontrado") {
            Swal.fire({
              title: "Producto no encontrado.",
              text: "Verifique que el código sea correcto",
              icon: "error", //error,
              timer: 2000,
              toast: true,
              position: "top-end",
              showConfirmButton: false,
              confirmButtonColor: "#47874a",
            });
          } else {
            let get = JSON.parse(data);
            // let repetido = false;
            var vender = 1;

            if (table_body.innerText === "") {
              table_ventas.innerHTML = `
                <th hidden>${get.codigo}</th>
                <td>${get.nombre}</td>
                <td>${get.pventa}</td>
                <td>${get.unidad}</td>
                <td>${get.categoria}</td>
                <td>${get.cantidad}</td>
                <td>${vender}</td>
                <td class="precio">${get.pventa * vender}</td>
              `;
              code_product.value = "";
              calcularTotal();
              return;
            }
            let repetido = false;
            // console.log(table_body.rows);
            for (var i = 0, row; (row = table_body.rows[i]); i++) {
              let venta = parseInt(table_body.rows[i].cells[6].innerText);
              venta++;
              let tableCode = table_body.rows[i].cells[0].innerText;
              let tableName = table_body.rows[i].cells[1].innerText;
              if (
                tableCode === code_product.value ||
                tableName === code_product.value
              ) {
                table_body.rows[i].innerHTML = `
                <th hidden>${get.codigo}</th>
                <td>${get.nombre}</td>
                <td>${get.pventa}</td>
                <td>${get.unidad}</td>
                <td>${get.categoria}</td>
                <td>${get.cantidad}</td>
                <td>${venta}</td>
                <td class="precio">${get.pventa * venta}</td>
                `;
                repetido = true;
              } else {
                repetido = false;
              }
            }
            if (!repetido) {
              // console.log("nuevo");
              let nuevo = 1;
              var hilera = document.createElement("tr");
              hilera.innerHTML = `
                  <th hidden>${get.codigo}</th>
                  <td>${get.nombre}</td>
                  <td>${get.pventa}</td>
                  <td>${get.unidad}</td>
                  <td>${get.categoria}</td>
                  <td>${get.cantidad}</td>
                  <td>${nuevo}</td>
                  <td class="precio">${get.pventa * nuevo}</td>
                `;
              table_body.appendChild(hilera);
            }
            code_product.value = "";
            calcularTotal();
          }
        });
    }
  });

  efectivo_cliente.addEventListener("keyup", (e) => {
    if (e.which === 13) {
      if (
        efectivo_cliente.value === "" ||
        efectivo_cliente.value < calcularTotal()
      ) {
        alert(
          "Introduce una cantidad correcta, debe ser mayor o igual a la suma total de la venta"
        );
      } else {
        cambio_cliente.innerHTML = ` $${
          efectivo_cliente.value - calcularTotal()
        }`;
      }
    }
  });

  nota_venta();
}

// ---------------------- SECCIÓN VER VENTAS ---------------------------------------
const filtrarProd = (form) => {
  const mostrarRegistros = d.getElementById("mostrarRegistros");
  const cargarRegistros = d.createElement("div");
  const fragment = d.createDocumentFragment();
  fetch("logic/readData.php", {
    method: "POST",
    body: form,
  })
    .then((res) => res.text())
    .then((data) => {
      console.log(data);
      if (data === "No hay resultados") {
        mostrarRegistros.innerHTML =
          "No hay registros que coincidan con la búsqueda";
      }
      mostrarRegistros.innerHTML = "";
      let arr = data.split("-/");
      for (let i = 0; i < arr.length; i++) {
        let json = JSON.parse(arr[i]);
        cargarRegistros.innerHTML += `
              <div class="registroCompras">
                <div class="registroCompras-text">
                  <p class="text-id">Venta #<span class="id_sucursal">${json.id_venta} - Cliente en general</span></p>
                  <p class="text-fecha">${json.fecha}</p>
                </div>
                <div class="registroCompras-total">
                  <p class="total-text">$${json.total}</p>
                </div>
              </div>`;
        // console.log(json.id_compra);
        fragment.appendChild(cargarRegistros);
      }
      mostrarRegistros.appendChild(fragment);
    });
};
d.addEventListener("DOMContentLoaded", (e) => {
  const filtrarRegistros = d.getElementById("filtrarRegistros");
  const agregarFiltro = d.getElementById("agregarFiltro");
  const selectFiltro = d.getElementById("selectFiltro");
  if (filtrarRegistros) {
    if (filtrarRegistros.value === "") {
      let form = new FormData();
      form.append("action", "readVentas");
      form.append("filtro", "todo");
      form.append("campo", "Sin especificar");
      filtrarProd(form);
    }
  }
  if (agregarFiltro) {
    agregarFiltro.addEventListener("submit", (e) => {
      e.preventDefault();
      // if (filtrarRegistros.value === "") alert("Indique algo para buscar");

      let form = new FormData();
      form.append("action", "readVentas");
      form.append("filtro", filtrarRegistros.value);
      form.append("campo", selectFiltro.value);
      filtrarProd(form);
    });
  }

  setInterval(() => {
    const registroCompras = d.querySelectorAll(".registroCompras");
    // console.log(registroCompras);
    if (registroCompras) {
      const detallesCompra = d.getElementById("detallesCompra");
      const masDetallesCompra = d.getElementById("masDetallesCompra");
      const detallesGeneral = d.getElementById("detallesGeneral");
      const cargarJson = d.getElementById("cargarJson");
      const infoUser = d.getElementById("info-user");
      registroCompras.forEach((el) => {
        el.addEventListener("click", (e) => {
          const id_venta =
            el.childNodes[1].childNodes[1].childNodes[1].innerText;
          let form = new FormData();
          form.append("action", "readVentaProducto");
          form.append("id_venta", id_venta);
          fetch("logic/readData.php", {
            method: "POST",
            body: form,
          })
            .then((res) => res.text())
            .then((data) => {
              if (cargarJson) cargarJson.innerHTML = "";
              if (detallesCompra) detallesCompra.innerHTML = "";
              if (masDetallesCompra) masDetallesCompra.innerHTML = "";
              if (infoUser) infoUser.style.display = "none";
              console.log(data);
              let hoy = new Date();
              let fecha =
                hoy.getDate() +
                "-" +
                (hoy.getMonth() + 1) +
                "-" +
                hoy.getFullYear();
              let hora =
                hoy.getHours() +
                ":" +
                hoy.getMinutes() +
                ":" +
                hoy.getSeconds();
              let arr = data.split("-/");
              let json1 = JSON.parse(arr[0]);
              let json2 = JSON.parse(arr[1]);
              console.log(json1);
              // console.log(json2);

              detallesGeneral.innerHTML = `
                <p>Venta #${json1.id_venta}</p>
                <p>${json1.sucursal}</p>
              `;
              detallesCompra.innerHTML = `
              <div class="columna-campos">
                <p>Sucursal</p>
                <p>Fecha venta</p>
                <p>Fecha consulta</p>
                <p>Atendido por </p>
                <p>Cliente</p>
                <p>Método de pago</p>
                <p>Productos</p>
                <p>Total</p>
                <p>Efectivo cliente</p>
                <p>Cambio</p>
              </div>
              <div class="columna-registros">
                <p>${json1.sucursal}</p>
                <p>${json1.fecha}</p>
                <p>${fecha + " " + hora}</p>
                <p>${json1.personal}</p>
                <p>${json1.cliente}</p>
                <p>Efectivo</p>
                <p>${json1.productos}</p>
                <p>${json1.total}</p>
                <p>${json1.efectivo}</p>
                <p>${json1.cambio}</p>
              </div>
              `;
              masDetallesCompra.innerHTML += `
              <br />
              <div class="accordion" id="accordionPanelsStayOpenExample">
                <div class="accordion-item">
                  <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
                      Más detalles
                    </button>
                  </h2>
                  <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingTwo">
                    <div class="accordion-body">
                      <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">Código</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">P. Venta</th>
                            <th scope="col">Unidad</th>
                            <th scope="col">Categoria</th>
                            <th scope="col">Cantidad</th>
                            <th scope="col">Subtotal</th>
                          </tr>
                        </thead>
                        <tbody id ="cargarJson">
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
              `;

              const cargarJson2 = d.getElementById("cargarJson");
              for (let i = 0; i < json2.length; i++) {
                console.log(json2[i]);
                cargarJson2.innerHTML += `
                <tr>
                  <td class="row">${json2[i].codigo}</td>
                  <td>${json2[i].nombre}</td>
                  <td>$${json2[i].pVenta}</td>
                  <td>$${json2[i].unidad}</td>
                  <td>${json2[i].categoria}</td>
                  <td>${json2[i].cantidadVenta}</td>
                  <td>${json2[i].pVenta * json2[i].cantidadVenta}.0</td>
                </tr>          
                `;
              }
            });
        });
      });
    }
  }, 1500);
});

const chart1 = document.getElementById("chart1");
const chart2 = document.getElementById("chart2");
if (chart1 || chart2) {
  chart1.getContext("2d");
  chart2.getContext("2d");

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

  let url = "./../view/logic/graficar.php";
  fetch(url)
    .then((response) => response.json())
    .then((datos) => mostrar(datos))
    .catch((error) => console.log(error));

  const mostrar = (datos) => {
    console.log(datos);
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
