<?php 
session_start();
if (isset($_SESSION['usuario']['id'])) {
	include("../config/conexao.php");
	$usuario_id = $_SESSION['usuario']['id'];
	$acao = 'Logout';
	$stmt_log = $conn->prepare("INSERT INTO logs (usuario_id, acao) VALUES (?, ?)");
	$stmt_log->bind_param("is", $usuario_id, $acao);
	$stmt_log->execute();
	$stmt_log->close();
	$conn->close();
}
session_unset();
session_destroy();
header("Location: ../index.php");
?>