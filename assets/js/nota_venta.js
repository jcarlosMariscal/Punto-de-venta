const d = document;
const nota_venta = () => {
    let table_body = d.getElementById("table-body");
    let comprar = d.getElementById("comprar");
    comprar.addEventListener("click", (e) => {
        e.preventDefault();
        const aComprar = [];

        for (var i = 0, row; row = table_body.rows[i]; i++) {
            const obj = {
                producto: row.cells[0].innerText,
                cantidad: row.cells[1].innerText,
                p_compra: row.cells[2].innerText,
                subtotal: row.cells[3].innerText,
            }
            aComprar.push(obj)
        }
        const info_compra = d.querySelector(".info-compra");
        const section_modal = d.createElement("section");
        
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
                        <h3 class="text-center">Mi punto de venta<h3>
                        <p class="text-center">Fecha: 30-06-2022</p>
                        <p class="text-center">Ticket No. 85566</p>
                        <p class="text-center">Av. Lopez Mateos #587 Playa ensenada</p>
                        <p class="text-center">Vendedor: Pedro</p>

                        <table table bgcolor= "#FFFFFF"  class="table table-bordered">
                            <thead>
                            <tr>
                                <th scope="col">Can.</th>
                                <th scope="col">Prod.</th>
                                <th scope="col">P. compra</th>
                                <th scope="col">Subtotal</th>
                            </tr>
                            </thead>
                            <tbody id="table-body">
                                <th>${aComprar[0].cantidad}</th>
                                <th>${aComprar[0].producto}</th>
                                <th>${aComprar[0].p_compra}</th>
                                <th>${aComprar[0].subtotal}</th>
                            </tbody>
                        </table>
                        <p>Total Neto: $582</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn-close-modal" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn-save-modal">Comprar y imprimir ticket</button>
                        <button type="button" class="btn-save-modal" id="save_ticket">Guardar ticket</button>
                    </div>
                </div>
            </div>
        </div>
        </div>`;
        info_compra.insertAdjacentElement('afterend', section_modal)
        section_modal.innerHTML += html;
        $('#mymodal').modal('show')
        const save_ticket = d.getElementById("save_ticket");
        save_ticket.addEventListener("click", (e) => {
            const element = d.getElementById("ticket");
            html2pdf().set({
                margin: 1,
                filename: 'prueba.pdf',
                image: {
                    type: 'jpeg',
                    quality: 0.98
                },
                html2canvas: {
                    scale: 3,
                    letterRendering: true,
                },
                jsPDF: {
                    unit: 'in',
                    format: 'a3',
                }
            }).from(element).save().catch(err => console)
        })
    })
    // https://github.com/eKoopmans/html2pdf.js/blob/master/README.md
}

export {
    nota_venta
}