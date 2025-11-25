<?php
include '../config/conexao.php';


if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: dashboard.php?erro=id_invalido");
    exit;
}

$id = intval($_GET['id']);


$sqlCheck = "SELECT COUNT(*) AS total FROM pedido_itens WHERE produto_id = $id";
$resCheck = mysqli_query($conn, $sqlCheck);
$dado = mysqli_fetch_assoc($resCheck);

if ($dado['total'] > 0) {
    
    header("Location: dashboard.php?erro=produto_em_pedido");
    exit;
}


$sql = "SELECT imagem FROM produtos WHERE id = $id LIMIT 1";
$result = mysqli_query($conn, $sql);

if (!$result || mysqli_num_rows($result) == 0) {
    header("Location: dashboard.php?erro=produto_nao_encontrado");
    exit;
}

$produto = mysqli_fetch_assoc($result);
$imagem = $produto['imagem'];


$sqlDelete = "DELETE FROM produtos WHERE id = $id";

if (mysqli_query($conn, $sqlDelete)) {

    
    $caminhoImg = "../uploads/produtos/" . $imagem;

    if (!empty($imagem) && file_exists($caminhoImg)) {
        unlink($caminhoImg);
    }

    header("Location: dashboard.php?msg=produto_excluido");
    exit;

} else {
    echo "Erro ao excluir produto: " . mysqli_error($conn);
}
?>
