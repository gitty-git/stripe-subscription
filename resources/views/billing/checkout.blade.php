@extends('layouts.app')
@section('content')
<div class="relative text-white flex items-top justify-center min-h-screen bg-gray-900 sm:items-center py-4 sm:pt-0 font-mono">
    <form action="{{ route('checkout.process') }}" method="POST" id="checkout-form" class="w-96">
        @csrf
        <input type="hidden" name="billing_plan_id" value="{{ $plan->id }}" />
        <input id="card-holder-name" type="text" class="bg-gray-900 mb-8 w-full p-2 border-2 border-gray-800 rounded-xl hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-gray-600 focus:ring-opacity-50">
        <!-- Stripe Elements Placeholder -->
        <div id="card-element" class="mb-4"></div>
        <button id="card-button" data-secret="{{ $intent->client_secret }}" class="bg-white text-gray-900 w-full mt-6 p-2 rounded-xl hover:bg-gray-900 hover:border border-2 border-gray-800 hover:text-white duration-150 font-bold">
            Give ${{ number_format($plan->price / 100, 0) }}
        </button>
    </form>
</div>

<script src="https://js.stripe.com/v3/"></script>

<script>
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

    cardButton.addEventListener('click', async (e) => {
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
        );

        if (error) {
            // Display "error.message" to the user...
        } else {
            // The card has been verified successfully...
        }
    });
</script>

@endsection