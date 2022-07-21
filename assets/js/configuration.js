const d = document;
// SECCIÓN TEMPORAL PARA SUBIR LOGO DE EMPRESA EN LA CONFIGURACIÓN
let myFile = d.getElementById("myFile");
myFile.addEventListener("change", (e) => {
  let update = d.getElementById("img-logo");
  const objectURL = URL.createObjectURL(myFile.files[0]);
  update.src = objectURL;
});
