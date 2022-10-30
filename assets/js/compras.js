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
    console.log(textCodigo.innerText);
    boxs.forEach((box) => {
      if (box.checked) {
        nombre_prod.value = box.value;
      }
    });
  });
}

// Mostrar/ocultar el formulario para el código y nombre del nuevo producto en COMPRAS
const agregarNuevoForm = d.getElementById("agregarNuevoForm");
const nuevoProducto = d.getElementById("nuevoProducto");
if (nuevoProducto) {
  nuevoProducto.addEventListener("click", (e) => {
    console.log("ho");
    e.preventDefault();
    agregarNuevoForm.classList.add("mostrar-form");
    agregarNuevoForm.classList.remove("agregar-nuevo-form");
  });
}
// Detectar si se ha dado click en el botón del formulario mostrado arriba para añadirlo al formulario de selección.
const agregarNuevo = d.getElementById("agregarNuevo");
if (agregarNuevo) {
  agregarNuevo.addEventListener("click", (e) => {
    const nuevoCodigo = d.getElementById("nuevoCodigo").value;
    const nuevoNombre = d.getElementById("nuevoNombre").value;
    const nuevoLabel = d.createElement("label");
    nuevoLabel.classList.add("rad-label");
    nuevoLabel.innerHTML += `<input type="radio" class="rad-input" data-${nuevoNombre} = "${nuevoCodigo}" name="producto" value="${nuevoNombre}">
                  <div class="rad-design"></div>
                  <div class="rad-text"><span class="text-codigo">${nuevoCodigo}</span> - ${nuevoNombre}</div>`;
    selecProd.insertAdjacentElement("afterbegin", nuevoLabel);
    agregarNuevoForm.classList.remove("mostrar-form");
    agregarNuevoForm.classList.add("agregar-nuevo-form");
  });
}

const buscarProd = (e, nombreProd) => {
  const db_get_code = d.getElementById("db_get_code");
  const db_get_name = d.getElementById("db_get_name");
  nombre_prod.value = nombreProd ? nombreProd : nombre_prod.value;

  e.preventDefault();
  if (nombre_prod.value != "") {
    let consulta = new FormData();
    consulta.append("table", "buscarProducto");
    consulta.append("codNameProducto", nombre_prod.value);
    fetch("logic/createData.php", {
      method: "POST",
      body: consulta,
    })
      .then((res) => res.text())
      .then((data) => {
        // console.log(data);
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
          unidad_prod.options.item(get.unidad).selected = "selected";
          db_get_code.value = get.codigo;
          db_get_name.value = get.nombre;
        }
      });
  }
};
if (nombre_prod) {
  nombre_prod.addEventListener("blur", (e) => buscarProd(e));
  nombre_prod.addEventListener("keydown", (e) => {
    const timeout = setTimeout(() => {
      buscarProd(e);
      clearTimeout(timeout);
    }, 2000);
  });
}
const seleccionarProducto = d.getElementById("seleccionarProducto");
seleccionarProducto.addEventListener("click", (e) => {
  let boxs = d.querySelectorAll("#form-select-prod input");
  boxs.forEach((box) => {
    if (box.checked) buscarProd(e, box.value);
  });
});

if (formulario) {
  const btnCompraProducto = d.getElementById("btn-compraProducto");
  const id_sucursal = d.getElementById("id_sucursal");
  formulario.addEventListener("submit", (e) => e.preventDefault());
  btnCompraProducto.addEventListener("click", (e) => {
    e.preventDefault();
    if (
      nombre_prod.value === "" ||
      cantidad_prod.value === "" ||
      pcompra_prod.value === "" ||
      pventa_prod.value === ""
    ) {
      alert("Rellena el formulario correctamente");
    } else {
      // console.log(table_body.rows[i]);
      let existe = false;
      for (var i = 0, row; (row = table_body.rows[i]); i++) {
        // console.log(table_body.rows[i]);
        // console.log(formulario.db_get_name.value);
        if (table_body.rows[i].cells[0].innerText === db_get_name.value) {
          alert("Producto ya agregado");
          existe = true;
        } else {
          existe = false;
        }
      }
      if (!existe) {
        const product = `<tr id="producto_${add}">
            <td class="prd_name">${db_get_name.value}</td>
            <td >${db_get_code.value}</td>
            <td>${cantidad_prod.value}</td>
            <td>${pcompra_prod.value}</td>
            <td><span>$<span><span class="precio">${
              cantidad_prod.value * pcompra_prod.value
            }</span></td>
            <td class="" hidden>${nombre_prov.value}</td>
            <td hidden>${pventa_prod.value}</td>
            <td hidden>${unidad_prod.value}</td>
            <td hidden>${id_sucursal.innerText}</td>
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
    }
  });
}

nota_compra();
