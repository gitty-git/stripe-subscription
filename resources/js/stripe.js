// Don't forget to add the stripe scripts! <script src="https://js.stripe.com/v3/"></script>
const stripe = Stripe("{{ env('STRIPE_KEY') }}");
const elements = stripe.elements();
const cardElement = elements.create('card', {
    style: {
        base: {
            iconColor: 'white',
            color: '#fff',
            fontWeight: '500',
            fontFamily: '"Courier Prime", "Courier New", monospace',
            fontSize: '16px',
            fontSmoothing: 'antialiased',
            ':-webkit-autofill': {
                color: '#fce883',
            },
            '::placeholder': {
                color: '#87BBFD',
            },
        },
        invalid: {
            iconColor: '#FFC7EE',
            color: '#FFC7EE',
        },
    }
});

cardElement.mount('#card-element');

const cardHolderName = document.getElementById('card-holder-name');
const cardButton = document.getElementById('card-button');
const clientSecret = cardButton.dataset.secret;

cardButton.addEventListener('click', async(e) => {
    e.preventDefault()
    const {
        setupIntent,
        error
    } = await stripe.confirmCardSetup(
        clientSecret, {
            payment_method: {
                card: cardElement,
                billing_details: {
                    name: cardHolderName.value
                }
            }
        }
    ).then(function(result) {
        if (result.error) {
            document.getElementById('payment_errors').innerHTML = result.error.message;
        } else {
            console.log(result);
            document.getElementById("payment_method").value = result.setupIntent.payment_method;
            document.getElementById('checkout_form').submit();
        }
    });
});