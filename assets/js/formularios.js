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
}
const validarCampo = (expresion, input, campo) => {
    // console.log(btnsend);
    if(expresion.test(input.value)){
        document.getElementById(`group-${campo}`).classList.remove("form-incorrecto");
        document.getElementById(`group-${campo}`).classList.add("form-correcto");
        btnsend.disabled=false;
        btnsend.classList.remove("deshabilitar");
        campos[campo] = true;
    }else{
        document.getElementById(`group-${campo}`).classList.add("form-incorrecto");
        document.getElementById(`group-${campo}`).classList.remove("form-correcto");
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
formulario.addEventListener("submit", (e) => {
    e.preventDefault();
    console.log(formulario.nombre_prov.value);
    if(campos.nombre_prov, campos.producto, campos.cantidad_prov,campos.pcompra_prov,campos.pventa_prov){
        const product = `<tr>
                            <td>${formulario.producto_prov.value}</td>
                            <td>${formulario.cantidad_prov.value}</td>
                            <td>${formulario.pcompra_prov.value}</td>
                            <td><span>$<span><span class="precio">${formulario.cantidad_prov.value * formulario.pcompra_prov.value}</span></td>
                            <td>Eliminar</td>
                        </tr>`;
        table_body.innerHTML += product;
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
    }else{
        alert("Rellena todos los campos correctamente");
    }
})
