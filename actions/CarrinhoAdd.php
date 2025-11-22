<?php 
// actions/CarrinhoAdd.php

session_start();
header("Content-Type: application/json");

include("../config/conexao.php"); 

function formatarMoeda($valor_bruto){
    return number_format($valor_bruto, 2, ',', '.');
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['id']))
{
    echo json_encode(['status' => 'error', 'message' => 'Requisição inválida ou ID não enviado.']);
    exit;
}

$product_id = intval($_POST['id']);
$action = isset($_POST['action']) ? $_POST['action'] : 'add';

if (!isset($_SESSION['carrinho'])){
    $_SESSION['carrinho'] = [];
}

$response = ['status' => 'error', 'message' => 'Ação não reconhecida.', 'cart_count' => 0, 'item_quantity' => 0];


if ($action === 'add') 
{
    if (isset($_SESSION['carrinho'][$product_id]))
    {
        $_SESSION['carrinho'][$product_id]['quantidade']++;
        $response['status'] = 'success';
    } 
    else 
    {
        $sql = "SELECT id, nome, descricao, tipo, preco, imagem FROM produtos WHERE id = ? LIMIT 1";
        
        if ($stmt = $conn->prepare($sql)) 
        {
            $stmt->bind_param("i", $product_id);
            $stmt->execute();
            $result = $stmt->get_result();
            
            if ($result && $result->num_rows > 0) 
            {
                $produto_data = $result->fetch_assoc();
                
                $_SESSION['carrinho'][$product_id] = [
                    'id' => $produto_data['id'],
                    'nome' => $produto_data['nome'],
                    'descricao' => $produto_data['descricao'],
                    'tipo' => $produto_data['tipo'],
                    'preco' => (float)$produto_data['preco'], // Preço como float é crucial para o cálculo!
                    'imagem' => $produto_data['imagem'],
                    'quantidade' => 1
                ];
                $response['status'] = 'success';
            } 
            else 
            {
                $response['message'] = 'Produto não encontrado no BD.';
            }
            $stmt->close();
        } 
        else{
             $response['message'] = 'Erro ao preparar a consulta SQL.';
        }
    }
}
elseif ($action === 'remove') 
{
    if (isset($_SESSION['carrinho'][$product_id])) 
    {
        $_SESSION['carrinho'][$product_id]['quantidade']--;

        if ($_SESSION['carrinho'][$product_id]['quantidade'] <= 0){
            unset($_SESSION['carrinho'][$product_id]);
        }
        $response['status'] = 'success';
    }
    else{
        $response['message'] = 'Item não encontrado para remover.';
    }
}
elseif ($action === 'full_remove') 
{
    if (isset($_SESSION['carrinho'][$product_id])) 
    {
        unset($_SESSION['carrinho'][$product_id]);
        $response['status'] = 'success';
        $response['message'] = 'Item removido completamente.';
    } 
    else{
        $response['message'] = 'Item não encontrado para remoção completa.';
    }
}
else
{
    $response['message'] = 'Ação desconhecida.';
}

$cart_count = 0;
$new_total_carrinho = 0;
$new_sub_total_item = 0;

foreach ($_SESSION['carrinho'] as $item){
    $sub_total_do_item = $item['preco'] * $item['quantidade'];
    $new_total_carrinho += $sub_total_do_item;
    $cart_count += $item['quantidade'];
}

$item_quantity = isset($_SESSION['carrinho'][$product_id]) ? $_SESSION['carrinho'][$product_id]['quantidade'] : 0;

if ($item_quantity > 0 && isset($_SESSION['carrinho'][$product_id]['preco'])) {
    $preco_unitario_item = $_SESSION['carrinho'][$product_id]['preco'];
    $new_sub_total_item = $preco_unitario_item * $item_quantity;
}


$response['cart_count'] = $cart_count;
$response['item_quantity'] = $item_quantity;
$response['total_carrinho'] = formatarMoeda($new_total_carrinho); 
$response['sub_total_item'] = formatarMoeda($new_sub_total_item);


if ($response['status'] === 'success' && empty($response['message'])){
    $response['message'] = 'Carrinho atualizado com sucesso!';
}

$conn->close();

echo json_encode($response);
exit;

?>