const d = document;
// alert("fs");
const btnsend = d.getElementById("btn-send");
let inputs = d.querySelectorAll("#formulario input");

const expresiones = {
  nombre: /^[a-zA-ZÀ-ÿ\s\d]{1,60}$/, // password: /^.{1,}$/,
  pass: /^[a-zA-ZÀ-ÿ\d]{5,}$/,
};

const campos = {
  username: false,
  pass: false,
};
const validarCampo = (expresion, input, campo) => {
  let err = d.querySelector(`#group-${campo} .input-error-log`);
  // console.log(campo + " - " + expresion.test(input.value));
  if (expresion.test(input.value)) {
    d.getElementById(`group-${campo}`).classList.remove("form-incorrecto");
    d.getElementById(`group-${campo}`).classList.add("form-correcto");
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

    default:
      break;
  }
};

if (inputs) {
  inputs.forEach((input) => {
    // console.log(input);
    input.addEventListener("keyup", validarFormulario);
    input.addEventListener("blur", validarFormulario);
    // input.addEventListener("mousemove", validarFormulario);
  });
}
