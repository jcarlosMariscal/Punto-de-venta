const d = document;
const formulario = d.getElementById("formulario");
let inputs = d.querySelectorAll("#formulario input");
const btnsend = d.getElementById("btn-send");
const expresiones = { // REGEX, SE MANDA A LLAMAR DE ACUERDO AL CAMPO A VALIDAR
	nombre: /^[a-zA-ZÀ-ÿ\s]{3,60}$/, // password: /^.{1,}$/, 
}

const campos = { 
    nombre_prov: false,
    producto: false,
    cantidad_prov: false,
    pcompra_prov: false,
    pventa_prov: false,
}
const validarCampo = (expresion, input, campo) => {
    console.log(btnsend);
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
        case "nombre-prov":
            validarCampo(expresiones.nombre, e.target, 'nombre-prov')
            break;
        case "producto-prov":
            validarCampo(expresiones.nombre, e.target, 'producto-prov')
            break;
        case "cantidad-prov":
            validarCampo(expresiones.nombre, e.target, 'cantidad-prov')
            break;
        case "pcompra-prov":
            validarCampo(expresiones.nombre, e.target, 'pcompra-prov')
            break;
        case "pventa-prov":
            validarCampo(expresiones.nombre, e.target, 'pventa-prov')
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

btnsend.addEventListener("submit", () => {
    console.log("enviando");
})
// if(nombre_prov, producto, cantidad_prov,pcompra_prov,pventa_prov){
//     console.log("listo");
// }else{
    
// }
