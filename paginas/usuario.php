<?php
session_start();
$usuario = null;

if (!empty($_SESSION['logado'])) {
    $usuario = $_SESSION['usuario'];
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sweet Cookies</title>
    <link rel="stylesheet" href="../css/usuario.css">
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,600,700,800&display=swap" rel="stylesheet">
</head>

<body>
    <?php
    $path = "../";
    include("../config/header.php");
    ?>


    <main>
        <div class="usuario">
            <div class="perfil">
                <div class="foto"></div>
                <div class="nome">
                    <h1>Nome</h1>
                    <h3>USUARIO JOHN</h3>
                </div>
            </div>
            <div class="perfil-info">
                <div class="info">
                    <h2>Telefone</h2>
                    <div class="atualizar">
                        <p>Numero</p>
                    </div>
                    <p class="alterar" id="telefone">Alterar Telefone</p>
                </div>
                <div class="info">
                    <h2>Email</h2>
                    <div class="atualizar">
                        <p>Email@gmail.com</p>
                    </div>
                    <p class="alterar" id="email">Alterar Email</p>
                </div>
                <div class="info">
                    <h2>CEP</h2>
                    <div class="atualizar">
                        <p>11111-111</p>
                    </div>
                    <p class="alterar" id="cep">Alterar CEP</p>
                </div>
            </div>
        </div>
        <div class="historico">
            <div class="title">
                <h1>HISTORICO</h1>
            </div>
            <div class="lista">
                <div class="compra">
                    <img src='../img/choco-belga.png'>
                    <h3>Nome</h3>
                    <h4> R$ 0,00</h4>
                </div>
                <div class="compra">
                    <img src='../img/choco-belga.png'>
                    <h3>Nome</h3>
                    <h4> R$ 0,00</h4>
                </div>
                <div class="compra">
                    <img src='../img/choco-belga.png'>
                    <h3>Nome</h3>
                    <h4> R$ 0,00</h4>
                </div>
                <div class="compra">
                    <img src='../img/choco-belga.png'>
                    <h3>Nome</h3>
                    <h4> R$ 0,00</h4>
                </div>
                <div class="compra">
                    <img src='../img/choco-belga.png'>
                    <h3>Nome</h3>
                    <h4> R$ 0,00</h4>
                </div>
                <div class="compra">
                    <img src='../img/choco-belga.png'>
                    <h3>Nome</h3>
                    <h4> R$ 0,00</h4>
                </div>
                <div class="compra">
                    <img src='../img/choco-belga.png'>
                    <h3>Nome</h3>
                    <h4> R$ 0,00</h4>
                </div>
                <div class="compra">
                    <img src='../img/choco-belga.png'>
                    <h3>Nome</h3>
                    <h4> R$ 0,00</h4>
                </div>
            </div>
        </div>
    </main>


    <footer>
        <div class="footer-content">
            <div class="footer-brand">
                <img src="../img/Sweet.svg" alt="Sweet Cookies">
                <div class="footer-social">
                    <a href="https://www.instagram.com/sweetcookies_ofc" target="_blank"><img src="../img/Instagram.png"
                            alt="Instagram"></a>
                    <a href="#"><img src="../img/WhatsApp.png" alt="WhatsApp" target="_blank"></a>
                </div>
                <div class="footer-info">
                    2025 Sweet cookies. Todos os direitos reservados.
                </div>
            </div>
            <div class="footer-links">
                <strong>Informações Legais</strong>
                <a href="#">Política de privacidade</a>
                <a href="#">Termos de uso</a>
                <a href="#">Segurança de dados</a>
            </div>
        </div>
    </footer>
    <script src="../js/atualizarinfo.js"></script>
</body>

</html>