const d = document;
const nota_compra = () => {
  let table_body = d.getElementById("table-body");
  let comprar = d.getElementById("comprar");
  comprar.addEventListener("click", (e) => {
    e.preventDefault();
    const aComprar = [];

    for (var i = 0, row; (row = table_body.rows[i]); i++) {
      const obj = {
        producto: row.cells[0].innerText,
        cantidad: row.cells[1].innerText,
        p_compra: row.cells[2].innerText,
        subtotal: row.cells[3].innerText,
        proveedor: row.cells[4].innerText,
        p_venta: row.cells[5].innerText,
      };
      aComprar.push(obj);
    }

    const info_compra = d.querySelector(".info-compra");
    const section_modal = d.createElement("section");
    let myForm = new FormData();
    myForm.append("getNegocio", "obtener");
    let config;
    fetch("logic/confi.php", {
      method: "POST",
      body: myForm,
    })
      .then((res) => res.text())
      .then((data) => {
        console.log(data);
        if (data === "confiError" || data == "error") {
          return;
        }
        let get = JSON.parse(data);
        // console.log(get);
        let html = `
        <div class="modal fade bd-example-modal-lg" id="mymodal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Confirmación de compra</h5>
                    <span data-dismiss="modal" aria-label="Close" class="close"><i class="fa-solid fa-xmark"></i></span>
                </div>
                <div class="modal-body" id="ticket">
                    <div class="ticket-generado">
                        <img src="../imagenes/${get.imagen}" class="ticket-logo">
                        <h3 class="text-center">${get.razon_social}<h3>
                        <p class="text-center">Fecha: 30-06-2022</p>
                        <p class="text-center">Compra No. 85</p>
                        <p class="text-center">${get.domicilio}, ${get.cpostal}</p>
                        <p class="text-center">${get.telefono}</p>

                        <table table bgcolor= "#FFFFFF"  class="table table-bordered">
                            <thead>
                            <tr>
                                <th scope="col">Can.</th>
                                <th scope="col">Prod.</th>
                                <th scope="col">P. compra</th>
                                <th scope="col">Subtotal</th>
                            </tr>
                            </thead>
                            <tbody id="table-ticket">
                                
                            </tbody>
                        </table>
                        <p>Total Neto: $<span id="total_neto"></span></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn-close-modal" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn-save-modal" id="comprarProductos">Comprar</button>
                        <button type="button" class="btn-save-modal" id="save_ticket">Descargar</button>
                    </div>
                </div>
            </div>
        </div>
        </div>`;
        info_compra.insertAdjacentElement("afterend", section_modal);
        section_modal.innerHTML += html;

        let table_ticket = d.getElementById("table-ticket");
        let regex = /(\d+)/g;
        let total = 0;
        for (let i = 0; i < aComprar.length; i++) {
          table_ticket.innerHTML += `
                    <th>${aComprar[i].cantidad}</th>
                    <th>${aComprar[i].producto}</th>
                    <th>${aComprar[i].p_compra}</th>
                    <th>${aComprar[i].subtotal}</th>
                `;
          let getSubTotal = aComprar[i].subtotal.match(regex);
          total += parseFloat(getSubTotal);
        }

        const total_neto = d.getElementById("total_neto");
        total_neto.innerHTML = total;
        $("#mymodal").modal("show");
        const save_ticket = d.getElementById("save_ticket");
        const comprarProductos = d.getElementById("comprarProductos");
        comprarProductos.addEventListener("click", (e) => {
          // console.log(aComprar);

          let form = new FormData();
          let data = JSON.stringify(aComprar);
          // console.log(data);
          form.append("data", data);
          // console.log(form.get("data"));
          fetch("logic/compras.php", {
            method: "POST",
            body: form,
          })
            .then((res) => res.text())
            .then((data) => {
              console.log(data);
              if (data.includes("compraCorrecta")) {
                // let comprar = localStorage.getItem("comprar");
                // if (comprar === "true") {
                Swal.fire({
                  title: "Productos agregados",
                  text: "Para los productos que han sido detectados en la base de datos, se les ha sumado la cantidad comprada. Consultelo en la sección de almacén.",
                  icon: "success", //error,
                  showConfirmButton: true,
                  confirmButtonText: "Aceptar",
                  confirmButtonColor: "#47874a",
                }).then((button) => {
                  if (button.isConfirmed === true) {
                    window.location.href = "index.php?p=compras";
                  }
                });
              }
            });
        });
        save_ticket.addEventListener("click", (e) => {
          const element = d.getElementById("ticket");
          html2pdf()
            .set({
              margin: 1,
              filename: "prueba.pdf",
              image: {
                type: "jpeg",
                quality: 0.98,
              },
              html2canvas: {
                scale: 3,
                letterRendering: true,
              },
              jsPDF: {
                unit: "in",
                format: "a3",
              },
            })
            .from(element)
            .save()
            .catch((err) => console);
        });
      });
    // console.log(config);
  });
  // https://github.com/eKoopmans/html2pdf.js/blob/master/README.md
};

