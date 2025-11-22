<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sweet Cookies</title>
    <link rel="stylesheet" href="../css/cadastro.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body>

    <a href="../index.php" id="logo">
        <img src="../img/Sweet.svg" alt="Sweet Cookies" class="logo">
    </a>

    <div class="cadastro">
        <form method="POST" id="login-form">
            <h2>Faça o seu Login</h2>
            <div class="info">
                <input type="email" name="email" id="email-input" placeholder=" " required>
                <label for="email" id="email-label">Email</label>
            </div>
            <div class="info">
                <input type="password" name="senha" id="senha" placeholder=" " required>
                <label for="senha">Senha</label>
            </div>
            <div class="submit">
                <a href="cadastro.php">Você não está Cadastrado?</a>
                <button type="submit">Login</button>
            </div>
        </form>
    </div>
</body>

<script>
    $(document).ready(function () {

        $("#login-form").on("submit", function (e) {
            e.preventDefault();

            $.ajax({
                url: "../actions/UsuarioLogin.php",
                type: "POST",
                data: $(this).serialize(),
                success: async function (resposta) {

                    resposta = resposta.trim();

                    if (resposta === "LOGIN_CERTO") {
                        const ipAPI = "//api.ipify.org?format=json";
                        const response = await fetch(ipAPI);
                        const data = await response.json();

                        const { value: autenticacao } = await Swal.fire({
                            title: "Digite o nome de sua primeira escola",
                            input: "text",
                            showCancelButton: true,
                            inputValidator: (value) => {
                                if (!value) {
                                    return "Não pode estar vazio!";
                                }
                            }
                        });

                        if (autenticacao) {

                            $.post("../actions/UsuarioAuthenticate.php", { autenticacao: autenticacao }, function (authenticate) {

                                if (authenticate.trim() === "AUTENTICACAO_CERTA") {
                                    window.location.href = "../index.php";
                                }

                                if (authenticate.trim() === "ERRO_AUTENTICACAO_ERRADA") {
                                    Swal.fire("Escola Errada");
                                } else {
                                    Swal.fire(authenticate.trim());
                                }

                            });

                        }
                    }


                    if (resposta === "LOGIN_MASTER") {
                        window.location.href = "../paginas/dashboard.php";
                    }

                    if (resposta === "ERRO_SENHA") {
                        console.log("Senha incorreta");
                    }

                    if (resposta === "ERRO_EMAIL") {
                        console.log("Email não encontrado");
                    }
                }
                ,
                error: function (erro) {
                    console.log("Erro:");
                    console.log(erro);
                }
            });
        });

    });
</script>


</html>