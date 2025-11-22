<?php
session_start();
header("Content-Type: application/json");
include("../config/conexao.php");

if (!isset($_POST['id'])){
    echo json_encode(['status' => 'error', 'message' => 'ID não enviado']);
    exit;
}

$product_id = intval($_POST['id']);
$action = isset($_POST['action']) ? $_POST['action'] : 'add';

if (!isset($_SESSION['carrinho'])){
    $_SESSION['carrinho'] = [];
}

if ($action === 'add') 
{
    if (isset($_SESSION['carrinho'][$product_id])){
        $_SESSION['carrinho'][$product_id]['quantidade']++;
    } 
    else 
    {
        $sql = "SELECT * FROM produtos WHERE id = $product_id LIMIT 1";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) 
        {
            $produto_data = $result->fetch_assoc();
            $_SESSION['carrinho'][$product_id] = [
                'id' => $produto_data['id'],
                'nome' => $produto_data['nome'],
                'descricao' => $produto_data['descricao'],
                'tipo' => $produto_data['tipo'],
                'preco' => $produto_data['preco'],
                'imagem' => $produto_data['imagem'],
                'quantidade' => 1
            ];
        } 
        else 
        {
            echo json_encode(['status' => 'error', 'message' => 'Produto não encontrado']);
            exit;
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
    }
}

$cart_count = 0;
foreach ($_SESSION['carrinho'] as $item){
    $cart_count += $item['quantidade'];
}

$item_quantity = isset($_SESSION['carrinho'][$product_id]) ? $_SESSION['carrinho'][$product_id]['quantidade'] : 0;

echo json_encode([
    'status' => 'success',
    'message' => 'Carrinho atualizado!',
    'cart_count' => $cart_count,
    'item_quantity' => $item_quantity
]);
?>