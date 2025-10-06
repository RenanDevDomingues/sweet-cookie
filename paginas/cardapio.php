<?php 
    session_start();
    $usuario = null;

    if(!empty($_SESSION['logado'])){
        $usuario = $_SESSION['usuario'];
    } else {
        header("Location: login.php");
    }
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cardápio | Sweet Cookies</title>
    <link rel="stylesheet" href="../css/cardapio.css">
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,600,700,800&display=swap" rel="stylesheet">
</head>

<body>
    <!-- HEADER -->
    <header>
        <div class="header-content">
            <a href="../index.php">
            <img src="../img/Sweet.svg" alt="Sweet Cookies" class="logo">
            </a>
            <div class="header-search">
                <input type="text" placeholder="O que deseja buscar?">
                <button>
                    <!-- SVG Lupa -->
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                        <circle cx="9" cy="9" r="7" stroke="#C62828" stroke-width="2" />
                        <line x1="14.4142" y1="14" x2="18" y2="17.5858" stroke="#C62828" stroke-width="2"
                            stroke-linecap="round" />
                    </svg>
                </button>
            </div>
            <div class="header-actions">
                <div class="darkmode">
                    <div class="darkmode-toggle"></div>
                </div>

                <?php
                    if($usuario){
                        echo'<a href="../actions/UsuarioLogout.php" class="login"><img src="../img/usuario.svg" alt="">Deslogar</a>';
                        
                    }
                    else{
                        echo '
                            <div class="login">
                                <img src="../img/usuario.svg">
                                <div class="input-login">
                                    <a href="login.php">Faça Login</a><br>
                                    <a href="cadastro.php">ou Faça seu Cadstro</a>
                                </div>
                            </div>
                        ';
                    } 
                ?>
                <a href="#" class="cart-area">
                    <img src="../img/carrinho.svg" alt="Carrinho de Compras" class="cart-icon">
                    <span class="cart-badge">2</span>
                </a>
                <button class="menu-icon"><img src="../img/navbar-hero.svg" alt=""></button>
            </div>
        </div>
    </header>
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
                <a href="../index.php">
                <h2>Promoção do Dia</h2>
            </a>
            </div>
        </div>
    </div>
    <div class="sombra"></div>
    </section>


    <!-- CARDÁPIO -->
    <section class="cardapio-section">
        <h2>Nossos Cookies Doces Especiais</h2>
        <span class="cardapio-subtitle">Receitas irresistíveis criadas para adoçar todos os momentos</span>
        <div class="cardapio-lista">
            <!-- Card 1 -->
            <div class="cardapio-card">
                <div class="cardapio-img-area">
                    <img src="../img/choco-belga.png" alt="Chocolate Belga">
                    <span class="badge">Mais Vendido</span>
                </div>
                <h3>Chocolate Belga</h3>
                <p>Feito com chocolate belga 70% cacau e pedaços crocantes</p>
            </div>
            <!-- Card 2 -->
            <div class="cardapio-card">
                <div class="cardapio-img-area">
                    <img src="../img/choco-belga.png" alt="Chocolate Belga">
                    <span class="badge">Mais Vendido</span>
                </div>
                <h3>Chocolate Belga</h3>
                <p>Feito com chocolate belga 70% cacau e pedaços crocantes</p>
            </div>
            <!-- Card 3 -->
            <div class="cardapio-card">
                <div class="cardapio-img-area">
                    <img src="../img/choco-belga.png" alt="Chocolate Belga">
                    <span class="badge">Mais Vendido</span>
                </div>
                <h3>Chocolate Belga</h3>
                <p>Feito com chocolate belga 70% cacau e pedaços crocantes</p>
            </div>
            <!-- Card 4 -->
            <div class="cardapio-card">
                <div class="cardapio-img-area">
                    <img src="../img/choco-belga.png" alt="Chocolate Belga">
                    <span class="badge">Mais Vendido</span>
                </div>
                <h3>Chocolate Belga</h3>
                <p>Feito com chocolate belga 70% cacau e pedaços crocantes</p>
            </div>
            <!-- Card 5 -->
            <div class="cardapio-card">
                <div class="cardapio-img-area">
                    <img src="../img/choco-belga.png" alt="Chocolate Belga">
                    <span class="badge">Mais Vendido</span>
                </div>
                <h3>Chocolate Belga</h3>
                <p>Feito com chocolate belga 70% cacau e pedaços crocantes</p>
            </div>
            <!-- Card 6 -->
            <div class="cardapio-card">
                <div class="cardapio-img-area">
                    <img src="../img/choco-belga.png" alt="Chocolate Belga">
                    <span class="badge">Mais Vendido</span>
                </div>
                <h3>Chocolate Belga</h3>
                <p>Feito com chocolate belga 70% cacau e pedaços crocantes</p>
            </div>
            <!-- Card 7 -->
            <div class="cardapio-card">
                <div class="cardapio-img-area">
                    <img src="../img/choco-belga.png" alt="Chocolate Belga">
                    <span class="badge">Mais Vendido</span>
                </div>
                <h3>Chocolate Belga</h3>
                <p>Feito com chocolate belga 70% cacau e pedaços crocantes</p>
            </div>
            <!-- Card 8 -->
            <div class="cardapio-card">
                <div class="cardapio-img-area">
                    <img src="../img/choco-belga.png" alt="Chocolate Belga">
                    <span class="badge">Mais Vendido</span>
                </div>
                <h3>Chocolate Belga</h3>
                <p>Feito com chocolate belga 70% cacau e pedaços crocantes</p>
            </div>
        </div>
    </section>
    <!-- Perso o seu cookie -->
    <section class="monte-cookie-section">
        <h2>Monte seu cookie personalizado</h2>
        <div class="monte-cookie-content">
            <div class="cookie-preview">
                <h3>Seu cookie personalizado</h3>
                <p>Visualize seu cookie aqui</p>
                <img src="../img/choco-belga.png" alt="Cookie Preview">
            </div>
            <form class="cookie-form">
                <label>Escolha sua massa</label>
                <div class="opcoes">
                    <button type="button" class="opcao-btn selected">Clássica</button>
                    <button type="button" class="opcao-btn">Integral</button>
                    <button type="button" class="opcao-btn">Sem Glúten</button>
                    <button type="button" class="opcao-btn">Vegana</button>
                </div>
                <label>Escolha seu recheio</label>
                <div class="checkbox-group">
                    <label><input type="checkbox"> Chocolate</label>
                    <label><input type="checkbox"> Doce de leite</label>
                    <label><input type="checkbox"> Nutella</label>
                    <label><input type="checkbox"> Goiabada</label>
                </div>
                <label>Escolha o tamanho</label>
                <div class="opcoes">
                    <button type="button" class="opcao-btn">Pequeno</button>
                    <button type="button" class="opcao-btn selected">Médio</button>
                    <button type="button" class="opcao-btn">Grande</button>
                    <button type="button" class="opcao-btn">Gigante</button>
                </div>
                <button class="btn-main" type="submit">Escolha sua massa</button>
            </form>
        </div>
    </section>
    <!-- CARDÁPIO2 -->
    <section class="cardapio-section">
        <h2>Nossos Cookies Salgados Especiais</h2>
        <span class="cardapio-subtitle">Receitas irresistíveis criadas para adoçar todos os momentos</span>
        <div class="cardapio-lista">
            <!-- Card 9 -->
            <div class="cardapio-card">
                <div class="cardapio-img-area">
                    <img src="../img/choco-belga.png" alt="Chocolate Belga">
                    <span class="badge">Mais Vendido</span>
                </div>
                <h3>Chocolate Belga</h3>
                <p>Feito com chocolate belga 70% cacau e pedaços crocantes</p>
            </div>
            <!-- Card 10 -->
            <div class="cardapio-card">
                <div class="cardapio-img-area">
                    <img src="../img/choco-belga.png" alt="Chocolate Belga">
                    <span class="badge">Mais Vendido</span>
                </div>
                <h3>Chocolate Belga</h3>
                <p>Feito com chocolate belga 70% cacau e pedaços crocantes</p>
            </div>
            <!-- Card 11 -->
            <div class="cardapio-card">
                <div class="cardapio-img-area">
                    <img src="../img/choco-belga.png" alt="Chocolate Belga">
                    <span class="badge">Mais Vendido</span>
                </div>
                <h3>Chocolate Belga</h3>
                <p>Feito com chocolate belga 70% cacau e pedaços crocantes</p>
            </div>
            <!-- Card 12 -->
            <div class="cardapio-card">
                <div class="cardapio-img-area">
                    <img src="../img/choco-belga.png" alt="Chocolate Belga">
                    <span class="badge">Mais Vendido</span>
                </div>
                <h3>Chocolate Belga</h3>
                <p>Feito com chocolate belga 70% cacau e pedaços crocantes</p>
            </div>
            <!-- Card 13 -->
            <div class="cardapio-card">
                <div class="cardapio-img-area">
                    <img src="../img/choco-belga.png" alt="Chocolate Belga">
                    <span class="badge">Mais Vendido</span>
                </div>
                <h3>Chocolate Belga</h3>
                <p>Feito com chocolate belga 70% cacau e pedaços crocantes</p>
            </div>
            <!-- Card 14-->
            <div class="cardapio-card">
                <div class="cardapio-img-area">
                    <img src="../img/choco-belga.png" alt="Chocolate Belga">
                    <span class="badge">Mais Vendido</span>
                </div>
                <h3>Chocolate Belga</h3>
                <p>Feito com chocolate belga 70% cacau e pedaços crocantes</p>
            </div>
            <!-- Card 15 -->
            <div class="cardapio-card">
                <div class="cardapio-img-area">
                    <img src="../img/choco-belga.png" alt="Chocolate Belga">
                    <span class="badge">Mais Vendido</span>
                </div>
                <h3>Chocolate Belga</h3>
                <p>Feito com chocolate belga 70% cacau e pedaços crocantes</p>
            </div>
            <!-- Card 16 -->
            <div class="cardapio-card">
                <div class="cardapio-img-area">
                    <img src="../img/choco-belga.png" alt="Chocolate Belga">
                    <span class="badge">Mais Vendido</span>
                </div>
                <h3>Chocolate Belga</h3>
                <p>Feito com chocolate belga 70% cacau e pedaços crocantes</p>
            </div>
        </div>
    </section>
    <!-- FOOTER -->
    <footer>
        <div class="footer-content">
            <div class="footer-brand">
                <img src="../img/Sweet.svg" alt="Sweet Cookies">
                <div class="footer-social">
                    <a href="https://www.instagram.com/sweetcookies_ofc"><img src="../img/Instagram.png" alt="Instagram"></a>
                    <a href="#"><img src="../img/WhatsApp.png" alt="WhatsApp"></a>
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
            <script src="../js/navbar.js"></script>
            <script src="../js/darkmode.js"></script>
</body>
</html>