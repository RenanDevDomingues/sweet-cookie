<?php
session_start();
$usuario = $_SESSION['usuario'] ?? null;

$itens_carrinho_view = [];
$total_carrinho = 0;

if (!empty($_SESSION['carrinho'])) {
    foreach ($_SESSION['carrinho'] as $id_produto => $item) {
        $quantidade      = $item['quantidade'];
        $preco_unitario  = $item['preco'];
        $sub_total_item  = $preco_unitario * $quantidade;

        $itens_carrinho_view[] = [
            'id'             => $id_produto,
            'nome'           => $item['nome'],
            'imagem'         => $item['imagem'],
            'preco_unitario' => $preco_unitario,
            'quantidade'     => $quantidade,
            'sub_total'      => $sub_total_item
        ];

        $total_carrinho += $sub_total_item;
    }
}

function formatarMoeda($valor)
{
    return number_format($valor, 2, ',', '.');
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout | Sweet Cookies</title>

    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/checkout.css">
    <link rel="stylesheet" href="../css/responsive.css">
    <link rel="stylesheet" href="../css/carrinho.css"> 
</head>

<body>
    <?php 
        $path = "../";
        include("../config/header.php"); 
    ?>

    <main class="checkout-container">

        <section class="checkout-form">

            <div class="form-box">
                <h2>Contato</h2>

                <div class="input-group">
                    <input type="email" name="email" id="email" value="<?= $usuario['email'] ?? '' ?>" required>
                    <label for="email">E-mail</label>
                </div>
            </div>

            <div class="form-box">
                <h2>Pagamento</h2>

                <div class="forma">
                    <label class="pag-option" data-method="pix">
                        <img src="../img/pix.png" alt="Pix">
                        <input type="radio" name="pagamento" value="pix" hidden>
                    </label>

                    <label class="pag-option" data-method="credito">
                        <img src="../img/credito.png" alt="Cartão de Crédito">
                        <input type="radio" name="pagamento" value="credito" hidden>
                    </label>

                    <label class="pag-option" data-method="debito">
                        <img src="../img/debito.png" alt="Cartão de Débito">
                        <input type="radio" name="pagamento" value="debito" hidden>
                    </label>
                </div>

                <div class="info-pagamento"></div>
            </div>

            <div class="form-box">
                <h2>Local de Entrega</h2>

                <div class="input-group">
                    <input type="text" name="cep" id="cep" maxlength="9" placeholder=" " required>
                    <label for="cep">CEP</label>
                </div>

                <button class="btn-enviar-cep" type="button" id="buscar-cep">Buscar Endereço</button>

                <div id="campos-endereco" style="margin-top: 20px;">
                    
                    <div class="input-group">
                        <input type="text" name="logradouro" id="logradouro" placeholder=" " required>
                        <label for="logradouro">Endereço (Rua/Av)</label>
                    </div>

                    <div style="display: flex; gap: 15px;">
                        <div class="input-group" style="flex: 1;">
                            <input type="text" name="numero" id="numero" placeholder=" " required>
                            <label for="numero">Número</label>
                        </div>
                        <div class="input-group" style="flex: 2;">
                            <input type="text" name="complemento" id="complemento" placeholder=" ">
                            <label for="complemento">Complemento</label>
                        </div>
                    </div>

                    <div class="input-group">
                        <input type="text" name="bairro" id="bairro" placeholder=" " required>
                        <label for="bairro">Bairro</label>
                    </div>

                    <div style="display: flex; gap: 15px;">
                        <div class="input-group" style="flex: 3;">
                            <input type="text" name="cidade" id="cidade" placeholder=" " required>
                            <label for="cidade">Cidade</label>
                        </div>
                        <div class="input-group" style="flex: 1;">
                            <input type="text" name="estado" id="estado" placeholder=" " required maxlength="2">
                            <label for="estado">UF</label>
                        </div>
                    </div>

                </div>
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
                    <button class="btn-finalizar">FINALIZAR PEDIDO</button>
                <?php else: ?>
                     <button class="btn-finalizar" disabled style="opacity: 0.5;">CARRINHO VAZIO</button>
                <?php endif; ?>
            </div>
        </aside>

    </main>

    <?php 
        $path = "../";
        include("../config/footer.php"); 
    ?>

    <script src="../js/checkout.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script>
        $('#cep').mask('00000-000');
    </script>

</body>
</html>