<?php
include("../config/conexao.php");

$nome = $_POST['nome'];
$email = $_POST['email'];
$cpf = $_POST['cpf'];
$cep = $_POST['cep'];
$bairro = $_POST['bairro'];
$endereco = $_POST['endereco'];
$numero = $_POST['numero'];
$complemento = $_POST['complemento'];
$senha = $_POST['senha'];

$senha_hash = password_hash($senha, PASSWORD_DEFAULT);
$stmt = $conn->prepare("INSERT INTO usuarios (nome, email, cpf, cep, bairro, endereco, numero, complemento, senha) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssssssss", $nome, $email, $cpf, $cep, $bairro, $endereco, $numero, $complemento, $senha_hash);

if ($stmt->execute())
{
    $stmt = $conn->prepare("SELECT id, nome, senha FROM usuarios WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();

    $result = $stmt->get_result();
    $usuario = $result->fetch_assoc();

    session_start();
    $_SESSION['usuario'] = $usuario;
    $_SESSION['logado'] = true;

    header("Location: ../index.php");
} 
else{
    header("Location: ../paginas/cadastro2.php");
}

$stmt->close();
$conn->close();


?>