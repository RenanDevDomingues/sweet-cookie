<?php
include("../config/conexao.php");

$nome = $_POST['nome'];
$descricao = $_POST['descricao'];
$tipo = $_POST['tipo'];
$categoria = $_POST['categoria'];
$preco = $_POST['preco'];

$preco = str_replace(["R$", ".", ","], ["", "", "."], $preco);

$imagem = $_FILES['imagem'];

if ($imagem['error'] === 0) 
{
    $pasta = "../uploads/produtos/";

    if (!is_dir($pasta)){
        mkdir($pasta, 0777, true);
    }

    $nome_imagem = uniqid() . "-" . basename($imagem['name']);

    $caminho_imagem = $pasta . $nome_imagem;

    if (!move_uploaded_file($imagem['tmp_name'], $caminho_imagem)){
        die("Erro ao salvar a imagem!");
    }
} 
else{
    $nome_imagem = null;
}

$stmt = $conn->prepare("
    INSERT INTO produtos (nome, descricao, tipo, categoria, preco, imagem)
    VALUES (?, ?, ?, ?, ?, ?)
");

$stmt->bind_param("ssssds", 
    $nome, 
    $descricao, 
    $tipo, 
    $categoria, 
    $preco, 
    $nome_imagem
);

if ($stmt->execute())
{
    header("Location: ../paginas/dashboard.php");
    exit;
}
else{
    echo "Erro ao inserir produto: " . $stmt->error;
}

$stmt->close();
$conn->close();
