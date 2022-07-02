const btnsend = document.getElementById("btn-send");

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

export{
    campos,
    validarFormulario
}