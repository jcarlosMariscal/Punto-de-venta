import { calcularTotal } from "./helper.js";
import { nota_compra } from "./nota_gec.js";
import { campos, validarFormulario } from "./validar.js";

const d = document;
const formulario = d.getElementById("formulario");
let inputs = d.querySelectorAll("#formulario input");
let table_body = d.getElementById("table-body");
var comprar = d.getElementById("comprar");
var cancelar = d.getElementById("cancelar");
const selecProv = d.getElementById("form-select-prov");
const selecProd = d.getElementById("form-select-prod");
let add = 1;

const nombre_prov = d.getElementById("nombre_prov"),
  nombre_prod = d.getElementById("nombre_prod"),
  cantidad_prod = d.getElementById("cantidad_prod"),
  pcompra_prod = d.getElementById("pcompra_prod"),
  unidad_prod = d.getElementById("unidad_prod"),
  pventa_prod = d.getElementById("pventa_prod");

if (inputs) {
  inputs.forEach((input) => {
    input.addEventListener("keyup", validarFormulario);
    input.addEventListener("blur", validarFormulario);
  });
}
(comprar.disabled = true), (cancelar.disabled = true);
comprar.classList.add("deshabilitar"), cancelar.classList.add("deshabilitar");

if (selecProv) {
  selecProv.addEventListener("submit", (e) => {
    e.preventDefault();
    let boxs = d.querySelectorAll("#form-select-prov input");
    boxs.forEach((box) => {
      if (box.checked) nombre_prov.value = box.value;
    });
  });
}
if (selecProd) {
  selecProd.addEventListener("submit", (e) => {
    e.preventDefault();
    let boxs = d.querySelectorAll("#form-select-prod input");
    boxs.forEach((box) => {
      if (box.checked) nombre_prod.value = box.value;
    });
  });
}

if (nombre_prod) {
  const selectUnidad = d.getElementById("selectUnidad");
  const db_get_code = d.getElementById("db_get_code");
  const db_get_name = d.getElementById("db_get_name");
  nombre_prod.addEventListener("blur", (e) => {
    console.log(nombre_prod.value);
    if (nombre_prod.value === "") {
      Swal.fire({
        title: "Campo vacío",
        text: "Introduza el código o nombre del producto.",
        icon: "error", //error,
        timer: 2000,
        toast: true,
        position: "top-end",
        showConfirmButton: false,
      });
    } else {
      let consulta = new FormData();
      consulta.append("table", "buscarProducto");
      consulta.append("codNameProducto", nombre_prod.value);
      fetch("logic/createData.php", {
        method: "POST",
        body: consulta,
      })
        .then((res) => res.text())
        .then((data) => {
          console.log(data);
          if (data == "noEncontrado") {
            Swal.fire({
              title: "Producto no encontrado.",
              text: "Verifique que el código o nombre sean correctos",
              icon: "error", //error,
              timer: 2000,
              toast: true,
              position: "top-end",
              showConfirmButton: false,
              confirmButtonColor: "#47874a",
            });
          } else {
            let get = JSON.parse(data);
            cantidad_prod.value = get.cantidad;
            pcompra_prod.value = get.pcompra;
            pventa_prod.value = get.pventa;
            selectUnidad.options.item(get.unidad).selected = "selected";
            db_get_code.value = get.codigo;
            db_get_name.value = get.nombre;
          }
        });
    }
  });
}

if (formulario) {
  const btnCompraProducto = d.getElementById("btn-compraProducto");
  btnCompraProducto.addEventListener("click", (e) => {
    e.preventDefault();
    console.log(table_body.rows[i]);
    let existe = false;
    for (var i = 0, row; (row = table_body.rows[i]); i++) {
      console.log(table_body.rows[i].cells[0].innerText);
      console.log(formulario.nombre_prod.value);
      if (
        table_body.rows[i].cells[0].innerText === formulario.nombre_prod.value
      ) {
        alert("Producto ya agregado");
        existe = true;
      } else {
        existe = false;
      }
    }
    if (!existe) {
      const product = `<tr id="producto_${add}">
          <td class="prd_name">${formulario.db_get_name.value}</td>
          <td >${formulario.db_get_code.value}</td>
          <td>${formulario.cantidad_prod.value}</td>
          <td>${formulario.pcompra_prod.value}</td>
          <td><span>$<span><span class="precio">${
            formulario.cantidad_prod.value * formulario.pcompra_prod.value
          }</span></td>
          <td class="" hidden>${formulario.nombre_prov.value}</td>
          <td hidden>${formulario.pventa_prod.value}</td>
          <td class="text-center"><a href="#" class="btn-tb-delete" data-prd_id='${add}'><i class="fa-solid fa-trash-can"></i></a></td>
                        </tr>`;
      table_body.innerHTML += product;
      add++;
      calcularTotal();
      nombre_prod.value = "";
      cantidad_prod.value = "";
      pcompra_prod.value = "";
      pventa_prod.value = "";
    }
    (comprar.disabled = false), (cancelar.disabled = false);
    comprar.classList.remove("deshabilitar"),
      cancelar.classList.remove("deshabilitar");
    let product_delete = d.querySelectorAll(".btn-tb-delete");
    product_delete.forEach((el) => {
      el.addEventListener("click", (e) => {
        let id = el.dataset.prd_id;
        let eliminar = d.getElementById(`producto_${id}`);
        eliminar.remove();
        calcularTotal();
      });
    });
  });
}

nota_compra();
