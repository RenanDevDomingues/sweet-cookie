<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sweet Cookies</title>
    <link rel="stylesheet" href="../css/cadastro.css">
</head>
<body>
    <div class="cadastro">
        <form action="../actions/UsuarioLogin.php" method="POST">
            <h2>Faça o seu Login</h2>
            <div class="info">
                <input type="email" name="email" id="email-input" placeholder=" " required>
                <label for="email" id="email-label">Email</label>
            </div>
            <div class="info">
                <input type="text" name="senha" placeholder=" " required>
                <label for="senha">Senha</label>
            </div>
            <div class="submit">
                <a href="cadastro2.php">Você não está Cadastrado?</a>
                <button type="submit">Login</button>
            </div>
        </form>
    </div>
</body>
</html>