import { campos, validarFormulario } from "./validar.js";
const d = document;
let inputs = d.querySelectorAll("#formulario input");
if (inputs) {
  inputs.forEach((input) => {
    input.addEventListener("keyup", validarFormulario);
    input.addEventListener("blur", validarFormulario);
    input.addEventListener("mousemove", validarFormulario);
  });
}

// SECCIÓN TEMPORAL PARA SUBIR LOGO DE EMPRESA EN LA CONFIGURACIÓN
let myFile = d.getElementById("myFile");
myFile.addEventListener("change", (e) => {
  let update = d.getElementById("img-logo");
  // console.log(myFile.files[0]);
  const objectURL = URL.createObjectURL(myFile.files[0]);
  update.src = objectURL;
});

const registrarDF = d.getElementById("registrarDF");
if (registrarDF) {
  registrarDF.addEventListener("click", (e) => {
    e.preventDefault();
    const formDF = d.getElementById("formDF");
    const noDatosFiscales = d.getElementById("noDatosFiscales");
    const modal_footer = d.getElementById("modal-footerNoDatos");
    const id_negocio = d.getElementById("id_negocio");
    registrarDF.style.display = "none";
    noDatosFiscales.style.display = "none";
    modal_footer.style.display = "none";
    formDF.innerHTML = `
      <form class="form-user" id="formulario" method="POST" action="logic/createData.php">
      <input type="hidden" name="table" id="table" value="datos_fiscales_sistema">
      <input type="hidden" name="id_negocio" id="id_negocio" value="${id_negocio.innerText}">
        <div class="input-nombre input-user" id="group-nombre">                                       
          <label for="">Nombre: </label>
          <input type="text" class="input" name="nombre" id="nombre" placeholder="Introduce tu nombre">
          <p class="input-error">* Rellena</p>
        </div>
        <div class="input-rfc input-user" id="group-rfc">                                       
          <label for="">R.F.C: </label>
          <input type="text" class="input" name="rfc" id="rfc" placeholder="Introduce tu RFC">
          <p class="input-error">* Rellena</p>
        </div>
        <div class="input-regimen input-user" id="group-regimen">                                       
          <label for="">R. Fiscal: </label>
          <input type="text" class="input" name="regimen" id="regimen" placeholder="Introduce tu régimen fiscal">
          <p class="input-error">* Rellena</p>
        </div>
        <br>
        <div class="input-submit modal-footer">
          <button type="button" class="btn-close-modal" data-dismiss="modal">Cerrar</button>
          <input type="submit" class="btn-cfg" value="Agregar" id="btn-send">
        </div>
      </form>
    `;
  });
}
