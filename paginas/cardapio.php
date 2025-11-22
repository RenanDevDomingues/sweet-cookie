<?php 
    session_start();
    $usuario = null;

    if(!empty($_SESSION['logado'])){
        $usuario = $_SESSION['usuario'];
    } 
    else{
        header("Location: login.php");
    }

    include("../config/conexao.php");

    $cartCount = 0;
    if (isset($_SESSION['carrinho'])) 
    {
        foreach ($_SESSION['carrinho'] as $item){
            $cartCount += $item['quantidade'];
        }
    }

    $sql = "SELECT * FROM produtos WHERE tipo = 'cookie_doce' ORDER BY id";
    $result_doce = $conn->query($sql);

    $sql = "SELECT * FROM produtos WHERE tipo = 'cookie_salgado' ORDER BY id";
    $result_salgado = $conn->query($sql);
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
                    <span class="cart-badge"><?= $cartCount ?></span>
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
            <?php while ($produto = $result_doce->fetch_assoc()): ?>

                <div class="cardapio-card">
                    <div class="cardapio-img-area">
                        <img src="../uploads/produtos/<?php echo $produto['imagem']; ?>" 
                            alt="<?php echo $produto['nome']; ?>">
                        
                            <span class="badge bg-pink">Doce</span>
                    </div>

                    <h3><?php echo $produto['nome']; ?></h3>
                    <p><?php echo $produto['descricao']; ?></p>
                    <span class="preco">
                        R$ <?php echo number_format($produto['preco'], 2, ',', '.'); ?>
                    </span>
                    <div class="qty-control" data-id="<?= $produto['id'] ?>">
                        <button class="qty-btn qty-minus">−</button>
                        <span class="qty-value">0</span>
                        <button class="qty-btn qty-plus">+</button>
                    </div>

                </div>

            <?php endwhile; ?>
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
        <span class="cardapio-subtitle">Receitas irresistíveis criadas para salgar todos os momentos</span>
        <div class="cardapio-lista">
            <?php while ($produto = $result_salgado->fetch_assoc()): ?>

                <div class="cardapio-card">
                    <div class="cardapio-img-area">
                        <img src="../uploads/produtos/<?php echo $produto['imagem']; ?>" 
                            alt="<?php echo $produto['nome']; ?>">
                        
                        <span class="badge bg-orange">Salgado</span>
                    </div>

                    <h3><?php echo $produto['nome']; ?></h3>
                    <p><?php echo $produto['descricao']; ?></p>
                    <span class="preco">
                        R$ <?php echo number_format($produto['preco'], 2, ',', '.'); ?>
                    </span>
                    <div class="qty-control" data-id="<?= $produto['id'] ?>">
                        <button class="qty-btn qty-minus">−</button>
                        <span class="qty-value">0</span>
                        <button class="qty-btn qty-plus">+</button>
                    </div>

                </div>

            <?php endwhile; ?>
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
            <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script>
        $(document).ready(function() 
        {
            function updateCart(productId, action, $container) 
            {
                $.ajax({
                    url: '../actions/CarrinhoAdd.php',
                    method: 'POST',
                    dataType: 'json',
                    data: {
                        id: productId,
                        action: action
                    },
                    success: function(data) 
                    {
                        if (data.status === 'success') 
                        {
                            $('.cart-badge').text(data.cart_count);

                            $container.find('.qty-value').text(data.item_quantity);
                        } 
                        else{
                            alert(data.message);
                        }
                    },
                    error: function(){
                        alert('Erro ao comunicar com o servidor.');
                    }
                });
            }

            $('.qty-plus').on('click', function() 
            {
                let $container = $(this).closest('.qty-control');
                let id = $container.data('id');
                updateCart(id, 'add', $container);
            });

            $('.qty-minus').on('click', function() 
            {
                let $container = $(this).closest('.qty-control');
                let id = $container.data('id');
                let currentQty = parseInt($container.find('.qty-value').text());

                if (currentQty > 0){
                    updateCart(id, 'remove', $container);
                }
            });
        });
    </script>
</body>
</html>