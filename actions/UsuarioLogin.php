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

        
        header("Location: ../index.php");
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