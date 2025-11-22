<?php 
    session_start();
    $usuario = null;

    if(!empty($_SESSION['logado'])){
        $usuario = $_SESSION['usuario'];
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sweet Cookies</title>
    <link rel="stylesheet" href="../css/carrinho.css">
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,600,700,800&display=swap" rel="stylesheet">
</head>
<body>
    <?php 
        include("../config/header.php"); 
    ?>
    <div class="nav-menu">
        <div class="menu">
            <div class="option" id="close-menu">
                <img src="../img/navbar-hero.svg" alt="Menu">
                <h2>Menu</h2>
            </div>
            <div class="option">
                <img src="../img/casa.svg" alt="home">
                <a href="../index.php">
                    <h2>Inicio</h2>
                </a>
            </div>
            <div class="option">
                <img src="../img/cookie.svg" alt="Cardapio">
                <a href="cardapio.php">
                <h2>Cardapio</h2>
            </a>
            </div>
            <div class="option">
                <img src="../img/presente.svg" alt="Kits e Presentes">
                <a href="merchan.php">
                <h2>Kits e Presentes</h2>
            </a>
            </div>
            <div class="option">
            </div>
            <div class="promododia">
                <img src="../img/navbar-hero.svg" alt="Promoção do Dia">
                <a href="./paginas/index.php">
                <h2>Promoção do Dia</h2>
            </a>
            </div>
        </div>
    </div>
    <div class="sombra"></div>
    <main>
        <div class="carrinho">
            <table>
                <tr>
                    <th>Produto</th>
                    <th>Nome</th>
                    <th>Preço</th>
                    <th>Quantidade</th>
                    <th>Remover</th>
                </tr>
                <tr>
                    <td>IMG</td>
                    <td>Nome</td>
                    <td>Preço</td>
                    <td>
                        <div class="quantidade">
                            <button class="diminuir"><-</button>
                            <span>1</span>
                            <button class="aumentar">-></button>
                        </div>
                    </td>
                    <td><button class="remover">X</button></td>
                </tr>
                <tr>
                    <td>IMG</td>
                    <td>Nome</td>
                    <td>Preço</td>
                    <td>
                        <div class="quantidade">
                            <button><-</button>
                            <span>1</span>
                            <button>-></button>
                        </div>
                    </td>
                    <td><button class="remover">X</button></td>
                </tr>
            </table>
        </div>
        <div class="check">
            <h1>Check</h1>
            <div class="valor">
                <div class="original">
                    <p>Sub-Total: </p>
                    <span>0,00 R$</span>
                </div>
                <div class="desconto">
                    <div class="des_total">
                        <p>Desconto: </p>
                        <span>0,00 R$</span>
                    </div>
                    <div class="lista">
                        <p>Sem Descontos</p><br>
                        <p>Sem Descontos</p><br>
                        <p>Sem Descontos</p><br>
                        <p>Sem Descontos</p><br>
                        <p>Sem Descontos</p><br>
                        <p>Sem Descontos</p><br>
                        <p>Sem Descontos</p><br>
                        <p>Sem Descontos</p><br>
                        <p>Sem Descontos</p><br>
                    </div>
                </div>
            </div>
            <div class="total">
                <p>Total: </p>
                <span>0,00 R$</span>
                <button>CHECKOUT</button>
            </div>
        </div>
    </main>
    <footer>
            <div class="footer-content">
                <div class="footer-brand">
                    <img src="img/Sweet.svg" alt="Sweet Cookies">
                    <div class="footer-social">
                        <a href="https://www.instagram.com/sweetcookies_ofc" target="_blank"><img src="../img/Instagram.png" alt="Instagram"></a>
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
    <script src="../js/carrinho.js"></script>
    <script src="../js/darkmode.js"></script>
    <script src="../js/navbar.js"></script>
</body>
</html>