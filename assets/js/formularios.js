const d = document;
const formulario = d.getElementById("formulario");
let inputs = d.querySelectorAll("#formulario input");
const btnsend = d.getElementById("btn-send");
const expresiones = { // REGEX, SE MANDA A LLAMAR DE ACUERDO AL CAMPO A VALIDAR
	nombre: /^[a-zA-ZÀ-ÿ\s\d]{1,60}$/, // password: /^.{1,}$/, 
}

const campos = { 
    nombre_prov: false,
    producto_prov: false,
    cantidad_prov: false,
    pcompra_prov: false,
    pventa_prov: false,
    razon_social: false,
    rfc: false,
    domicilio: false,
    cpostal: false,
    telefono: false,
}
const validarCampo = (expresion, input, campo) => {
    let err = document.querySelector(`#group-${campo} .input-error`);
    if(expresion.test(input.value)){
        document.getElementById(`group-${campo}`).classList.remove("form-incorrecto");
        document.getElementById(`group-${campo}`).classList.add("form-correcto");
        if(err) err.classList.remove("active");
        btnsend.disabled=false;
        btnsend.classList.remove("deshabilitar");
        campos[campo] = true;
    }else{
        document.getElementById(`group-${campo}`).classList.add("form-incorrecto");
        document.getElementById(`group-${campo}`).classList.remove("form-correcto");
        if(err) err.classList.add("active");
        btnsend.classList.add("deshabilitar");
        btnsend.disabled = true;
        campos[campo] = false;
    }
}
const validarFormulario = (e) => {
    switch (e.target.id) {
        case "nombre_prov":
            validarCampo(expresiones.nombre, e.target, 'nombre_prov')
            break;
        case "producto_prov":
            validarCampo(expresiones.nombre, e.target, 'producto_prov')
            break;
        case "cantidad_prov":
            validarCampo(expresiones.nombre, e.target, 'cantidad_prov')
            break;
        case "pcompra_prov":
            validarCampo(expresiones.nombre, e.target, 'pcompra_prov')
            break;
        case "pventa_prov":
            validarCampo(expresiones.nombre, e.target, 'pventa_prov')
            break;
            // DATOS DEL NEGOCIO
        case "razon_social":
            validarCampo(expresiones.nombre, e.target, 'razon_social')
            break;
        case "rfc":
            validarCampo(expresiones.nombre, e.target, 'rfc')
            break;
        case "domicilio":
            validarCampo(expresiones.nombre, e.target, 'domicilio')
            break;
        case "cpostal":
            validarCampo(expresiones.nombre, e.target, 'cpostal')
            break;
        case "telefono":
            validarCampo(expresiones.nombre, e.target, 'telefono')
            break;
        default:
            break;
    }
}

if(inputs){
    inputs.forEach((input) => {
        input.addEventListener('keyup', validarFormulario)
        input.addEventListener('blur', validarFormulario)
    })
}

table_body = d.getElementById("table-body");
total_pagar = d.getElementById("total-pagar");
add = 1;
formulario.addEventListener("submit", (e) => {
    e.preventDefault();
    if(campos.nombre_prov, campos.producto, campos.cantidad_prov,campos.pcompra_prov,campos.pventa_prov){
        const product = `<tr id="producto_${add}">
                            <td>${formulario.producto_prov.value}</td>
                            <td>${formulario.cantidad_prov.value}</td>
                            <td>${formulario.pcompra_prov.value}</td>
                            <td><span>$<span><span class="precio">${formulario.cantidad_prov.value * formulario.pcompra_prov.value}</span></td>
                            <td class="text-center"><a href="#" class="btn-tb-delete" data-prd_id='${add}'><i class="fa-solid fa-trash-can"></i></a></td>
                        </tr>`;
        table_body.innerHTML += product;
        let todo = d.querySelectorAll(".precio");
        let total = [];
        add++
        todo.forEach(el => {
            total.push(parseInt(el.innerText));
        });
        let suma_total = 0;
        for (let i = 0; i < total.length; i++) {
            suma_total += total[i];
        }
        total_pagar.innerHTML = suma_total;
        // ----------------
        let product_delete = d.querySelectorAll(".btn-tb-delete")
        product_delete.forEach(el => {
            el.addEventListener("click", (e) => {
                let id = el.dataset.prd_id;
                eliminar = d.getElementById(`producto_${id}`);
                eliminar.remove();
                let todo = d.querySelectorAll(".precio");
                let total = [];
                todo.forEach(el => {
                    total.push(parseInt(el.innerText));
                });
                let suma_total = 0;
                for (let i = 0; i < total.length; i++) {
                    suma_total += total[i];
                }
                    total_pagar.innerHTML = suma_total;
            })
        })
    }else{
        alert("Rellena todos los campos correctamente.");
    }
})

let comprar = d.getElementById("comprar");
comprar.addEventListener("click", (e) => {
    e.preventDefault();
    console.log(table_body);
    const aComprar = [];

    for (var i = 0, row; row = table_body.rows[i]; i++) {
        const obj = {
            producto: row.cells[0].innerText,
            cantidad: row.cells[1].innerText,
            p_compra: row.cells[2].innerText,
            subtotal: row.cells[3].innerText,
        }
        aComprar.push(obj)
    }
    const info_compra = d.querySelector(".info-compra");
    const section_modal = d.createElement("section")
    html = `<div class="modal fade bd-example-modal-lg" id="mymodal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle">Confirme los productos</h5>
              <span data-dismiss="modal" aria-label="Close" class="close"><i class="fa-solid fa-xmark"></i></span>
          </div>
          <div class="modal-body">
              <div class="">
                Nombre producto: ${aComprar[0].producto}
                Cantidad: ${aComprar[0].cantidad}
                Precio de compra: ${aComprar[0].p_compra}
                Subtotal: ${aComprar[0].subtotal}
              </div>
              <br>
              <div class="modal-footer">
                  <button type="button" class="btn-close-modal" data-dismiss="modal">Cerrar</button>
                  <button type="button" class="btn-save-modal">Agregar</button>
              </div>
          </div>
      </div>
    </div>
  </div>`;
    info_compra.insertAdjacentElement('afterend', section_modal)
    section_modal.innerHTML += html;
    $('#mymodal').modal('show')
})
