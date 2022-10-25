const d = document;
const generarCodigo = d.getElementById("formCodigo");
const btnAdd = d.getElementById("btn-add");

generarCodigo.addEventListener("submit", (e) => {
  e.preventDefault();
  let codigo = generarCodigo.codigo.value;
  JsBarcode("#barcode", generarCodigo.codigo.value);
});

btnAdd.addEventListener("click", (e) => {
  // console.log(generarCodigo);
  // console.log(generarCodigo.producto.value);
  // console.log(generarCodigo);
  let form = new FormData();
  form.append("table", "generarCodigo");
  form.append("codigo", generarCodigo.codigo.value);
  form.append("nombre", generarCodigo.producto.value);
  fetch("logic/createData.php", {
    method: "POST",
    body: form,
  })
    .then((res) => res.text())
    .then((data) => {
      console.log(data);
      if (data == "correcto") {
        window.location.href = "index.php?p=productos";
      }
    });
});

const verCodigo = d.getElementById("verCodigo");
const btnCerrar = d.getElementById("btn-cerrar");
JsBarcode("#ver-barcode", verCodigo.innerText);
btnCerrar.addEventListener("click", (e) => {
  window.location.href = "index.php?p=productos";
});
