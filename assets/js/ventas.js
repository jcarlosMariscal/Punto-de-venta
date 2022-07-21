const d = document;

const evento = () => {
  var table_ventas = d.getElementById("table-body-ventas");
  let rows = table_ventas.getElementsByTagName("tr");

  // console.log(table_ventas);
  let code_product = d.getElementById(`code-product-${rows.length}`);
  console.log(code_product);

  code_product.addEventListener("keyup", (e) => {
    console.log(code_product);
    if (e.which === 13) {
      if (code_product.value === "") {
        alert("El código de producto no es correcto");
      } else {
        let regex = /(\d+)/g;
        // let getId = code_product.id.match(regex);

        let producto = {
          idProd: 123368,
          nombre: "Arroz",
          categoria: "Alimento",
          precioU: 850.0,
          stock: 20,
        };
        let next = `
      <tr id = "product-${rows.length + 1}">
        <th scope="row"><input type="text" placeholder="Introduce..." id="code-product-${
          rows.length + 1
        }"></th>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
      `;
        let currentProduct = d.getElementById(`product-${rows.length}`);
        currentProduct.innerHTML = `
        <th scope="row"><input type="text" placeholder="Introduce..." value="${producto.idProd}" id="code-product-${rows.length}"></th>
        <td>${producto.nombre}</td>
        <td>${producto.categoria}</td>
        <td>${producto.precioU}</td>
        <td>${producto.stock}</td>
      `;

        table_ventas.innerHTML += next;
        // rows = table_ventas.getElementsByTagName("tr");
        // console.log(rows);
        // console.log(rows.length);
      }
    }
  });
};
evento();
