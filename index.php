<?php 
    session_start();
    $usuario = null;

    if(!empty($_SESSION['logado'])){
        $usuario = $_SESSION['usuario'];
    }
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sweet Cookies</title>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/responsive.css">
</head>

<body>
    <?php 
        $path = ""; 
        include("config/header.php"); 
    ?>
    
    <!-- HERO -->
    <section class="hero">
        <div class="hero-overlay">
            <img src="img/Chip Padrão.png" alt="Cookie Face">
            <h1><span class="highlight">Cookies</span> artesanais, macios<br>por dentro e crocantes por fora</h1>
            <p>Feitos com ingredientes premium e muito amor</p>
            <a href="./paginas/cardapio.php" class="cardapio-link">
            <button class="btn-main">Fazer pedido agora</button>
            </a>
        </div>
    </section>

    <!-- SABORES -->
    <section class="sabores-section">
        <div class="container">
            <h2>Nossos sabores</h2>
            <div class="sabores-lista">
                <div class="sabor-card">
                    <img src="img/choco-belga.png" alt="Chocolate Belga">
                    <span class="badge">Mais Vendido</span>
                    <h3>Chocolate Belga</h3>
                    <p>Feito com chocolate belga 70% cacau e pedaços crocantes</p>
                </div>
                <div class="sabor-card">
                    <img src="img/cookie-matcha.png" alt="Matcha & Chocolate Branco">
                    <span class="badge vegano">Vegano</span>
                    <h3>Matcha & Chocolate Branco</h3>
                    <p>Massa de matcha premium com chocolate branco vegano</p>
                </div>
                <div class="sabor-card">
                    <img src="img/red-velvet.png" alt="Red Velvet">
                    <span class="badge novidade">Novidade</span>
                    <h3>Red Velvet</h3>
                    <p>Massa vermelha com recheio de cream cheese e gotas de chocolate</p>
                </div>
            </div>
            <a href="./paginas/cardapio.php" class="cardapio-link">
            <button class="btn-main">Conheça nossos Cookies</button>
        </a>
        </div>
    </section>

    <!-- PRODUTOS EM DESTAQUE -->
    <section class="produtos-destaque">
        <div class="produtos-imgs">
            <img src="img/produtos.png" alt="produtos em destaque">

        </div>
    </section>

    <section class="sabores-section">
        <div class="container">
            <h2>Nossos produtos</h2>
            <div class="sabores-lista">
                <div class="sabor-card">
                    <img src="img/choco-belga.png" alt="Chocolate Belga">
                    <span class="badge">Mais Vendido</span>
                    <h3>Chocolate Belga</h3>
                    <p>Feito com chocolate belga 70% cacau e pedaços crocantes</p>
                </div>
                <div class="sabor-card">
                    <img src="img/cookie-matcha.png" alt="Matcha & Chocolate Branco">
                    <span class="badge vegano">Vegano</span>
                    <h3>Matcha & Chocolate Branco</h3>
                    <p>Massa de matcha premium com chocolate branco vegano</p>
                </div>
                <div class="sabor-card">
                    <img src="img/red-velvet.png" alt="Red Velvet">
                    <span class="badge novidade">Novidade</span>
                    <h3>Red Velvet</h3>
                    <p>Massa vermelha com recheio de cream cheese e gotas de chocolate</p>
                </div>
            </div>
            <a href="./paginas/merchan.php" class="cardapio-link">
            <button class="btn-main">Conheça nossos Produtos</button>
            </a>
        </div>
    </section>

    <section class="cookie-gif-section" <div class="cookie-gif-content">
        <img src="img/SweetCookiesGif.gif" alt="Sweet Cookies GIF" class="cookie-gif">
        </div>

        <!-- FOOTER -->
        <?php 
            $path = "";
            include("config/footer.php"); 
        ?>
</body>

</html>