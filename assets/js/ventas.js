const d = document;

let code_product = d.getElementById("code-product-1");
var table_ventas = d.getElementById("table-body-ventas");
code_product.addEventListener("keyup", (e) => {
  if (e.which === 13) {
    if (code_product.value === "") {
      alert("El código de producto no es correcto");
    } else {
      // console.log(code_product.value);
      // alert("Haz presionado, el valor es: " + code_product.value);
      let regex = /(\d+)/g;
      let getId = code_product.id.match(regex);

      let producto = {
        idProd: 123368,
        nombre: "Arroz",
        categoria: "Alimento",
        precioU: 850.0,
        stock: 20,
      };
      let next = `
      <tr id = "product-${getId + 1}">
        <th scope="row"><input type="text" placeholder="Introduce..." id="code-product-${
          getId + 1
        }"></th>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
      `;
      let currentProduct = d.getElementById(`product-${getId}`);
      currentProduct.innerHTML = `
        <th scope="row"><input type="text" placeholder="Introduce..." value="${producto.idProd}" id="code-product-1"></th>
        <td>${producto.nombre}</td>
        <td>${producto.categoria}</td>
        <td>${producto.precioU}</td>
        <td>${producto.stock}</td>
      `;

      table_ventas.innerHTML += next;
    }
  }
});
