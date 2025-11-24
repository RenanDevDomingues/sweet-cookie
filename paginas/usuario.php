<?php
session_start();
require_once "../config/conexao.php";

$usuario = null;

if (!empty($_SESSION['logado'])){
    $usuario = $_SESSION['usuario'];
} 
else 
{
    header("Location: login.php");
    exit;
}

$historico_compras = [];
$id_usuario = $usuario['id'];

$sql = "SELECT 
            p.id as produto_id, 
            p.nome, 
            p.imagem, 
            ped.id as pedido_id, 
            ped.data_pedido
        FROM pedido_itens ip
        INNER JOIN pedidos ped ON ip.pedido_id = ped.id
        INNER JOIN produtos p ON ip.produto_id = p.id
        WHERE ped.usuario_id = ?
        ORDER BY ped.data_pedido DESC
        LIMIT 6";

if ($stmt = $conn->prepare($sql)) {
    $stmt->bind_param("i", $id_usuario);
    $stmt->execute();
    $result = $stmt->get_result();
    
    while ($row = $result->fetch_assoc()) {
        $historico_compras[] = $row;
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/usuario.css">
    <title>Minha Conta | Sweet Cookies</title>
</head>

<body>
    <?php
    $path = "../";
    include("../config/header.php");
    ?>

    <main class="conta-container">
        
        <section class="card profile-card">
            
            <div class="profile-avatar-area">
                <div class="avatar-circle">
                    <img src="../img/cookie-mascot.png" alt="Avatar" onerror="this.src='https://cdn-icons-png.flaticon.com/512/1047/1047711.png'">
                </div>
            </div>

            <div class="profile-data-area">
                <div class="data-group">
                    <label>Nome de usuário</label>
                    <div class="data-bar">
                        <?= htmlspecialchars($usuario['nome']) ?>
                    </div>
                </div>

                <div class="data-group">
                    <label>E-mail</label>
                    <div class="data-bar">
                        <?= htmlspecialchars($usuario['email']) ?>
                    </div>
                </div>

                <div class="data-group">
                    <label>Senha</label>
                    <div class="data-bar password-bar">********</div>
                    <a href="#" class="forgot-link">Trocar de senha</a>
                </div>
            </div>
        </section>


        <section class="card history-card">
            <h2>Histórico de compras</h2>

            <div class="history-list">
                
                <?php if (empty($historico_compras)): ?>
                    <p style="text-align: center; color: #777;">Você ainda não realizou nenhuma compra.</p>
                <?php else: ?>
                    
                    <?php foreach($historico_compras as $item): ?>
                    <div class="history-item">
                        <div class="item-left">
                            <div class="item-img">
                                <?php 
                                    $img_path = "../uploads/produtos/" . $item['imagem'];
                                    // Verifica se a imagem existe, senão usa placeholder
                                    $img_src = file_exists($img_path) && !empty($item['imagem']) ? $img_path : '../img/cookie-placeholder.png';
                                ?>
                                <img src="<?= $img_src ?>" alt="<?= $item['nome'] ?>">
                            </div>
                            <div style="display: flex; flex-direction: column;">
                                <span class="item-name"><?= $item['nome'] ?></span>
                                <span style="font-size: 0.8rem; color: #666;">
                                    Pedido #<?= $item['pedido_id'] ?> • <?= date('d/m/Y', strtotime($item['data_pedido'])) ?>
                                </span>
                            </div>
                        </div>
                        
                        <button class="btn-buy-again" data-id="<?= $item['produto_id'] ?>">
                            Comprar novamente
                        </button>
                    </div>
                    <?php endforeach; ?>

                <?php endif; ?>

            </div>
        </section>

    </main>

    <?php
    $path = "../";
    include("../config/footer.php");
    ?>
    
    <script>
        $(document).ready(function() 
        {
            $('.btn-buy-again').on('click', function() 
            {
                let produtoId = $(this).data('id');
                let $btn = $(this);
                let textoOriginal = $btn.text();

                $btn.text('Adicionando...').prop('disabled', true);

                $.ajax({
                    url: '../actions/CarrinhoAdd.php',
                    method: 'POST',
                    dataType: 'json',
                    data: {
                        id: produtoId,
                        action: 'add'
                    },
                    success: function(data) {
                        if (data.status === 'success') 
                        {
                            $('.cart-badge').text(data.cart_count);
                            
                            $btn.text('Adicionado!');
                            setTimeout(function(){
                                window.location.href = 'carrinho.php';
                            }, 500);
                        } 
                        else 
                        {
                            alert(data.message);
                            $btn.text(textoOriginal).prop('disabled', false);
                        }
                    },
                    error: function() 
                    {
                        alert('Erro ao adicionar ao carrinho.');
                        $btn.text(textoOriginal).prop('disabled', false);
                    }
                });
            });
        });
    </script>
</body>
</html>