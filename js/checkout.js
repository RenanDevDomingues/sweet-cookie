$(document).ready(function() {
    const $info_container = $('.info-pagamento');

    const templates = {
        pix: `
            <div class="payment-details fade-in">
                <p class="pix-text">
                    <strong style="color: #C62828;">Pague com Pix e ganhe aprovação imediata!</strong><br>
                    Ao finalizar o pedido, você receberá um QR Code.
                </p>
                <div class="pix-icon-area">
                    <img src="../img/pix.png" alt="Logo Pix" style="width: 30px; opacity: 0.8;">
                    <span>Pagamento rápido e seguro.</span>
                </div>
            </div>
        `,
        credito: `
            <div class="payment-details fade-in">
                <div class="input-group">
                    <input type="text" name="card_number" id="card_number" placeholder=" " required>
                    <label for="card_number">Número do Cartão</label>
                </div>
                <div class="input-group">
                    <input type="text" name="card_name" id="card_name" placeholder=" " required>
                    <label for="card_name">Nome impresso no cartão</label>
                </div>
                <div class="row-inputs">
                    <div class="input-group">
                        <input type="text" name="card_expiry" id="card_expiry" placeholder=" " required maxlength="5">
                        <label for="card_expiry">Validade (MM/AA)</label>
                    </div>
                    <div class="input-group">
                        <input type="text" name="card_cvv" id="card_cvv" placeholder=" " required maxlength="4">
                        <label for="card_cvv">CVV</label>
                    </div>
                </div>
                <div class="input-group">
                    <select name="parcelas" id="parcelas" style="width: 100%; padding: 14px; border: 2px solid #ddd; border-radius: 10px; background: transparent; color: #333; outline: none;">
                        <option value="1">1x sem juros</option>
                        <option value="2">2x sem juros</option>
                        <option value="3">3x sem juros</option>
                    </select>
                </div>
            </div>
        `,
        debito: `
            <div class="payment-details fade-in">
                <p style="margin-bottom: 15px; color: #666; font-size: 0.9rem;">Dados do cartão de débito:</p>
                <div class="input-group">
                    <input type="text" name="debit_number" id="debit_number" placeholder=" " required>
                    <label for="debit_number">Número do Cartão</label>
                </div>
                <div class="input-group">
                    <input type="text" name="debit_name" id="debit_name" placeholder=" " required>
                    <label for="debit_name">Nome impresso</label>
                </div>
                <div class="row-inputs">
                    <div class="input-group">
                        <input type="text" name="debit_expiry" id="debit_expiry" placeholder=" " required maxlength="5">
                        <label for="debit_expiry">Validade</label>
                    </div>
                    <div class="input-group">
                        <input type="text" name="debit_cvv" id="debit_cvv" placeholder=" " required maxlength="4">
                        <label for="debit_cvv">CVV</label>
                    </div>
                </div>
            </div>
        `
    };

    $('.pag-option').on('click', function() 
    {
        $('.pag-option').removeClass('active');
        $(this).addClass('active');
        $(this).find('input[type="radio"]').prop('checked', true);

        const method = $(this).data('method');

        if (templates[method]) 
        {
            $info_container.html(templates[method]);
            $info_container.css('margin-top', '30px');
        }
    });

    $('#buscar-cep').on('click', function(e) 
    {
        e.preventDefault();
        
        let cep = $('#cep').val().replace(/\D/g, '');

        if (cep.length === 8) 
        {
            let btnText = $(this).text();
            $(this).text('Buscando...').prop('disabled', true);

            $.getJSON(`https://viacep.com.br/ws/${cep}/json/`, function(data) 
            {
                $('#buscar-cep').text(btnText).prop('disabled', false);

                if (!data.erro) 
                {
                    $('#logradouro').val(data.logradouro).focus();
                    $('#bairro').val(data.bairro);
                    $('#cidade').val(data.localidade);
                    $('#estado').val(data.uf);
                    $('#numero').focus();
                } 
                else 
                {
                    alert("CEP não encontrado.");
                    $('#cep').focus();
                }
            }).fail(function() {
                alert("Erro ao buscar CEP. Verifique sua conexão.");
                $('#buscar-cep').text(btnText).prop('disabled', false);
            });
        } else {
            alert("Digite um CEP válido com 8 dígitos.");
        }
    });

    $('.btn-finalizar').on('click', function(e) 
    {
        e.preventDefault();

        let dados = {
            email: $('#email').val(),
            pagamento: $('input[name="pagamento"]:checked').val(),
            
            cep: $('#cep').val(),
            logradouro: $('#logradouro').val(),
            numero: $('#numero').val(),
            complemento: $('#complemento').val(),
            bairro: $('#bairro').val(),
            cidade: $('#cidade').val(),
            estado: $('#estado').val(),
        };

        if (!dados.email) { alert("Preencha o e-mail."); return; }
        if (!dados.pagamento) { alert("Selecione uma forma de pagamento."); return; }
        if (!dados.cep || !dados.numero) { alert("Preencha o endereço completo."); return; }

        // Trava botão
        let $btn = $(this);
        $btn.text('Processando...').prop('disabled', true);

        $.ajax({
            url: '../actions/CreatePedido.php',
            method: 'POST',
            data: dados,
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success'){
                    window.location.href = response.redirect;
                } 
                else
                {
                    alert("Erro: " + response.message);
                    $btn.text('FINALIZAR PEDIDO').prop('disabled', false);
                }
            },
            error: function(xhr, status, error) 
            {
                console.error(xhr.responseText);
                alert("Ocorreu um erro ao processar o pedido.");
                $btn.text('FINALIZAR PEDIDO').prop('disabled', false);
            }
        });
    });

});