let modefor = false;
const usuarioLogado = JSON.parse(localStorage.getItem("usuarioLogado"));
const path = window.location.pathname;
const isCatalogo = path.includes("catalogo");
const IsCadastro = path.includes("cadastro")
const isCadastroOuLogin = path.includes("cadastro") || path.includes("login");
if (!isCadastroOuLogin) {
    window.addEventListener("DOMContentLoaded", logadoupdate);
    document.getElementById("logout").addEventListener("click", logout);
}
else {
    document.getElementById("darkModeToggle").addEventListener("click", modechangefor)
}

function modechangefor() {
    console.log("teste")
    if (!modefor) {
        document.body.style.backgroundImage = "url(../foto/formulario/paginainicial01_dark.png)";
        modefor = true;
        localStorage.setItem("modo", "dark");
        document.getElementsByClassName("icone-sol")[0].style.display = "none";
        document.getElementsByClassName("icone-lua")[0].style.display = "flex";
        document.getElementsByClassName("voltarbtn")[0].src = "../foto/formulario/setabranca.png"
    }
    else {
        document.body.style.backgroundImage = "url(../foto/formulario/paginainicial01.png)";
        modefor = false;
        localStorage.setItem("modo", "light");
        document.getElementsByClassName("icone-sol")[0].style.display = "flex";
        document.getElementsByClassName("icone-lua")[0].style.display = "none";
        document.getElementsByClassName("voltarbtn")[0].src = "../foto/formulario/seta.png"
    }
}

window.onload = function() {
    const modeSalvo = localStorage.getItem("modo");
    if (modeSalvo === "dark") {
        document.body.style.backgroundImage = "url(../foto/formulario/paginainicial01_dark.png)";
        modefor = true;
        document.getElementById("darkModeToggle").checked = true;
        document.getElementsByClassName("icone-sol")[0].style.display = "none";
        document.getElementsByClassName("icone-lua")[0].style.display = "flex";
        document.getElementsByClassName("voltarbtn")[0].src = "../foto/formulario/setabranca.png"
    } else {
        document.body.style.backgroundImage = "url(../foto/formulario/paginainicial01.png)";
        modefor = false;
        document.getElementById("darkModeToggle").checked = false;
        document.getElementsByClassName("icone-sol")[0].style.display = "flex";
        document.getElementsByClassName("icone-lua")[0].style.display = "none";
        document.getElementsByClassName("voltarbtn")[0].src = "../foto/formulario/seta.png"
    }
}



function logadoupdate() {
    if (!usuarioLogado) {
        document.getElementsByClassName("usuario")[0].style.display = "none";
        document.getElementsByClassName("visitante")[0].style.display = "flex";
        document.getElementById("logout").style.display = "none";
        document.getElementById("log").style.display = "flex";
        document.getElementById("cad").style.display = "flex";
        if (isCatalogo) {
            document.getElementById("btn-carrinho-central") = "flex";
        }


    }
    else {
        document.getElementsByClassName("usuario")[0].style.display = "flex";
        document.getElementsByClassName("visitante")[0].style.display = "none";
        document.getElementById("logout").style.display = "flex";
        document.getElementById("log").style.display = "none";
        document.getElementById("cad").style.display = "none";
        if (isCatalogo) {
             document.getElementById("btn-carrinho-central") = "flex";
        }
    }
}

if (IsCadastro) {
    $('#cep').blur(function () {
    var vl = this.value;

    $.get('https://viacep.com.br/ws/'+vl+'/json/', function (dados) {
        $('#rua').val(dados.logradouro);
        $('#bairro').val(dados.bairro);
        $('#cidade').val(dados.localidade);
        $('#estado').val(dados.uf);
    });
});
}


const formCadastro = document.getElementById("cadastro");
if (formCadastro) {
    document.getElementById("cadastro").addEventListener("submit", function(event) {
    event.preventDefault();
    let email = document.getElementById("email").value;
    let nome = document.getElementById("nome").value;
    let senha = document.getElementById("senha").value;
    let confirmar = document.getElementById("confirmar").value;
    let cpf = document.getElementById("cpf").value;
    let bairro = document.getElementById("bairro").value;
    let cep = document.getElementById("cep").value;
    let cidade = document.getElementById("cidade").value;
    let rua = document.getElementById("rua").value;
    let telefone = document.getElementById("telefone").value;


    if (senha !==confirmar) {
        alert("Confirme sua Senha antes de continuar")
        return
    }



    if (email&&nome&&senha&&confirmar&&cpf&&bairro&&cep&&telefone) {
        let usuarios = JSON.parse(localStorage.getItem("usuarios")) || [];
        let existe = usuarios.some(u => u.email === email || u.nome === nome);
        if (existe) {
            alert("E-mail ou nome já cadastrado!");
            return;
        }
        usuarios.push({email, nome, senha, cpf, cep, bairro, cidade, rua, telefone });
        localStorage.setItem("usuarios", JSON.stringify(usuarios));

        alert("cadastro realizado com sucesso!");
        event.target.reset();
    }
    else {
        alert("Por favor, preencha todos os dados")
    }
    console.log(JSON.parse(localStorage.getItem("usuarios")));
})
}


function logout() {
    localStorage.removeItem("usuarioLogado");
    window.location.reload();
}


const formLogin = document.getElementById("login");
if (formLogin) {
    document.getElementById("login").addEventListener("submit", function(event) {
    event.preventDefault();

    let email = document.getElementById("email").value;
    let senha = document.getElementById("senha").value;

    let usuarios = JSON.parse(localStorage.getItem("usuarios")) || [];
    let usuario = usuarios.find(u => u.email === email && u.senha === senha);
    if (usuario) {
        // Login bem-sucedido
        localStorage.setItem("usuarioLogado", JSON.stringify(usuario));
        alert("Login realizado com sucesso!");
        localStorage.setItem("usuarioLogado", JSON.stringify(usuario));
        // Redirecione ou atualize a interface conforme necessário
        // window.location.href = "pagina_inicial.html";
        window.location.href = "../index.html";
    } 
    else {
        alert("E-mail ou senha incorretos.");
    }
});
}