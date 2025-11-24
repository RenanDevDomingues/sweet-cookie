<?php 
    session_start();
    $usuario = $_SESSION['usuario'] ?? null;
    
    $itens_carrinho_view = [];
    $total_carrinho = 0;

    if (isset($_SESSION['carrinho']) && !empty($_SESSION['carrinho'])) {
        foreach ($_SESSION['carrinho'] as $id_produto => $item) {
            $quantidade = $item['quantidade'];
            $preco_unitario = $item['preco']; 
            $sub_total_item = $preco_unitario * $quantidade;

            $itens_carrinho_view[] = [
                'id' => $id_produto,
                'nome' => $item['nome'],
                'imagem' => $item['imagem'],
                'preco_unitario' => $preco_unitario,
                'quantidade' => $quantidade,
                'sub_total' => $sub_total_item
            ];
            $total_carrinho += $sub_total_item;
        }
    }

    function formatarMoeda($valor_bruto){
        return number_format($valor_bruto, 2, ',', '.');
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrinho | Sweet Cookies</title>
    
    <link rel="stylesheet" href="../css/checkout.css"> 
    <link rel="stylesheet" href="../css/carrinho.css">
    <link rel="stylesheet" href="../css/cardapio.css"> 
    
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,600,700,800&display=swap" rel="stylesheet">
</head>
<body>
    <?php 
        $path = "../";
        include("../config/header.php"); 
    ?>

    <main class="checkout-container">
        
        <section class="carrinho-content form-box"> 
            <h2>Seu Carrinho</h2>

            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>Produto</th>
                            <th>Nome</th>
                            <th>Preço Unitário</th>
                            <th>Quantidade</th>
                            <th>Sub-Total</th>
                            <th>Remover</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($itens_carrinho_view)): ?>
                            <tr>
                                <td colspan="6" style="text-align: center; padding: 50px; opacity: 0.7;">
                                    Seu carrinho está vazio! <br>
                                    <a href="cardapio.php" style="color: #C62828; font-weight: bold;">Voltar ao cardápio</a>
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($itens_carrinho_view as $item): ?>
                                <tr data-id="<?= $item['id'] ?>">
                                    <td>
                                        <img src="../uploads/produtos/<?php echo $item['imagem']; ?>" 
                                            alt="<?php echo $item['nome']; ?>" style="max-width: 70px;">
                                    </td>
                                    <td><?php echo $item['nome']; ?></td>
                                    <td>R$ <?php echo formatarMoeda($item['preco_unitario']); ?></td>
                                    
                                    <td>
                                        <div class="qty-control" data-id="<?= $item['id'] ?>">
                                            <button class="qty-btn qty-minus">−</button>
                                            <span class="qty-value">
                                                <?php echo $item['quantidade']; ?>
                                            </span>
                                            <button class="qty-btn qty-plus">+</button>
                                        </div>
                                    </td>
                                    
                                    <td class="item-sub-total">
                                        R$ <?php echo formatarMoeda($item['sub_total']); ?>
                                    </td>

                                    <td>
                                        <button class="qty-btn qty-remove" data-id="<?= $item['id'] ?>">
                                            X
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </section>
        
        <aside class="checkout-summary">
            <h1>Resumo</h1>

            <div class="valor">
                <div class="original">
                    <p>Sub-Total:</p>
                    <span id="subtotal-carrinho-valor">
                        R$ <?= formatarMoeda($total_carrinho) ?>
                    </span>
                </div>
            </div>

            <div class="total">
                <p>Total:</p>
                <span id="total-carrinho-valor">
                    R$ <?= formatarMoeda($total_carrinho) ?>
                </span>

                <?php if (!empty($itens_carrinho_view)): ?>
                    <a href="checkout.php">
                        <button class="btn-finalizar">CHECKOUT</button>
                    </a>
                <?php else: ?>
                     <button class="btn-finalizar" style="opacity: 0.5; cursor: not-allowed;">CHECKOUT</button>
                <?php endif; ?>
            </div>
        </aside>

    </main>

    <?php 
        $path = "../";
        include("../config/footer.php"); 
    ?>
    
    <script>
        $(document).ready(function() 
        {
            function updateCart(productId, action, $container) 
            {
                let $row = $container.closest('tr');
                let $itemSubTotal = $row.find('.item-sub-total');

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
                            $('#total-carrinho-valor').text('R$ ' + data.total_carrinho);
                            $('#subtotal-carrinho-valor').text('R$ ' + data.total_carrinho);
                            $('.original span').text('R$ ' + data.total_carrinho);

                            if (action === 'full_remove') 
                            {
                                $row.fadeOut(300, function() { $(this).remove(); });
                                if (data.cart_count === 0) setTimeout(() => location.reload(), 300);
                            } 
                            else 
                            {
                                $container.find('.qty-value').text(data.item_quantity);
                                
                                if (data.sub_total_item !== undefined){
                                    $itemSubTotal.text('R$ ' + data.sub_total_item);
                                }

                                if (data.item_quantity === 0)
                                {
                                    $row.fadeOut(300, function() { $(this).remove(); });
                                    if (data.cart_count === 0) setTimeout(() => location.reload(), 300);
                                } 
                            }
                        } 
                        else 
                        {
                            alert(data.message);
                        }
                    },
                    error: function(xhr, status, error){
                        console.error("AJAX Error:", status, error);
                    }
                });
            }

            $('.qty-plus').on('click', function() {
                let $container = $(this).closest('.qty-control');
                updateCart($container.data('id'), 'add', $container);
            });

            $('.qty-minus').on('click', function() {
                let $container = $(this).closest('.qty-control');
                let currentQty = parseInt($container.find('.qty-value').text());
                if (currentQty > 0) updateCart($container.data('id'), 'remove', $container);
            });

            $('.qty-remove').on('click', function() {
                let $container = $(this).closest('tr');
                updateCart($(this).data('id'), 'full_remove', $container);
            });
        });
    </script>
</body>
</html>