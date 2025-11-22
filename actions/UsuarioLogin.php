<?php
include("../config/conexao.php");

$email = $_POST['email'];
$senha = $_POST['senha'];

$stmt = $conn->prepare("SELECT id, nome, senha, nivel FROM usuarios WHERE email = ?");
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

        if ($usuario['nivel'] == '1') {
            $_SESSION['logado'] = false;
            echo "LOGIN_CERTO";
            exit();
        }
        
        if ($usuario['nivel'] == '2') {
            $_SESSION['logado'] = true;
            echo "LOGIN_MASTER";
            exit();
            
        }
        
        // Registrar log de login
        $usuario_id = $usuario['id'];
        $acao = 'Login';
        $stmt_log = $conn->prepare("INSERT INTO logs (usuario_id, acao) VALUES (?, ?)");
        $stmt_log->bind_param("is", $usuario_id, $acao);
        $stmt_log->execute();
        $stmt_log->close();
    } 
    else 
    {
        echo "ERRO_SENHA";
        exit();
    }
} 
else 
{
    echo "ERRO_EMAIL";
    exit();
}
?>
