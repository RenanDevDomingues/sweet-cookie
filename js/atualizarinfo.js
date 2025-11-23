addEventListener('DOMContentLoaded', () => {
    const atualizarbtn = document.querySelectorAll('.alterar')
    atualizarbtn.forEach(btn => {
        btn.addEventListener('click', atualizar)
    })
})

let telefone = false;
let email = false;
let cep = false;
function atualizar(event) {
    const area = event.target.parentElement.querySelector('.atualizar')
    const alvo = event.target.id
    console.log(alvo)
    if (alvo === 'telefone') {
        if (telefone) {
            area.innerHTML = "Numero"
            telefone = !telefone
        } else {
            area.innerHTML = `
        <form>
        <input type='text' name='telefone'>
        <button type='submit'>→</button>
        </form>
        `;
            telefone = !telefone
        }
    } else if (alvo === 'email') {
        if (email) {
            area.innerHTML = 'Email'
            email = !email
        } else {
            area.innerHTML = `
        <form>
        <input type='email' name='email'>
        <button type='submit'>→</button>
        </form>
        `;
            email = !email
        }

    } else if (alvo === 'cep') {
        if (cep) {
            area.innerHTML = '11111-111'
            cep = !cep
        } else {
            area.innerHTML = `
        <form>
        <input type='text' name='cep'>
        <button type='submit'>→</button>
        </form>
        `;
            cep = !cep
        }
    }
}