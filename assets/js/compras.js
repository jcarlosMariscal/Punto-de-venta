import { calcularTotal } from "./helper.js";
import { nota_compra, nota_venta } from "./nota_gec.js";
import { campos, validarFormulario } from "./validar.js";

const d = document;
const formulario = d.getElementById("formulario");
let inputs = d.querySelectorAll("#formulario input");

const nombre_prov = d.getElementById("nombre_prov"),
  producto_prov = d.getElementById("producto_prov"),
  cantidad_prov = d.getElementById("cantidad_prov"),
  pcompra_prov = d.getElementById("pcompra_prov"),
  pventa_prov = d.getElementById("pventa_prov");

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

const selecProv = d.getElementById("form-select-prov");
if (selecProv) {
  selecProv.addEventListener("submit", (e) => {
    e.preventDefault();
    let boxs = d.querySelectorAll("#form-select-prov input");
    boxs.forEach((box) => {
      if (box.checked) {
        // console.log(box.value);
        nombre_prov.value = box.value;
      }
    });
    $("#seleccionar-prov").modal("hide");
  });
}

if (formulario) {
  formulario.addEventListener("submit", (e) => {
    e.preventDefault();
    const regex = /^[a-zA-ZÀ-ÿ\s]{1,60}$/;
    // console.log(regex.test(formulario.nombre_prov.value));
    if (
      (campos.producto,
      campos.cantidad_prov,
      campos.pcompra_prov,
      campos.pventa_prov)
    ) {
      if (!regex.test(formulario.nombre_prov.value)) {
        // console.log("ho");
        alert("Rellena todos los campos correctamente.");
        return;
      }
      let existe = false;
      for (var i = 0, row; (row = table_body.rows[i]); i++) {
        console.log(table_body.rows[i].cells[0].innerText);
        console.log(formulario.producto_prov.value);
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
          <td class="prd_name">${formulario.producto_prov.value}</td>
          <td>${formulario.cantidad_prov.value}</td>
          <td>${formulario.pcompra_prov.value}</td>
          <td><span>$<span><span class="precio">${
            formulario.cantidad_prov.value * formulario.pcompra_prov.value
          }</span></td>
          <td class="" hidden>${formulario.nombre_prov.value}</td>
          <td hidden>${formulario.pventa_prov.value}</td>
          <td class="text-center"><a href="#" class="btn-tb-delete" data-prd_id='${add}'><i class="fa-solid fa-trash-can"></i></a></td>
                        </tr>`;
        table_body.innerHTML += product;
        add++;
        calcularTotal();
        // nombre_prov.value = "";
        // producto_prov.value = "";
        // cantidad_prov.value = "";
        // pcompra_prov.value = "";
        // pventa_prov.value = "";
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
