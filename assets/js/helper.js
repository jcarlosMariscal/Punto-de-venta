const calcularTotal = () => {
    let todo = d.querySelectorAll(".precio");
    let total = [];
    todo.forEach(el => {
        total.push(parseInt(el.innerText));
    });
    let suma_total = 0;
    for (let i = 0; i < total.length; i++) {
        suma_total += total[i];
    }
    total_pagar.innerHTML = suma_total;
}

export {
    calcularTotal
}