import { calcularTotal } from "./helper.js";
import { nota_compra, nota_venta } from "./nota_gec.js";
import { campos, validarFormulario } from "./validar.js";

const d = document;
const formulario = d.getElementById("formulario");
let inputs = d.querySelectorAll("#formulario input");
if (inputs) {
  inputs.forEach((input) => {
    input.addEventListener("keyup", validarFormulario);
    input.addEventListener("blur", validarFormulario);
  });
}
let table_body = d.getElementById("table-body");
let add = 1;
var comprar = d.getElementById("comprar"),
  cancelar = d.getElementById("cancelar"),
  compra_online = d.getElementById("compra_online");
(comprar.disabled = true),
  (cancelar.disabled = true),
  (compra_online.disabled = true);
comprar.classList.add("deshabilitar"),
  cancelar.classList.add("deshabilitar"),
  compra_online.classList.add("deshabilitar");

if (formulario) {
  formulario.addEventListener("submit", (e) => {
    e.preventDefault();
    if (
      (campos.nombre_prov,
      campos.producto,
      campos.cantidad_prov,
      campos.pcompra_prov,
      campos.pventa_prov)
    ) {
      let existe = false;
      for (var i = 0, row; (row = table_body.rows[i]); i++) {
        if (
          table_body.rows[i].cells[0].innerText ===
          formulario.producto_prov.value
        ) {
          alert("Producto ya agregado");
          existe = true;
        } else {
          existe = false;
        }
      }
      if (!existe) {
        const product = `<tr id="producto_${add}">
                          <td class="prd_name">${
                            formulario.producto_prov.value
                          }</td>
                          <td>${formulario.cantidad_prov.value}</td>
                          <td>${formulario.pcompra_prov.value}</td>
                          <td><span>$<span><span class="precio">${
                            formulario.cantidad_prov.value *
                            formulario.pcompra_prov.value
                          }</span></td>
                          <td class="text-center"><a href="#" class="btn-tb-delete" data-prd_id='${add}'><i class="fa-solid fa-trash-can"></i></a></td>
                        </tr>`;
        table_body.innerHTML += product;
        add++;
        calcularTotal();
      }
      (comprar.disabled = false),
        (cancelar.disabled = false),
        (compra_online.disabled = false);
      comprar.classList.remove("deshabilitar"),
        cancelar.classList.remove("deshabilitar"),
        compra_online.classList.remove("deshabilitar");
      // ----------------
      let product_delete = d.querySelectorAll(".btn-tb-delete");
      product_delete.forEach((el) => {
        el.addEventListener("click", (e) => {
          let id = el.dataset.prd_id;
          let eliminar = d.getElementById(`producto_${id}`);
          eliminar.remove();
          calcularTotal();
        });
      });
    } else {
      alert("Rellena todos los campos correctamente.");
    }
  });
}

nota_compra();
