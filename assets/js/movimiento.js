const movPag = document.querySelector(".movPag");
const btn_adelante2 = document.querySelector(".sigPag");

const btn_adelante3 = document.querySelector(".pag-datos");
const btn_adelante4 = document.querySelector(".pag-sucur");
const btn_adelante5 = document.querySelector(".pag-comp");
const btn_fin = document.querySelector(".fin");
const btn_omitir = document.querySelector(".pag-omitir");
const btn_nsucursal = document.querySelector(".pag_nsucur");
const btn_agregar = document.querySelector(".pag-agr ");

const progressCheck = document.querySelectorAll(".paso .check");
const num = document.querySelectorAll(".paso .num");

let max = 5;
let cont = 1;

btn_adelante2.addEventListener("click", function (e) {
  e.preventDefault();
  movPag.style.marginLeft = "-20%";
  num[cont - 1].classList.add("active");
  progressCheck[cont - 1].classList.add("active");
  cont += 1;
});
btn_adelante3.addEventListener("click", function (e) {
  e.preventDefault();
  movPag.style.marginLeft = "-40%";
  num[cont - 1].classList.add("active");
  progressCheck[cont - 1].classList.add("active");
  cont += 1;
});
btn_adelante4.addEventListener("click", function (e) {
  e.preventDefault();
  movPag.style.marginLeft = "-60%";
  num[cont - 1].classList.add("active");
  progressCheck[cont - 1].classList.add("active");
  cont += 1;
});
btn_adelante5.addEventListener("click", function (e) {
  e.preventDefault();
  movPag.style.marginLeft = "-80%";
  num[cont - 1].classList.add("active");
  progressCheck[cont - 1].classList.add("active");
  cont += 1;
});
btn_fin.addEventListener("click", function (e) {
  e.preventDefault();
  num[cont - 1].classList.add("active");
  progressCheck[cont - 1].classList.add("active");
  cont += 1;
  alert("Registro Completado");
});
btn_omitir.addEventListener("click", function (e) {
  e.preventDefault();
  movPag.style.marginLeft = "-40%";
  num[cont - 1].classList.add("active");
  progressCheck[cont - 1].classList.add("active");
  cont += 1;
});
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
