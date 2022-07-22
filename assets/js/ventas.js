import { calcularTotal } from "./helper.js";

const d = document;
var table_ventas = d.getElementById("table-body-ventas");
let code_product = d.getElementById("code-product");
let efectivo_cliente = d.getElementById("efectivo_cliente");

code_product.addEventListener("keyup", (e) => {
  if (e.which === 13) {
    if (code_product.value === "") {
      alert("El código de producto no es correcto");
    } else {
      let producto = {
        idProd: 123368,
        nombre: "Arroz",
        categoria: "Alimento",
        precioU: 850.0,
        stock: 20,
      };
      table_ventas.innerHTML += `
        <th>${producto.idProd}</th>
        <td>${producto.nombre}</td>
        <td>${producto.categoria}</td>
        <td class="precio">${producto.precioU}</td>
        <td>${producto.stock}</td>
      `;
      code_product.value = "";
      calcularTotal();
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
