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
    <title>Sweet Cookies</title>
    <linK rel="stylesheet" href="../css/checkout.css">
</head>

<body>
    <main>
        <header><a href="carrinho.php"><button>←</button></a></header>
        <div class="input">
            <div class="contato">
                <h2>Contato</h2>
                <input type="email" name="email" placeholder="">
                <label>Email</label>
                <div class="checkbox">
                    <input type="checkbox"><p>Ofertas serão enviados para o Email</p>
                </div>
            </div>
            <div class="pagamento">
                <div class="forma">
                    <div id="pix">
                        <img src="../img/pix.png">
                        <input type="radio" value='pix' hidden>
                    </div>
                    <div id="credito">
                        <img src="">
                        <input type="radio" value='credito' hidden>
                    </div>
                    <div id="debito">
                        <img src="">
                        <input type="radio" value='debito' hidden>
                    </div>
                </div>
                <div class="info"></div>
            </div>
            <div class="local">
                <h2>Local</h2>
                <input type="text" name="cep" placeholder="">
                <label>CEP</label>
                <button>Enviar</button>
            </div>


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
                        <p>Sem Descontos</p><br>
                        <p>Sem Descontos</p><br>
                        <p>Sem Descontos</p><br>
                        <p>Sem Descontos</p><br>
                        <p>Sem Descontos</p><br>
                        <p>Sem Descontos</p><br>
                        <p>Sem Descontos</p><br>
                        <p>Sem Descontos</p><br>
                        <p>Sem Descontos</p><br>
                    </div>
                </div>
            </div>
            <div class="total">
                <p>Total: </p>
                <span id="total-carrinho-valor">R$ <?php echo formatarMoeda($total_carrinho); ?></span>
                <a href="checkout.php"><button>CHECKOUT</button></a>
            </div>
        </div>
        <div class="escuro"></div>
        <div class="infopagamento"></div>

    </main>
    <footer></footer>
    <script src="../js/checkout.js"></script>
</body>

</html>