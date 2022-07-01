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
    // console.log(table_body);
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
    const section_modal = d.createElement("section");
    
    html = `
    <div class="modal fade bd-example-modal-lg" id="mymodal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Confirmación de compra</h5>
                <span data-dismiss="modal" aria-label="Close" class="close"><i class="fa-solid fa-xmark"></i></span>
            </div>
            <div class="modal-body" id="ticket">
                <div class="ticket-generado">
                    <h3 class="text-center">Mi punto de venta<h3>
                    <p class="text-center">Fecha: 30-06-2022</p>
                    <p class="text-center">Ticket No. 85566</p>
                    <p class="text-center">Av. Lopez Mateos #587 Playa ensenada</p>
                    <p class="text-center">Vendedor: Pedro</p>

                    <table table bgcolor= "#FFFFFF"  class="table table-bordered">
                        <thead>
                        <tr>
                            <th scope="col">Can.</th>
                            <th scope="col">Prod.</th>
                            <th scope="col">P. compra</th>
                            <th scope="col">Subtotal</th>
                        </tr>
                        </thead>
                        <tbody id="table-body">
                            <th>${aComprar[0].cantidad}</th>
                            <th>${aComprar[0].producto}</th>
                            <th>${aComprar[0].p_compra}</th>
                            <th>${aComprar[0].subtotal}</th>
                        </tbody>
                    </table>
                    <p>Total Neto: $582</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-close-modal" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn-save-modal">Comprar y imprimir ticket</button>
                    <button type="button" class="btn-save-modal" id="save_ticket">Guardar ticket</button>
                </div>
            </div>
        </div>
    </div>
    </div>`;
    info_compra.insertAdjacentElement('afterend', section_modal)
    section_modal.innerHTML += html;
    $('#mymodal').modal('show')
    const save_ticket = d.getElementById("save_ticket");
    save_ticket.addEventListener("click", (e) => {
        const element = d.getElementById("ticket");
        html2pdf().set({
            margin: 1,
            filename: 'prueba.pdf',
            image: {
                type: 'jpeg',
                quality: 0.98
            },
            html2canvas: {
                scale: 3,
                letterRendering: true,
            },
            jsPDF: {
                unit: 'in',
                format: 'a3',
            }
        }).from(element).save().catch(err => console)
    })
})
