<?php
include("../config/conexao.php");

$email = $_POST['email'];
$senha = $_POST['senha'];

$stmt = $conn->prepare("SELECT id, nome, senha FROM usuarios WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows === 1) 
{
    $usuario = $result->fetch_assoc();
    
    if (password_verify($senha, $usuario['senha'])) 
    {
        session_start();
        $_SESSION['usuario'] = $usuario;
        $_SESSION['logado'] = true;

        // Registrar log de login
        $usuario_id = $usuario['id'];
        $acao = 'Login';
        $stmt_log = $conn->prepare("INSERT INTO logs (usuario_id, acao) VALUES (?, ?)");
        $stmt_log->bind_param("is", $usuario_id, $acao);
        $stmt_log->execute();
        $stmt_log->close();

        header("Location: ../paginas/dashboard.php");
        exit();
    } 
    else 
    {
        header("Location: ../paginas/login2.php?erro=senha");
        exit();
    }
} 
else 
{
    header("Location: ../paginas/login2.php?erro=email");
    exit();
}

?>