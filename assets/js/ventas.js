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
