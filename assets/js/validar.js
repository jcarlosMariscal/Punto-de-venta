const d = document;
const btnsend = document.getElementById("btn-send");

const expresiones = {
  nombre: /^[a-zA-ZÀ-ÿ\s]{1,60}$/, // password: /^.{1,}$/,
  correo: /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/,
  // razon_social: /^[A-Za-z]+((\s)?((\'|\-|\.\&)?\&([A-Za-z])+))*$/,
  razon_social: /^[a-zA-ZÀ-ÿ\s\d\&]{1,60}$/,
  domicilio: /^[a-zA-ZÀ-ÿ\s\d\,\#.]{1,60}$/,
  rfc: /^([A-ZÑ&]{3,4}) ?(?:- ?)?(\d{2}(?:0[1-9]|1[0-2])(?:0[1-9]|[12]\d|3[01])) ?(?:- ?)?([A-Z\d]{2})([A\d])$/,
  cpostal: /^\d{5}$/,
  telefono: /^\d{10}$/,
  pass: /^[a-zA-Z\d]{5,}$/,
  cantidad: /[\d]$/,
  precio: /^[0-9]+([.][0-9]+)?$/,
  caja: /\d$/,
};

const campos = {
  username: false,
  pass: false,
  nombre_prov: false,
  nombre: false,
  producto_prov: false,
  cantidad_prov: false,
  pcompra_prov: false,
  pventa_prov: false,
  razon_social: false,
  rfc: false,
  domicilio: false,
  cpostal: false,
  telefono: false,
  correo: false,
  caja: false,
  password: false,
};
const validarCampo = (expresion, input, campo) => {
  let err = d.querySelector(`#group-${campo} .input-error`);
  // console.log(campo + " - " + expresion.test(input.value));
  if (expresion.test(input.value)) {
    d.getElementById(`group-${campo}`).classList.remove("form-incorrecto");
    d.getElementById(`group-${campo}`).classList.add("form-correcto");
    // console.log(d.getElementById(`group-${campo}`));
    if (err) err.classList.remove("active");
    btnsend.disabled = false;
    btnsend.classList.remove("deshabilitar");
    campos[campo] = true;
  } else {
    d.getElementById(`group-${campo}`).classList.add("form-incorrecto");
    d.getElementById(`group-${campo}`).classList.remove("form-correcto");
    if (err) err.classList.add("active");
    btnsend.classList.add("deshabilitar");
    btnsend.disabled = true;
    campos[campo] = false;
  }
};
const validarFormulario = (e) => {
  switch (e.target.id) {
    case "username":
      validarCampo(expresiones.nombre, e.target, "username");
      break;
    case "pass":
      validarCampo(expresiones.pass, e.target, "pass");
      break;
    case "nombre_prov":
      validarCampo(expresiones.nombre, e.target, "nombre_prov");
      break;
    case "nombre":
      validarCampo(expresiones.nombre, e.target, "nombre");
      break;
    case "producto_prov":
      validarCampo(expresiones.nombre, e.target, "producto_prov");
      break;
    case "cantidad_prov":
      validarCampo(expresiones.cantidad, e.target, "cantidad_prov");
      break;
    case "pcompra_prov":
      validarCampo(expresiones.precio, e.target, "pcompra_prov");
      break;
    case "pventa_prov":
      validarCampo(expresiones.precio, e.target, "pventa_prov");
      break;
    // DATOS DEL NEGOCIO
    case "razon_social":
      validarCampo(expresiones.razon_social, e.target, "razon_social");
      break;
    case "rfc":
      validarCampo(expresiones.rfc, e.target, "rfc");
      break;
    case "domicilio":
      validarCampo(expresiones.domicilio, e.target, "domicilio");
      break;
    case "cpostal":
      validarCampo(expresiones.cpostal, e.target, "cpostal");
      break;
    case "telefono":
      validarCampo(expresiones.telefono, e.target, "telefono");
      break;
    case "correo":
      validarCampo(expresiones.correo, e.target, "correo");
      break;
    case "caja":
      validarCampo(expresiones.caja, e.target, "caja");
      break;
    case "factura":
      validarCampo(expresiones.nombre, e.target, "factura");
      break;
    case "identificador":
      validarCampo(expresiones.caja, e.target, "identificador");
      break;
    default:
      break;
  }
};

export { campos, validarFormulario, expresiones };
