<?php
session_start();
header('Content-Type: application/json');

require_once "../config/conexao.php"; 

if ($_SERVER['REQUEST_METHOD'] !== 'POST') 
    {
    echo json_encode(['status' => 'error', 'message' => 'Método inválido.']);
    exit;
}

if (empty($_SESSION['carrinho'])) 
    {
    echo json_encode(['status' => 'error', 'message' => 'Seu carrinho está vazio.']);
    exit;
}

if (!isset($_SESSION['usuario'])) 
    {
    echo json_encode(['status' => 'error', 'message' => 'Você precisa estar logado para finalizar o pedido.']);
    exit;
}

$usuario_id = $_SESSION['usuario']['id'];
$email_contato = $_POST['email'] ?? '';
$forma_pagamento = $_POST['pagamento'] ?? '';
$cep         = $_POST['cep'] ?? '';
$logradouro  = $_POST['logradouro'] ?? '';
$numero      = $_POST['numero'] ?? 'S/N';
$complemento = $_POST['complemento'] ?? '';
$bairro      = $_POST['bairro'] ?? '';
$cidade      = $_POST['cidade'] ?? '';
$estado      = $_POST['estado'] ?? '';

if (empty($forma_pagamento) || empty($cep) || empty($logradouro) || empty($numero))
{
    echo json_encode(['status' => 'error', 'message' => 'Preencha todos os dados de endereço e pagamento.']);
    exit;
}

$valor_total = 0;
foreach ($_SESSION['carrinho'] as $item){
    $valor_total += $item['preco'] * $item['quantidade'];
}

$conn->begin_transaction();

try 
{
    $sql_pedido = "INSERT INTO pedidos (usuario_id, valor_total, forma_pagamento, status, data_pedido, cep, logradouro, numero, complemento, bairro, cidade, estado) 
                   VALUES (?, ?, ?, 'aguardando_pagamento', NOW(), ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql_pedido);
    
    $stmt->bind_param("idssssssss", 
        $usuario_id, 
        $valor_total, 
        $forma_pagamento, 
        $cep,
        $logradouro, 
        $numero, 
        $complemento, 
        $bairro, 
        $cidade, 
        $estado
    );

    if (!$stmt->execute()){
        throw new Exception("Erro ao criar o pedido: " . $stmt->error);
    }

    $pedido_id = $conn->insert_id;
    $stmt->close();

    $sql_item = "INSERT INTO pedido_itens (pedido_id, produto_id, quantidade, preco_unitario, subtotal) 
                 VALUES (?, ?, ?, ?, ?)";
    
    $stmt_item = $conn->prepare($sql_item);

    foreach ($_SESSION['carrinho'] as $prod_id => $item) 
    {
        $quantidade = $item['quantidade'];
        $preco      = $item['preco'];
        $subtotal   = $preco * $quantidade;
        $produto_id_db = intval($item['id']); 

        $stmt_item->bind_param("iiidd", $pedido_id, $produto_id_db, $quantidade, $preco, $subtotal);
        
        if (!$stmt_item->execute()){
            throw new Exception("Erro ao adicionar item do pedido.");
        }
    }
    $stmt_item->close();

    $conn->commit();

    unset($_SESSION['carrinho']);

    echo json_encode([
        'status' => 'success', 
        'message' => 'Pedido realizado com sucesso!',
        'pedido_id' => $pedido_id,
        'redirect' => '../index.php'
    ]);

} 
catch (Exception $e) {
    $conn->rollback();
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}

$conn->close();
?>