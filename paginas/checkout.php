<?php
session_start();
$usuario = $_SESSION['usuario'] ?? null;

/* ============================
   PREPARA DADOS DO CARRINHO
============================= */

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

    <link rel="stylesheet" href="../css/checkout.css">
    <link rel="stylesheet" href="../css/cardapio.css">
</head>

<body>
    <?php 
        $path = "../";
        include("../config/header.php"); 
    ?>

    <main class="checkout-container">

        <!-- =====================================
             FORMULÁRIO DE CONTATO / PAGAMENTO
        ====================================== -->
        <section class="checkout-form">

            <!-- CONTATO -->
            <div class="form-box">
                <h2>Contato</h2>

                <div class="input-group">
                    <input type="email" name="email" id="email">
                    <label for="email">E-mail</label>
                </div>

                <label class="checkbox">
                    <input type="checkbox" id="ofertas">
                    <span>Receber ofertas por e-mail</span>
                </label>
            </div>

            <!-- PAGAMENTO -->
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

            <!-- ENDEREÇO / LOCAL -->
            <div class="form-box">
                <h2>Local</h2>

                <div class="input-group">
                    <input type="text" name="cep" id="cep">
                    <label for="cep">CEP</label>
                </div>

                <button class="btn-enviar-cep">Buscar Endereço</button>

                <div class="endereco-info"></div>
            </div>

        </section>

        <!-- =====================================
                   RESUMO DO PEDIDO
        ====================================== -->
        <aside class="checkout-summary">
            <h1>Resumo</h1>

            <div class="valor">
                <div class="original">
                    <p>Sub-Total:</p>
                    <span id="subtotal-carrinho-valor">
                        R$ <?= formatarMoeda($total_carrinho) ?>
                    </span>
                </div>

                <!-- <div class="desconto">
                    <div class="des_total">
                        <p>Desconto:</p>
                        <span>R$ 0,00</span>
                    </div>

                    <div class="lista">
                        <?php for ($i=0; $i<6; $i++): ?>
                            <p>Sem Descontos</p>
                        <?php endfor; ?>
                    </div>
                </div> -->
            </div>

            <div class="total">
                <p>Total:</p>
                <span id="total-carrinho-valor">
                    R$ <?= formatarMoeda($total_carrinho) ?>
                </span>

                <button class="btn-finalizar">FINALIZAR PEDIDO</button>
            </div>
        </aside>

        <!-- Telas adicionais -->
        <div class="escuro"></div>
        <div class="infopagamento"></div>

    </main>

    <?php 
        $path = "../";
        include("../config/footer.php"); 
    ?>

    <script src="../js/checkout.js"></script>

</body>
</html>
