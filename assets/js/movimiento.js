const d = document;
const movPag = d.querySelector(".movPag");
// const btn_adelante2 = document.querySelector(".sigPag");

const btn_adelante5 = d.querySelector(".pag-comp");
const btn_nsucursal = d.querySelector(".pag_nsucur");
const btn_agregar = d.querySelector(".pag-agr ");

const progressCheck = d.querySelectorAll(".paso .check");
const num = d.querySelectorAll(".paso .num");

const nextDatosFiscales = d.getElementById("nextDatosFiscales");
const btn_omitir = d.querySelector(".pag-omitir");
const btn_adelante3 = d.querySelector(".pag-datos");
const btn_adelante4 = d.querySelector(".pag-sucur");
const btn_fin = d.querySelector(".fin");

let max = 4;
let cont = 1;

// btn_adelante5.addEventListener("click", function (e) {
//   e.preventDefault();
//   movPag.style.marginLeft = "-80%";
//   num[cont - 1].classList.add("active");
//   progressCheck[cont - 1].classList.add("active");
//   cont += 1;
// });

btn_nsucursal.addEventListener("click", function (e) {
  e.preventDefault();
  movPag.style.marginLeft = "-60%";
  num[cont - 1].classList.add("active");
  progressCheck[cont - 1].classList.add("active");
});
btn_nsucursal.addEventListener("click", function (e) {
  e.preventDefault();
  movPag.style.marginLeft = "-60%";
  num[cont - 1].classList.add("active");
  progressCheck[cont - 1].classList.add("active");
  cont += 1;
});

