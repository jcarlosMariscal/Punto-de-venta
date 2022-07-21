import { campos, validarFormulario } from "./validar.js";
const d = document;

const formulario = d.getElementById("formulario");
let inputs = d.querySelectorAll("#formulario input");
if (inputs) {
  inputs.forEach((input) => {
    input.addEventListener("keyup", validarFormulario);
    input.addEventListener("blur", validarFormulario);
  });
}

if (formulario) {
  formulario.addEventListener("submit", (e) => {
    e.preventDefault();
    if (
      (campos.nombre,
      campos.rfc,
      campos.telefono,
      campos.correo,
      campos.caja,
      campos.password)
    ) {
      alert("Información validada");
    } else {
      alert("Rellena todos los campos correctamente.");
    }
  });
}
