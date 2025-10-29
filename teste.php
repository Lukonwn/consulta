<div class="step4">
  <h3 class="title">Pagamento</h3>
  <p class="text-center">Digite as informações do cartão</p>

  <!-- Escolha de método de pagamento -->
  <div class="payment-options">
    <button type="button" class="paypal">PayPal</button>
    <button type="button" class="credit-card">Cartão de Crédito</button>
  </div>

  <!-- Formulário de cartão seguro via Stripe -->
  <form id="payment-form">
    <div id="card-element"><!-- Stripe Elements inserirá o cartão aqui --></div>
    <div id="card-errors" role="alert"></div>
    <button type="submit">Pagar</button>
  </form>

  <button type="button" class="prev">Voltar</button>
</div>


<script src="https://js.stripe.com/v3/"></script>
<script>
  // Substitua pela sua chave pública do Stripe
  const stripe = Stripe('SUA_CHAVE_PUBLICA');
  const elements = stripe.elements();
  
  const style = {
    base: {
      color: "#32325d",
      fontFamily: 'Arial, sans-serif',
      fontSmoothing: "antialiased",
      fontSize: "16px",
      "::placeholder": { color: "#aab7c4" }
    },
    invalid: { color: "#fa755a", iconColor: "#fa755a" }
  };
  
  const card = elements.create("card", { style: style });
  card.mount("#card-element");

  card.on('change', function(event) {
    const displayError = document.getElementById('card-errors');
    if (event.error) {
      displayError.textContent = event.error.message;
    } else {
      displayError.textContent = '';
    }
  });

  const form = document.getElementById('payment-form');
  form.addEventListener('submit', async (event) => {
    event.preventDefault();

    const { paymentMethod, error } = await stripe.createPaymentMethod({
      type: 'card',
      card: card
    });

    if (error) {
      document.getElementById('card-errors').textContent = error.message;
    } else {
      // Aqui você envia paymentMethod.id para seu servidor
      fetch('/process_payment', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ paymentMethodId: paymentMethod.id })
      })
      .then(res => res.json())
      .then(data => {
        if(data.success){
          alert('Pagamento realizado com sucesso!');
          // Aqui você pode avançar para a próxima etapa ou mostrar confirmação
        } else {
          alert('Erro: ' + data.message);
        }
      });
    }
  });
</script>
