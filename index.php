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
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,600,700,800&display=swap" rel="stylesheet">
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
        <a href="./paginas/merchan.php" class="merchan">
        <button class="btn-main">Conheça nossos produtos</button>
        </a>
    </section>

    <!-- MONTE SEU COOKIE -->
    <section class="monte-cookie-section">
        <h2>Monte seu cookie personalizado</h2>
        <div class="monte-cookie-content">
            <div class="cookie-preview">
                <h3>Seu cookie personalizado</h3>
                <p>Visualize seu cookie aqui</p>
                <img src="img/choco-belga.png" alt="Cookie Preview">
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
    <section class="cookie-gif-section" <div class="cookie-gif-content">
        <img src="img/SweetCookiesGif.gif" alt="Sweet Cookies GIF" class="cookie-gif">
        </div>

        <!-- FEEDBACKS -->
        <section class="feedbacks-section">
            <div class="feedbacks-bar">
                <img src="img/face1.png" alt="">
                <img src="img/face2.png" alt="">
                <img src="img/face3.png" alt="">
                <img src="img/face4.png" alt="">
                <img src="img/face5.png" alt="">
            </div>
            <h2>Alguns feedbacks</h2>
            <div class="feedbacks-lista">
                <div class="feedback-card"></div>
                <div class="feedback-card"></div>
                <div class="feedback-card"></div>
            </div>
            <div class="carousel-controls">
                <button class="carousel-arrow">&#8592;</button>
                <button class="carousel-dot active"></button>
                <button class="carousel-dot"></button>
                <button class="carousel-dot"></button>
                <button class="carousel-arrow">&#8594;</button>
            </div>
        </section>

        <!-- FOOTER -->
        <?php 
            $path = "";
            include("config/footer.php"); 
        ?>
</body>

</html>