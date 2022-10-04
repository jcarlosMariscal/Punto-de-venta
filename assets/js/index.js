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

const toggle = document.getElementById("header-toggle");
const close_toggle = document.getElementById("close-toggle");
const nav = document.getElementById("navbar");
toggle.addEventListener("click", () => {
  nav.classList.add("show-nav");
});
close_toggle.addEventListener("click", () => {
  nav.classList.remove("show-nav");
});

const fijar_nav = document.getElementById("fijar_nav");
const main = document.getElementById("main");

fijar_nav.addEventListener("change", (e) => {
  let checked = fijar_nav.checked;
  if (checked) {
    // localStorage.setItem("fijado", "si");
    main.classList.add("nav_fijado");
    toggle.style.display = "none";
    close_toggle.style.display = "none";
  } else {
    // localStorage.setItem("fijado", "no");
    main.classList.remove("nav_fijado");
    toggle.style.display = "block";
    close_toggle.style.display = "block";
    nav.classList.add("show-nav");
  }
});

// setInterval(() => {
//   let fijado = localStorage.getItem("fijado");
//   if (fijado == "si") {
//     main.classList.add("nav_fijado");
//     toggle.style.display = "none";
//     close_toggle.style.display = "none";
//   } else if (fijado == "no") {
//     main.classList.remove("nav_fijado");
//     toggle.style.display = "block";
//     close_toggle.style.display = "block";
//     nav.classList.add("show-nav");
//   }
// }, 3000);

document.addEventListener("DOMContentLoaded", (e) => {
  const links = document.querySelectorAll(".nav-link");
  links.forEach((link) => {
    link.addEventListener("click", (e) => {
      links.forEach((l) => l.classList.remove("active"));
      this.classList.add("active");
    });
  });
});
