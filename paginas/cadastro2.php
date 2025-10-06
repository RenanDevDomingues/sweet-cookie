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
        <form action="../actions/UsuarioCreate.php" method="POST">
            <h2>Cadastro</h2>
            <div class="info">
                <input type="text" name="nome" placeholder=" " required>
                <label for="nome">Nome Completo</label>
            </div>
            <div class="info">
                <input type="email" name="email" placeholder=" " required>
                <label for="email">Email</label>
            </div>
            <div class="info">
                <input type="text" name="cpf" id="cpf" placeholder=" " required>
                <label for="cpf">CPF</label>
            </div>
            <div class="info">
                <input type="text" name="cep" id="cep" placeholder=" " required>
                <label for="cep">CEP</label>
                <a href="https://buscacepinter.correios.com.br/app/endereco/index.php">Não sei meu CEP</a>
            </div>
            <div class="info">
                <input type="text" name="bairro" id="bairro" placeholder=" " required>
                <label for="bairro">Bairro</label>
            </div>
            <div class="info">
                <input type="text" name="endereco" id="endereco" placeholder=" " required>
                <label for="endereço">Endereço</label>
            </div>
            <div class="info">
                <input type="text" name="numero" id="numero" placeholder=" " required>
                <label for="numero">N°</label>
            </div>
            <div class="info">
                <input type="text" name="complemento" placeholder=" " required>
                <label for="complemento">Complemento</label>
            </div>
            <div class="info">
                <input type="text" name="senha" placeholder=" " required>
                <label for="senha">Senha</label>
            </div>
            <div class="info">
                <input type="text" name="senha_confirmacao" id="senha_confirmacao" placeholder=" " required>
                <label for="senha_confirmacao">Confirmar Senha</label>
            </div>
            <div class="submit">
                <a href="login2.php">Você já possui Cadastro?</a>
                <button type="submit">Cadastrar</button>
            </div>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js"></script>
    <script>
        $('#cpf').mask('000.000.000-00', { reverse: true });
        $('#cep').mask('99999-999');

        const cepInput = $('#cep');
        const enderecoInput = $('#endereco');
        const bairroInput = $('#bairro');
        const numeroInput = $('#numero');

        cepInput.on('blur', () => 
        {
            let cep = cepInput.val().replace(/\D/g, '');

            if (cep.length > 8) cep = cep.slice(0, 8);
            if (cep.length >= 6){
                cepInput.value = cep.replace(/(\d{5})(\d{0,3})/, '$1-$2');
            } 
            else{
                cepInput.value = cep;
            }

            fetch(`https://viacep.com.br/ws/${cep}/json/`)
                .then(response => response.json())
                .then(data => 
                {
                    if (!data.erro) 
                    {
                        enderecoInput.val(data.logradouro);
                        bairroInput.val(data.bairro);
                        numeroInput.focus();

                    }
                })
                .catch(error => 
                {
                    console.error('Erro ao buscar CEP:', error);
                });
        });
    </script>
</body>

</html>