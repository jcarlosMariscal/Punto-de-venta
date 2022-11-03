const d = document;
const nota_compra = () => {
  let table_body = d.getElementById("table-body");
  let comprar = d.getElementById("comprar");
  let id_sucursal = d.getElementById("id_sucursal");
  comprar.addEventListener("click", (e) => {
    console.log("comprar");
    e.preventDefault();
    const aComprar = [];

    for (var i = 0, row; (row = table_body.rows[i]); i++) {
      console.log(table_body.rows[i]);
      const obj = {
        nombre: row.cells[0].innerText,
        codigo: row.cells[1].innerText,
        cantidad: row.cells[2].innerText,
        pcompra: row.cells[3].innerText,
        subtotal: row.cells[4].innerText,
        proveedor: row.cells[5].innerText,
        pventa: row.cells[6].innerText,
        unidad: row.cells[7].innerText,
        id_sucursal: row.cells[8].innerText,
        categoria: row.cells[9].innerText,
      };
      aComprar.push(obj);
    }
    console.log(aComprar);

    const compraModales = d.querySelector(".modales");
    const section_modal = d.createElement("section");
    let myForm = new FormData();
    myForm.append("table", "getNegocio");
    myForm.append("id_sucursal", id_sucursal.innerText);
    let config;
    fetch("logic/createData.php", {
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
        <div class="modal fade" id="confirmarCompra" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Confirmación de compra</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="ticket">
                    <div class="ticket-generado">
                        <img src="../assets/img/icono1.png" class="ticket-logo">
                        <h3 class="text-center">${get.nombre}<h3>
                        <p class="text-center">Fecha: 30-06-2022</p>
                        <p class="text-center">Compra No. 85</p>
                        <p class="text-center">${get.estado}, ${get.ciudad}, ${get.colonia}, ${get.direccion}, ${get.codigo_postal}</p>
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
                        <button type="button" class="btn-close-modal" data-bs-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn-save-modal" id="comprarProductos">Comprar</button>
                        <button type="button" class="btn-save-modal" id="save_ticket">Descargar</button>
                    </div>
                </div>
            </div>
        </div>
        </div>`;
        compraModales.insertAdjacentElement("afterend", section_modal);
        section_modal.innerHTML += html;

        let table_ticket = d.getElementById("table-ticket");
        let regex = /(\d+)/g;
        let total = 0;
        for (let i = 0; i < aComprar.length; i++) {
          console.log(aComprar[i].cantidad);
          table_ticket.innerHTML += `
                    <th>${aComprar[i].cantidad}</th>
                    <th>${aComprar[i].nombre}</th>
                    <th>${aComprar[i].pcompra}</th>
                    <th>${aComprar[i].subtotal}</th>
                `;
          let getSubTotal = aComprar[i].subtotal.match(regex);
          total += parseFloat(getSubTotal);
        }

        const total_neto = d.getElementById("total_neto");
        total_neto.innerHTML = total;
        // $("#confirmarCompra").modal("show");
        var confirmarCompra = new bootstrap.Modal(
          document.getElementById("confirmarCompra"),
          {
            keyboard: false,
          }
        );
        confirmarCompra.show();
        const save_ticket = d.getElementById("save_ticket");
        const comprarProductos = d.getElementById("comprarProductos");
        comprarProductos.addEventListener("click", (e) => {
          localStorage.getItem("prodNuevo");
          // console.log(aComprar);
          let form = new FormData();
          console.log(aComprar);
          let data = JSON.stringify(aComprar);
          // console.log(data);
          form.append("table", "realizarCompra");
          form.append("data", data);
          form.append("totalCompra", total_neto.innerText);
          // form.append("nuevoCodigo", total_neto.innerText);
          // form.append("nuevoNombre", total_neto.innerText);
          // console.log(form.get("data"));
          fetch("logic/createData.php", {
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
  let vender = d.getElementById("vender");
  let table_body = d.getElementById("table-body-ventas");
  vender.addEventListener("click", (e) => {
    e.preventDefault();
    let total_pagar = d.getElementById("total-pagar");
    let efectivo_cliente = d.getElementById("efectivo_cliente");
    let cambio_cliente = d.getElementById("cambio_cliente");
    const aVender = [];
    const nameVendedor = d.getElementById("nameVendedor").innerText;
    const id_user = d.getElementById("id_user");
    const id_caja = d.getElementById("id_caja");
    let id_sucursal = d.getElementById("id_sucursal");
    let total_caja = d.getElementById("total_caja");
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
        nombre: row.cells[1].innerText,
        pVenta: row.cells[2].innerText,
        unidad: row.cells[3].innerText,
        categoria: row.cells[4].innerText,
        cantidad: row.cells[5].innerText,
        cantidadVenta: row.cells[6].innerText,
        subtotal: row.cells[7].innerText,
      };
      aVender.push(obj);
    }
    // console.log(aVender);
    const ventaModales = d.querySelector(".modales");
    const section_modal = d.createElement("section");

    let html = `
        <div class="modal fade bd-example-modal-lg" id="confirmarVenta" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Confirmación de venta</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="ticket">
                    <div class="ticket-generado">
                        <h3 class="text-center">Mi punto de venta<h3>
                        <p class="text-center">Ticket No. ${nTransaccion}</p>
                        <p class="text-center">Caja ${id_caja}</p>
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
                        <button type="button" class="btn-close-modal" data-bs-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn-save-modal" id="venderProductos">Vender</button>
                        <button type="button" class="btn-save-modal" id="save_ticket">Descargar</button>
                    </div>
                </div>
            </div>
        </div>
        </div>`;
    ventaModales.insertAdjacentElement("afterend", section_modal);
    section_modal.innerHTML += html;

    let table_ticket = d.getElementById("table-ticket");
    let regex = /(\d+)/g;
    let total = 0;
    for (let i = 0; i < aVender.length; i++) {
      // console.log(aComprar[i].cantidad);
      table_ticket.innerHTML += `
                    <th>${aVender[i].cantidadVenta}</th>
                    <th>${aVender[i].nombre}</th>
                    <th>${aVender[i].pVenta}</th>
                `;
      // let getSubTotal = aComprar[i].subtotal.match(regex);
      // total += parseFloat(getSubTotal);
    }
    const total_neto = d.getElementById("total_neto");
    // total_neto.innerHTML = total;
    // $("#mymodal").modal("show");
    var confirmarVenta = new bootstrap.Modal(
      document.getElementById("confirmarVenta"),
      {
        keyboard: false,
      }
    );
    confirmarVenta.show();
    const save_ticket = d.getElementById("save_ticket");

    const venderProductos = d.getElementById("venderProductos");
    venderProductos.addEventListener("click", (e) => {
      // console.log("click");
      // console.log("Total a pagar: " + total_pagar.innerText);
      let form = new FormData();
      form.append("id_personal", id_user.innerText);
      form.append("id_cliente", 1);
      form.append("id_sucursal", id_sucursal.innerText);
      form.append("id_caja", id_caja.innerText);
      form.append("total_caja", total_caja.innerText);
      form.append("total", total_pagar.innerText.match(regex));
      form.append("efectivo", efectivo_cliente.value);
      form.append("cambio", cambio_cliente.innerText.match(regex));
      let data = JSON.stringify(aVender);
      form.append("data", data);
      form.append("table", "realizarVenta");
      fetch("logic/createData.php", {
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
              title: "Venta realizada",
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