const nota_venta = () => {
  let table_body = d.getElementById("table-body-ventas");
  let total_pagar = d.getElementById("total-pagar");
  let vender = d.getElementById("vender");
  vender.addEventListener("click", (e) => {
    e.preventDefault();
    const aVender = [];
    const nameVendedor = d.getElementById("nameVendedor").innerText;
    const idVendedor = d.getElementById("id_user").innerText;
    const nCaja = d.getElementById("nCaja").innerText;
    // const tCaja = d.getElementById("tCaja");
    const nTransaccion = d.getElementById("nTransaccion").innerText;
    const fVenta = d.getElementById("fVenta").innerText;
    // const vendedor = {
    //   nameVendedor,
    //   nCaja,
    //   tCaja,
    //   fVenta
    // };
    for (var i = 0, row; (row = table_body.rows[i]); i++) {
      const obj = {
        codigo: row.cells[0].innerText,
        producto: row.cells[1].innerText,
        precio: row.cells[2].innerText,
        proveedor: row.cells[3].innerText,
        stock: row.cells[4].innerText,
      };
      aVender.push(obj);
    }
    console.log(aVender);
    const info_venta = d.querySelector(".info_venta");
    const section_modal = d.createElement("section");

    let html = `
        <div class="modal fade bd-example-modal-lg" id="mymodal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Confirmación de venta</h5>
                    <span data-dismiss="modal" aria-label="Close" class="close"><i class="fa-solid fa-xmark"></i></span>
                </div>
                <div class="modal-body" id="ticket">
                    <div class="ticket-generado">
                        <h3 class="text-center">Mi punto de venta<h3>
                        <p class="text-center">Ticket No. ${nTransaccion}</p>
                        <p class="text-center">Caja ${nCaja}</p>
                        <p class="text-center">Vendedor: ${nameVendedor}</p>
                        <p class="text-center">${fVenta}</p>
                        <p>=========================</p>

                        <table table bgcolor= "#FFFFFF"  class="table table-bordered mitabla">
                            <thead>
                            <tr>
                                <th scope="col">Cant.</th>
                                <th scope="col">Nom.</th>
                                <th scope="col">Precio</th>
                            </tr>
                            </thead>
                            <tbody id="table-ticket">
                                
                            </tbody>
                        </table>
                        <p>Total Neto: $<span id="total_neto"></span></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn-close-modal" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn-save-modal" id="venderProductos">Vender</button>
                        <button type="button" class="btn-save-modal" id="save_ticket">Descargar</button>
                    </div>
                </div>
            </div>
        </div>
        </div>`;
    info_venta.insertAdjacentElement("afterend", section_modal);
    section_modal.innerHTML += html;

    let table_ticket = d.getElementById("table-ticket");
    let regex = /(\d+)/g;
    let total = 0;
    const venta = [];

    for (let i = 0; i < aVender.length; i++) {
      venta.push(aVender[i].codigo);
    }
    console.log(venta);
    let unicosElementos = [];
    let almacenadorRepetidos = [];
    let contador = 1;
    for (let j = 0; j < venta.length; j++) {
      if (venta[j] === venta[j + 1]) {
        contador++;
      } else {
        unicosElementos.push(venta[j]);
        almacenadorRepetidos.push(contador);
        contador = 1;
      }
    }
    console.log(unicosElementos);
    console.log(almacenadorRepetidos);
    const procesarVenta = [];
    const formBusc = new FormData();
    formBusc.append("action", "buscar");
    for (let k = 0; k < unicosElementos.length; k++) {
      formBusc.append("codProducto", unicosElementos[k]);
      fetch("logic/ventas.php", {
        method: "POST",
        body: formBusc,
      })
        .then((res) => res.text())
        .then((data) => {
          data = JSON.parse(data);
          table_ticket.innerHTML += `
                    <th>${almacenadorRepetidos[k]}</th>
                    <th>${data.producto}</th>
                    <th>${data.pventa * almacenadorRepetidos[k]}</th>
                `;
        });
    }
    let getSubTotal = total_pagar.innerText.match(regex);
    total += parseFloat(getSubTotal);
    const total_neto = d.getElementById("total_neto");
    total_neto.innerHTML = total;
    $("#mymodal").modal("show");
    const save_ticket = d.getElementById("save_ticket");

    const venderProductos = d.getElementById("venderProductos");
    venderProductos.addEventListener("click", (e) => {
      let form = new FormData();
      form.append("usuario", idVendedor);
      form.append("action", "vender");
      for (let k = 0; k < unicosElementos.length; k++) {
        form.append("producto", unicosElementos[k]);
        form.append("cantidad", almacenadorRepetidos[k]);
        fetch("logic/ventas.php", {
          method: "POST",
          body: form,
        })
          .then((res) => res.text())
          .then((data) => {
            console.log(data);
            if (data.includes("ventaRealizada")) {
              // let comprar = localStorage.getItem("comprar");
              // if (comprar === "true") {
              Swal.fire({
                title: "Compra realizada",
                text: "Los cambios han sido reflejados en la base de datos",
                icon: "success", //error,
                showConfirmButton: true,
                confirmButtonText: "Aceptar",
                confirmButtonColor: "#47874a",
              }).then((button) => {
                if (button.isConfirmed === true) {
                  window.location.href = "index.php?p=ventas";
                }
              });
            }
          });
      }
    });
    save_ticket.addEventListener("click", (e) => {
      const element = d.getElementById("ticket");
      html2pdf()
        .set({
          margin: 1,
          filename: "prueba.pdf",
          image: {
            type: "jpeg",
            quality: 0.98,
          },
          html2canvas: {
            scale: 3,
            letterRendering: true,
          },
          jsPDF: {
            unit: "in",
            format: "a3",
          },
        })
        .from(element)
        .save()
        .catch((err) => console);
    });
  });
  // https://github.com/eKoopmans/html2pdf.js/blob/master/README.md
};

export { nota_compra, nota_venta };
