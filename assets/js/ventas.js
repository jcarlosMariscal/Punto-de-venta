import { calcularTotal } from "./helper.js";
import { nota_venta } from "./nota_gec.js";

const d = document;
var table_ventas = d.getElementById("table-body-ventas");
let code_product = d.getElementById("code-product");
let efectivo_cliente = d.getElementById("efectivo_cliente");

code_product.addEventListener("keyup", (e) => {
  if (e.which === 13) {
    if (code_product.value === "") {
      Swal.fire({
        title: "Escriba un código de producto",
        text: "Verifique que el código sea correcto",
        icon: "error", //error,
        timer: 2000,
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        confirmButtonColor: "#47874a",
      });
    } else {
      let consulta = new FormData();
      consulta.append("action", "buscar");
      consulta.append("codProducto", code_product.value);
      fetch("logic/ventas.php", {
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
            // console.log(get);
            table_ventas.innerHTML += `
              <th>${get.codigo}</th>
              <td>${get.producto}</td>
              <td class="precio">${get.pventa}</td>
              <td>${get.id_proveedor}</td>
              <td>${get.cantidad}</td>
            `;
            code_product.value = "";
            calcularTotal();
          }
        });
    }
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
      // alert(calcularTotal());
      let cambio_cliente = d.getElementById("cambio_cliente");
      cambio_cliente.innerText = efectivo_cliente.value - calcularTotal();
    }
  }
});

nota_venta();
