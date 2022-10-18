// FUNCIONALIDAD: ABRIR EL MODAL EN PANTALLA COMPLETA

/**
 * DOCUMENTATION
 * - Copiar el boton y pegarlo en el modal
 * - Colocar el id [seccion-modal] al modal
 * - Llamar la siguiente función al archivo javascript de la sección para importarlo.
 */
export default function () {
  const d = document;
  const fullscreen = d.getElementById("btn-fullscreen");
  const seccionModal = d.getElementById("seccion-modal");
  fullscreen.addEventListener("click", (e) => {
    e.preventDefault();
    seccionModal.classList.toggle("modal-fullscreen");
  });
  fullscreen.addEventListener("click", (e) => {
    e.preventDefault();
    if (seccionModal.classList.contains("modal-fullscreen")) {
      fullscreen.classList.add("fullscreen-yes");
      fullscreen.classList.remove("fullscreen-no");
      fullscreen.innerHTML = `<i class="fa-solid fa-down-left-and-up-right-to-center"></i>`;
    } else {
      fullscreen.classList.add("fullscreen-no");
      fullscreen.classList.remove("fullscreen-yes");
      fullscreen.innerHTML = `<i class="fa-solid fa-up-right-and-down-left-from-center"></i>`;
    }
  });
}
