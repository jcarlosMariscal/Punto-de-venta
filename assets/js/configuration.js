import { campos, validarFormulario } from "./validar.js";
const d = document;

const btn_send = d.getElementById("btn-send");
let inputs = d.querySelectorAll("#formulario input");
if (inputs) {
  inputs.forEach((input) => {
    input.addEventListener("keyup", validarFormulario);
    input.addEventListener("blur", validarFormulario);
    input.addEventListener("mousemove", validarFormulario);
  });
}

// if (btn_send) {
//   btn_send.addEventListener("click", (e) => {
//     // e.preventDefault();
//     if (
//       (campos.razon_social,
//       campos.rfc,
//       campos.domicilio,
//       campos.cpostal,
//       campos.telefono)
//     ) {
//       alert("Información validada");
//     } else {
//       alert("Rellena todos los campos correctamente.");
//     }
//   });
// }

// SECCIÓN TEMPORAL PARA SUBIR LOGO DE EMPRESA EN LA CONFIGURACIÓN
let myFile = d.getElementById("myFile");
myFile.addEventListener("change", (e) => {
  let update = d.getElementById("img-logo");
  // console.log(myFile.files[0]);
  const objectURL = URL.createObjectURL(myFile.files[0]);
  update.src = objectURL;
});
