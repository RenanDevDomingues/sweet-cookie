$(document).ready(function() {
    const $info_container = $('.info-pagamento');

    const templates = {
        pix: `
            <div class="payment-details fade-in">
                <p class="pix-text">
                    <strong style="color: #C62828;">Pague com Pix e ganhe aprovação imediata!</strong><br>
                    Ao finalizar o pedido, você receberá um QR Code para escanear ou um código "Copia e Cola".
                </p>
            </div>
        `,
        credito: `
            <div class="payment-details fade-in">
                <p style="margin-bottom: 15px; color: #666; font-size: 0.9rem;">Preencha os dados do seu cartão de crédito:</p>

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
                <p style="margin-bottom: 15px; color: #666; font-size: 0.9rem;">Preencha os dados do seu cartão de débito:</p>
                
                <div class="input-group">
                    <input type="text" name="debit_number" id="debit_number" placeholder=" " required>
                    <label for="debit_number">Número do Cartão</label>
                </div>

                <div class="input-group">
                    <input type="text" name="debit_name" id="debit_name" placeholder=" " required>
                    <label for="debit_name">Nome impresso no cartão</label>
                </div>

                <div class="row-inputs">
                    <div class="input-group">
                        <input type="text" name="debit_expiry" id="debit_expiry" placeholder=" " required maxlength="5">
                        <label for="debit_expiry">Validade (MM/AA)</label>
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

        if (templates[method]){
            $info_container.html(templates[method]);
            $info_container.css('margin-top', '30px');
            
        }
    });
});