// RECIBIR DATOS
nextDatosFiscales.addEventListener("click", (e) => {
  e.preventDefault();
  const negocio_nombre = d.getElementById("negocio_nombre").value;
  const negocio_tipo = d.getElementById("negocio_tipo").value;
  const negocio_telefono = d.getElementById("negocio_telefono").value;
  const negocio_correo = d.getElementById("negocio_correo").value;
  const negocio_imagen = d.getElementById("negocio_imagen").files[0];
  let form = new FormData();
  form.append("table", "negocio");
  form.append("nombre", negocio_nombre);
  form.append("tipo", negocio_tipo);
  form.append("telefono", negocio_telefono);
  form.append("correo", negocio_correo);
  form.append("imagen", negocio_imagen);
  fetch("view/logic/createData.php", {
    method: "POST",
    body: form,
  })
    .then((res) => res.text())
    .then((data) => {
      console.log(data);
      if (data.includes("negocioRegistrado")) {
        Swal.fire({
          title: "Negocio registrado",
          text: "",
          icon: "success", //error,
          timer: 5000,
          toast: true,
          position: "top-end",
          showConfirmButton: false,
          confirmButtonColor: "#47874a",
        });
        const lastId = data.replace(/[^0-9]+/g, "");
        localStorage.setItem("lastId", lastId);
        movPag.style.marginLeft = "-20%";
        num[cont - 1].classList.add("active");
        progressCheck[cont - 1].classList.add("active");
        cont += 1;
      } else if (data === "error") {
      }
    });
});
btn_omitir.addEventListener("click", (e) => {
  e.preventDefault();
  Swal.fire({
    title: "Datos fiscales omitidos",
    text: "Podrá registrar esta información una vez iniciado sesión en el sistema",
    icon: "success", //error,
    timer: 5000,
    toast: true,
    position: "top-end",
    showConfirmButton: false,
    confirmButtonColor: "#47874a",
  });
  movPag.style.marginLeft = "-40%";
  num[cont - 1].classList.add("active");
  progressCheck[cont - 1].classList.add("active");
  cont += 1;
});
btn_adelante3.addEventListener("click", (e) => {
  e.preventDefault();
  const df_nombre = d.getElementById("df_nombre").value;
  const df_rfc = d.getElementById("df_rfc").value;
  const df_regimen = d.getElementById("df_regimen").value;
  const lastId = localStorage.getItem("lastId");
  let form = new FormData();
  form.append("table", "datos_fiscales");
  form.append("nombre", df_nombre);
  form.append("rfc", df_rfc);
  form.append("regimen", df_regimen);
  form.append("id_negocio", lastId);
  fetch("view/logic/createData.php", {
    method: "POST",
    body: form,
  })
    .then((res) => res.text())
    .then((data) => {
      console.log(data);
      if (data === "dfRegistrado") {
        Swal.fire({
          title: "Datos fiscales registrados",
          text: "",
          icon: "success", //error,
          timer: 5000,
          toast: true,
          position: "top-end",
          showConfirmButton: false,
          confirmButtonColor: "#47874a",
        });
        movPag.style.marginLeft = "-40%";
        num[cont - 1].classList.add("active");
        progressCheck[cont - 1].classList.add("active");
        cont += 1;
      } else if (data === "error") {
      }
    });
});
btn_adelante4.addEventListener("click", function (e) {
  e.preventDefault();
  const sucursal_estado = d.getElementById("sucursal_estado").value;
  const sucursal_ciudad = d.getElementById("sucursal_ciudad").value;
  const sucursal_colonia = d.getElementById("sucursal_colonia").value;
  const sucursal_direccion = d.getElementById("sucursal_direccion").value;
  const sucursal_CP = d.getElementById("sucursal_CP").value;
  const sucursal_telefono = d.getElementById("sucursal_telefono").value;
  const sucursal_correo = d.getElementById("sucursal_correo").value;
  const lastId = localStorage.getItem("lastId");
  let form = new FormData();
  form.append("table", "sucursal");
  form.append("estado", sucursal_estado);
  form.append("ciudad", sucursal_ciudad);
  form.append("colonia", sucursal_colonia);
  form.append("direccion", sucursal_direccion);
  form.append("codigo_postal", sucursal_CP);
  form.append("telefono", sucursal_telefono);
  form.append("correo", sucursal_correo);
  form.append("id_negocio", lastId);
  fetch("view/logic/createData.php", {
    method: "POST",
    body: form,
  })
    .then((res) => res.text())
    .then((data) => {
      console.log(data);
      if (data === "sucursalRegistrado") {
        Swal.fire({
          title: "Sucursal registrado",
          text: "",
          icon: "success", //error,
          timer: 5000,
          toast: true,
          position: "top-end",
          showConfirmButton: false,
          confirmButtonColor: "#47874a",
        });
        movPag.style.marginLeft = "-60%";
        num[cont - 1].classList.add("active");
        progressCheck[cont - 1].classList.add("active");
        cont += 1;
      } else if (data === "error") {
      }
    });
});

btn_fin.addEventListener("click", function (e) {
  e.preventDefault();
  const admin_nombre = d.getElementById("admin_nombre").value;
  const admin_pass = d.getElementById("admin_contra").value;
  const admin_correo = d.getElementById("admin_correo").value;
  const admin_telefono = d.getElementById("admin_telefono").value;
  const lastId = localStorage.getItem("lastId");
  let form = new FormData();
  form.append("table", "administrador");
  form.append("nombre", admin_nombre);
  form.append("pass", admin_pass);
  form.append("correo", admin_correo);
  form.append("telefono", admin_telefono);
  form.append("id_negocio", lastId);
  fetch("view/logic/createData.php", {
    method: "POST",
    body: form,
  })
    .then((res) => res.text())
    .then((data) => {
      console.log(data);
      if (data === "adminRegistrado") {
        num[cont - 1].classList.add("active");
        progressCheck[cont - 1].classList.add("active");
        cont += 1;
        location.href = "login.php";
        localStorage.removeItem("lastId");
        localStorage.setItem("alert", "show");
        // window.location.href = "https://www.delftstack.com/howto/";
      } else if (data === "error") {
      }
    });
});
