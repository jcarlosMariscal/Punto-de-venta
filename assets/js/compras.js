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
if (comprar && cancelar) {
  (comprar.disabled = true), (cancelar.disabled = true);
  comprar.classList.add("deshabilitar"), cancelar.classList.add("deshabilitar");
}

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
    // console.log("ho");
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
    nuevoLabel.innerHTML += `<input type="radio" class="rad-input" name="producto" value="${nuevoNombre}">
                  <div class="rad-design"></div>
                  <div class="rad-text"><span class="text-codigo">${nuevoCodigo}</span> - ${nuevoNombre}</div>`;
    selecProd.insertAdjacentElement("afterbegin", nuevoLabel);
    agregarNuevoForm.classList.remove("mostrar-form");
    agregarNuevoForm.classList.add("agregar-nuevo-form");
    localStorage.setItem(nuevoNombre, nuevoCodigo);
  });
}

const db_get_code = d.getElementById("db_get_code");
const db_get_name = d.getElementById("db_get_name");
const buscarProd = (e, nombreProd) => {
  const alertProduct = d.getElementById("alertProduct");
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
        if (data == "noEncontrado") {
          // Swal.fire({
          //   title: "Producto no encontrado.",
          //   text: "Verifique que el código o nombre sean correctos",
          //   icon: "error", //error,
          //   timer: 2000,
          //   toast: true,
          //   position: "top-end",
          //   showConfirmButton: false,
          //   confirmButtonColor: "#47874a",
          // });
          alertProduct.innerHTML = `
            <div class="alert alert-warning" role="alert">
              El código o nombre del producto no cincide con ninguna registrada en la base de datos. Para agregar una nueva abra el modal para seleccionar productos, seleccione Nuevo producto, llené los campos, seleccione el producto agregado y siga llenando el formulario.
            </div>`;
        } else {
          // console.log(nombre_prod.value);
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
if (seleccionarProducto) {
  seleccionarProducto.addEventListener("click", (e) => {
    let boxs = d.querySelectorAll("#form-select-prod input");
    boxs.forEach((box) => {
      if (box.checked) {
        buscarProd(e, box.value);
        db_get_code.value = localStorage.getItem(box.value);
        db_get_name.value = box.value;
      }
    });
  });
}
// Filtrar producto
const filtrarProducto = d.getElementById("filtrarProducto");
// const radLabel = d.querySelectorAll(".rad-label"); // Obtener todos los input radio para seleccinar producto
if (filtrarProducto) {
  filtrarProducto.addEventListener("keyup", (e) => {
    d.querySelectorAll(".radLabelProduct").forEach((el) => {
      let producto = el.children[2].innerText;
      producto.toLowerCase().includes(filtrarProducto.value.toLowerCase())
        ? el.classList.remove("filter")
        : el.classList.add("filter");
    });
  });
}

if (formulario) {
  const btnCompraProducto = d.getElementById("btn-compraProducto");
  const id_sucursal = d.getElementById("id_sucursal");
  formulario.addEventListener("submit", (e) => e.preventDefault());
  btnCompraProducto.addEventListener("click", (e) => {
    // data-${nuevoNombre}
    let nombre_producto = d.getElementById("nombre_prod");
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
        // Proveedor en general
        if (nombre_prov.value == "") nombre_prov.value = "Proveedor en general";
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
        alertProduct.innerHTML = "";
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
  nota_compra();
}

// ---------------------- SECCIÓN VER COMPRAS ---------------------------------------

const registroCompras = d.querySelectorAll(".registroCompras");
if (registroCompras) {
  const detallesCompra = d.getElementById("detallesCompra");
  const masDetallesCompra = d.getElementById("masDetallesCompra");
  const detallesGeneral = d.getElementById("detallesGeneral");
  const cargarJson = d.getElementById("cargarJson");
  const infoUser = d.getElementById("info-user");
  registroCompras.forEach((el) => {
    el.addEventListener("click", (e) => {
      const id_compra = el.childNodes[1].childNodes[1].childNodes[1].innerText;
      let form = new FormData();
      form.append("action", "readCompraProducto");
      form.append("id_compra", id_compra);
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
            hoy.getHours() + ":" + hoy.getMinutes() + ":" + hoy.getSeconds();
          let arr = data.split("-/");
          let json1 = JSON.parse(arr[0]);
          let json2 = JSON.parse(arr[1]);
          console.log(json1);
          console.log(json2);

          detallesGeneral.innerHTML = `
            <p>Compra #${json1.id_compra}</p>
            <p>Sucursal Paletería</p>
            <button class="btn btn-success">Descargar</button>
          `;
          detallesCompra.innerHTML = `
          <div class="columna-campos">
            <p>Proveedor(es)</p>
            <p>Fecha compra</p>
            <p>Fecha consulta</p>
            <p>Sucursal</p>
            <p>Comprador</p>
            <p>Método de pago</p>
            <p>Productos</p>
            <p>Total</p>
          </div>
          <div class="columna-registros">
            <p>${json1.id_proveedor}</p>
            <p>${json1.fecha}</p>
            <p>${fecha + " " + hora}</p>
            <p>Sucursal Paletería</p>
            <p>Gerente: Juan Carlos Ramírez Mariscal</p>
            <p>Efectivo</p>
            <p>${json1.productos}</p>
            <p>${json1.total}</p>
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
                        <th scope="col">Nombre</th>
                        <th scope="col">Código</th>
                        <th scope="col">Cantidad</th>
                        <th scope="col">P. Compra</th>
                        <th scope="col">P. Venta</th>
                        <th scope="col">Unidad</th>
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
              <td class="row">${json2[i].nombre}</td>
              <td>${json2[i].codigo}</td>
              <td>${json2[i].cantidad}</td>
              <td>$${json2[i].pcompra}</td>
              <td>$${json2[i].pventa}</td>
              <td>${json2[i].unidad}</td>
              <td>${json2[i].subtotal}.0</td>
            </tr>          
            `;
          }
        });
    });
  });
}
