<?php 
    session_start();
    $usuario = null;

    if(!empty($_SESSION['logado'])){
        $usuario = $_SESSION['usuario'];
    }
    
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
    <link rel="stylesheet" href="../css/carrinho.css">
    <link rel="stylesheet" href="../css/cardapio.css"> 
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,600,700,800&display=swap" rel="stylesheet">
</head>
<body>
    <?php 
        $path = "../";
        include("../config/header.php"); 
    ?>

    <main>
        <div class="carrinho">
            <table>
                <tr>
                    <th>Produto</th>
                    <th>Nome</th>
                    <th>Preço Unitário</th>
                    <th>Quantidade</th>
                    <th>Remover</th>
                </tr>
                
                <?php if (empty($itens_carrinho_view)): ?>
                    <tr>
                        <td colspan="5" style="text-align: center; padding: 20px;">
                            Seu carrinho está vazio!
                        </td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($itens_carrinho_view as $item): ?>
                        <tr data-id="<?= $item['id'] ?>">
                            <td>
                                <img src="../uploads/produtos/<?php echo $item['imagem']; ?>" 
                                    alt="<?php echo $item['nome']; ?>" style="max-width: 80px;">
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
                            
                            <td>
                                <button class="qty-btn qty-remove" data-id="<?= $item['id'] ?>">
                                    X
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </table>
        </div>
        
        <div class="check">
            <h1>Resumo</h1>
            <div class="valor">
                <div class="original">
                    <p>Sub-Total: </p>
                    <span id="subtotal-carrinho-valor">R$ <?php echo formatarMoeda($total_carrinho); ?></span>
                </div>
                <div class="desconto">
                    <div class="des_total">
                        <p>Desconto: </p>
                        <span>0,00 R$</span>
                    </div>
                    <div class="lista">
                        <p>Sem Descontos</p><br><p>Sem Descontos</p><br><p>Sem Descontos</p><br>
                        <p>Sem Descontos</p><br><p>Sem Descontos</p><br><p>Sem Descontos</p><br>
                        <p>Sem Descontos</p><br><p>Sem Descontos</p><br><p>Sem Descontos</p><br>
                    </div>
                </div>
            </div>
            <div class="total">
                <p>Total: </p>
                <span id="total-carrinho-valor">R$ <?php echo formatarMoeda($total_carrinho); ?></span> 
                <button>CHECKOUT</button>
            </div>
        </div>
    </main>
    
    <footer>
        <div class="footer-content">
            <div class="footer-brand">
                <img src="../img/Sweet.svg" alt="Sweet Cookies">
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
    
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="../js/darkmode.js"></script>
    <script src="../js/navbar.js"></script>
    
    <script>
        $(document).ready(function() 
        {
            function updateCart(productId, action, $container) 
            {
                let $row = $container.closest('tr');
                
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
                            $('.original span').text('R$ ' + data.total_carrinho);

                            if (action === 'full_remove') 
                            {
                                $row.remove();

                                if (data.cart_count === 0){
                                    location.reload();
                                }
                            } 
                            else 
                            {
                                $container.find('.qty-value').text(data.item_quantity);
                                
                                if (data.item_quantity === 0)
                                {
                                    $row.remove(); 
                                    
                                    if (data.cart_count === 0){
                                        location.reload();
                                    }
                                } 
                                else{
                                    // 3. ATUALIZA O SUBTOTAL DO ITEM NA TABELA (OPCIONAL: se você tivesse uma coluna para isso)
                                    // Se você quiser atualizar o subtotal do item em R$ em tempo real, 
                                    // você precisaria de um <td> específico e usar:
                                    // $row.find('.sub-total-coluna').text('R$ ' + data.sub_total_item);
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
                        alert('Erro ao comunicar com o servidor.');
                    }
                });
            }

            $('.qty-plus').on('click', function() 
            {
                let $container_do_produto = $(this).closest('.qty-control');
                let id = $container_do_produto.data('id');
                updateCart(id, 'add', $container_do_produto);
            });

            $('.qty-minus').on('click', function() 
            {
                let $container_do_produto = $(this).closest('.qty-control');
                let id = $container_do_produto.data('id');
                let currentQty = parseInt($container_do_produto.find('.qty-value').text());

                if (currentQty > 0){
                    updateCart(id, 'remove', $container_do_produto);
                }
            });

            $('.qty-remove').on('click', function() 
            {
                let $container_do_produto = $(this).closest('tr');
                let id = $(this).data('id');
                
                updateCart(id, 'full_remove', $container_do_produto);
            });
        });
    </script>
</body>
</html>