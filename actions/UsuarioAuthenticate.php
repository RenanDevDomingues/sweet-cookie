<?php
session_start();
include("../config/conexao.php");

$usuario = $_SESSION['usuario'];
$autenticacao = $_POST['autenticacao'];

$stmt = $conn->prepare("SELECT autenticacao FROM usuarios WHERE id = ?");
$stmt->bind_param("i", $usuario['id']);
$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $usuarioAuthenticate = $result->fetch_assoc();

    if ($autenticacao === $usuarioAuthenticate['autenticacao']) {
        $_SESSION['logado'] = true;
        echo "AUTENTICACAO_CERTA";
    } else {
        echo "ERRO_AUTENTICACAO_ERRADA";
    }

} else {
    echo 'ERRO_USUARIO_NAO_ENCONTRADO';
    exit();
}