import fullscreenModal from "./helper/fullscreen-modal.js";
import { campos, expresiones, validarFormulario } from "./validar.js";
const d = document;

const btnsend = d.getElementById("btn-send");
let inputs = d.querySelectorAll("#formulario input");
let inputsEdit = d.querySelectorAll("#formularioEdit input");
if (inputs) {
  inputs.forEach((input) => {
    input.addEventListener("keyup", validarFormulario);
    input.addEventListener("blur", validarFormulario);
  });
}

const validarCampoEdit = (expresion, input, campo) => {
  let err = d.querySelector(`#group-${campo} .input-error-log`);
  console.log(campo + " - " + expresion.test(input.value));
  if (expresion.test(input.value)) {
    console.log("correcto");
    d.getElementById(`group-${campo}`).classList.remove("form-incorrecto");
    d.getElementById(`group-${campo}`).classList.add("form-correcto");
    console.log(d.getElementById(`group-${campo}`));
    if (err) err.classList.remove("active");
    btnsend.disabled = false;
    btnsend.classList.remove("deshabilitar");
    campos[campo] = true;
  } else {
    console.log("mal");
    d.getElementById(`group-${campo}`).classList.add("form-incorrecto");
    d.getElementById(`group-${campo}`).classList.remove("form-correcto");
    if (err) err.classList.add("active");
    btnsend.classList.add("deshabilitar");
    btnsend.disabled = true;
    campos[campo] = false;
  }
  console.log(btnsend);
};
const validarFormularioEdit = (e) => {
  switch (e.target.id) {
    case "nombre":
      validarCampoEdit(expresiones.nombre, e.target, "nombre");
      break;
    case "correo":
      validarCampoEdit(expresiones.pass, e.target, "correo");
      break;
    case "telefono":
      validarCampoEdit(expresiones.telefono, e.target, "telefono");
      break;
    case "pass":
      validarCampoEdit(expresiones.pass, e.target, "pass");
      break;
    default:
      break;
  }
};

if (inputsEdit) {
  inputsEdit.forEach((input) => {
    // console.log(input);
    input.addEventListener("keyup", validarFormularioEdit);
    input.addEventListener("blur", validarFormularioEdit);
    // input.addEventListener("mousemove", validarFormulario);
  });
}

// const cerrar = d.getElementById("cerrarForm");
// const cerrar2 = d.getElementById("cerrarForm2");
// cerrar.addEventListener("click", (e) => {
//   window.location.href = "index.php?p=proveedor";
// });
// cerrar2.addEventListener("click", (e) => {
//   window.location.href = "index.php?p=proveedor";
// });

fullscreenModal(); // LLAMAMOS AL MÓDULO FULLSCREEN
