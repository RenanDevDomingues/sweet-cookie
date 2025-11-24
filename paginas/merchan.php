<?php 
    session_start();
    $usuario = null;

    if(!empty($_SESSION['logado'])){
        $usuario = $_SESSION['usuario'];
    }

    include("../config/conexao.php");

    $sql = "SELECT * FROM produtos WHERE tipo NOT IN ('cookie_doce', 'cookie_salgado') ORDER BY id";
    $result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kits e Presentes | Sweet Cookies</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/cardapio.css">
    <link rel="stylesheet" href="../css/responsive.css">
</head>
<body>
    <?php 
        include("../config/header.php"); 
    ?>

    <!-- MERCHAN -->
    <main class="cardapio-section">
        <h2>Nossos Kits e Presentes para todos</h2>
        <span class="cardapio-subtitle">Presentes irresistíveis criadas para adoçar todos os momentos</span>
        <div class="cardapio-lista">
            <?php while ($produto = $result->fetch_assoc()): ?>

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
                            
                        <?php
                            $mapa_tipos = [
                                'cookie_doce' => 'Cookie Doce',
                                'cookie_salgado' => 'Cookie Salgado',
                                'vestuario' => 'Vestuário',
                                'utensilio' => 'Utensílio',
                                'outro' => 'Outro',
                            ];
                            
                            $tipo_produto = $produto['tipo'];
                            
                            $nome_tipo = $mapa_tipos[$tipo_produto] ?? 'Outro';
                        ?>
                
                        <span class="badge">
                            <?php echo $nome_tipo; ?>
                        </span>
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
    </main>
    <!-- FOOTER -->
    <?php 
        $path = "../";
        include("../config/footer.php"); 
    ?>
</body>
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

</html>