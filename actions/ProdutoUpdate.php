<?php
include '../config/conexao.php';

$id = $_POST['id'];
$nome = $_POST['nome'];
$categoria = $_POST['categoria'];
$preco = $_POST['preco'];


$sqlImg = "SELECT imagem FROM produtos WHERE id = $id LIMIT 1";
$resImg = mysqli_query($conn, $sqlImg);
$dadosImg = mysqli_fetch_assoc($resImg);
$imagemAtual = $dadosImg['imagem'];


if (!empty($_FILES['imagem']['name'])) {

    $novaImg = $_FILES['imagem'];

    $pasta = "../uploads/produtos/";
    $nomeImg = uniqid() . "-" . $novaImg['name'];
    $caminhoCompleto = $pasta . $nomeImg;

    
    if (move_uploaded_file($novaImg['tmp_name'], $caminhoCompleto)) {
        
        $imagemFinal = $nomeImg;

        
        if (file_exists("../uploads/" . $imagemAtual)) {
            unlink("../uploads/" . $imagemAtual);
        }

    } else {
        $imagemFinal = $imagemAtual; 
    }

} else {
    
    $imagemFinal = $imagemAtual;
}


$sql = "UPDATE produtos 
        SET nome='$nome', categoria='$categoria', preco='$preco', imagem='$imagemFinal'
        WHERE id=$id";

if (mysqli_query($conn, $sql)) {
    header("Location: ../paginas/dashboard.php?msg=produto_atualizado");
    exit;
} else {
    echo "Erro ao atualizar produto: " . mysqli_error($conn);
}
