<?php 
    session_start();
    if (empty($_SESSION['logado'])) 
    {
        header("Location: login.php");
        exit;
    }

    $usuario = $_SESSION['usuario'];

    include("../config/conexao.php");

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
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/cardapio.css">
    <link rel="stylesheet" href="../css/responsive.css">
</head>

<body>
    <?php 
        include("../config/header.php"); 
    ?>
    
    <!-- CARDÁPIO -->
    <section class="cardapio-section">
        <h2>Nossos Cookies Doces Especiais</h2>
        <span class="cardapio-subtitle">Receitas irresistíveis criadas para adoçar todos os momentos</span>
        <div class="cardapio-lista">
            <?php while ($produto = $result_doce->fetch_assoc()): ?>

                <?php
                    $quantidade_atual = 0;

                    if (isset($_SESSION['carrinho']) && isset($_SESSION['carrinho'][$produto['id']])){
                        $quantidade_atual = $_SESSION['carrinho'][$produto['id']]['quantidade'];
                    }
                ?>

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
                        
                        <span class="qty-value"><?php echo $quantidade_atual; ?></span>
                        
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

                <?php
                    $quantidade_atual = 0;

                    if (isset($_SESSION['carrinho']) && isset($_SESSION['carrinho'][$produto['id']])){
                        $quantidade_atual = $_SESSION['carrinho'][$produto['id']]['quantidade'];
                    }
                ?>

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
                        <span class="qty-value"><?php echo $quantidade_atual; ?></span>
                        <button class="qty-btn qty-plus">+</button>
                    </div>

                </div>

            <?php endwhile; ?>
        </div>
    </section>
    <!-- FOOTER -->
    <?php 
        $path = "../";
        include("../config/footer.php"); 
    ?>
            
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