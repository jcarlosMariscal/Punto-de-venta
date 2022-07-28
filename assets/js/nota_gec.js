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
        let get = JSON.parse(data);
        console.log(get);
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
          console.log(aComprar);

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
              if (data == "compraCorrecta") {
                console.log(data);
                let comprar = localStorage.getItem("comprar");
                if (comprar === "true") {
                  Swal.fire({
                    title: "Productos agregados",
                    text: "Los productos se han agregado correctamente.",
                    icon: "success", //error,
                    timer: 3000,
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    confirmButtonColor: "#47874a",
                  });
                  window.location.href = "index.php?p=compras";
                }
                setTimeout(function () {
                  localStorage.removeItem("comprar");
                }, 1500);
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
  let vender = d.getElementById("vender");
  vender.addEventListener("click", (e) => {
    e.preventDefault();
    const aVender = [];

    for (var i = 0, row; (row = table_body.rows[i]); i++) {
      const obj = {
        id_producto: row.cells[0].innerText,
        nombre: row.cells[1].innerText,
        categoria: row.cells[2].innerText,
        precio: row.cells[3].innerText,
        stock: row.cells[4].innerText,
      };
      aVender.push(obj);
    }
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
                        <img src="../assets/img/favicon.png" class="ticket-logo">
                        <p class="text-center">Ticket No. 85566</p>
                        <p class="text-center">Av. Lopez Mateos #587 Playa ensenada</p>
                        <p class="text-center">Vendedor: Pedro</p>
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
                        <button type="button" class="btn-save-modal" id="save_ticket">Vender</button>
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
    for (let i = 0; i < aVender.length; i++) {
      table_ticket.innerHTML += `
                    <th>${aVender[i].id_producto}</th>
                    <th>${aVender[i].nombre}</th>
                    <th>${aVender[i].precio}</th>
                `;
      let getSubTotal = aVender[i].precio.match(regex);
      total += parseFloat(getSubTotal);
    }

    const total_neto = d.getElementById("total_neto");
    total_neto.innerHTML = total;
    $("#mymodal").modal("show");
    const save_ticket = d.getElementById("save_ticket");
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
