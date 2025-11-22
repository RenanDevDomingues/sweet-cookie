addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.quantidade button').forEach(btn => {
        btn.addEventListener('click', setquantidade)
    })
    document.querySelectorAll('.remover').forEach(btn => {
        btn.addEventListener('click', removeproduto)
    })
})

function setquantidade(event) {
    const produto = event.target.parentElement;
    console.log(produto)
    const btn = event.target.className;
    console.log(btn)
    const span = produto.querySelector('span');
    console.log(span)
    let valor = Number(span.innerText);
    console.log(span)

    if (btn === 'aumentar') {
        valor++;
        span.innerText = valor;

    } else if (btn === 'diminuir') {
        if (valor === 1) {
            // remove o item inteiro
            produto.parentElement.parentElement.remove();
            return;
        }

        valor--;
        span.innerText = valor;
    }
}

function removeproduto() {
    const produto = event.target.parentElement.parentElement
    produto.remove()
}