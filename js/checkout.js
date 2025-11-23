addEventListener('DOMContentLoaded', ()=> {
    document.querySelectorAll('.forma div').forEach(btn => {
        btn.addEventListener('click', openinfo)
    })
})

// Variável de controle (state)
let open = false;

// Função principal
function openinfo(event) {
    const forma = event.currentTarget.id;
    const escuro = document.querySelector('.escuro');
    const info = document.querySelector('.infopagamento');

    info.style.display = open ? 'none' : 'flex';
    if (escuro) escuro.style.display = open ? 'none' : 'flex';
    open = !open;

    if (!forma) {
        info.innerText = 'Forma desconhecida';
        return;
    }
    if (forma === 'pix') {
        info.innerText = 'Pix';
    } else if (forma === 'credito') {
        info.innerText = 'Crédito';
    } else if (forma === 'debito') {
        info.innerText = 'Débito';
    } else {
        info.innerText = 'Opção: ' + forma;
    }
}