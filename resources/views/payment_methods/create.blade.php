@extends('layouts.app')
@section('content')

@if ($errors->any())
@foreach ($errors->all() as $error)
@include('partials.notification', ['message' => $error, 'colour' => 'red'])
@endforeach
@endif

<div class="relative text-white flex items-top justify-center min-h-screen bg-gray-900 sm:items-center py-4 sm:pt-0 font-mono">
    <form action="{{ route('payment-methods.store') }}" method="POST" id="checkout-form" class="w-96">
        @csrf
        <div class="pb-4 text-red-300 text-sm" id="payment-errors"></div>

        <input type="hidden" name="payment_method" id="payment_method" value="">

        <label for="name">Name</label>
        <input required id="card-holder-name" type="text" class="bg-gray-900 mb-8 w-full p-2 border-2 border-gray-800 rounded-xl hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-gray-600 focus:ring-opacity-50">

        <!-- Stripe Elements Placeholder -->
        <div id="card-element" class="mb-4"></div>

        <div class="mt-6 flex  justify-between">
            <label class="flex items-center">
                <input class="w-4 h-4 -mt-1 bg-gray-900" type="checkbox" name="default_payment" value="1">
                <span class="ml-2">Default method</span>
            </label>
        </div>

        <button data-secret="{{ $intent->client_secret }}" id="card-button" class="bg-white text-gray-900 w-full mt-6 p-2 rounded-xl hover:bg-gray-900 hover:border border-2 border-gray-800 hover:text-white duration-150 font-bold">
            Add payment method
        </button>
    </form>

    <div id="loading"></div>
</div>

<script src="https://js.stripe.com/v3/"></script>

<script>
    const checkoutForm = document.getElementById('checkout-form');
    const paymentErrors = document.getElementById('payment-errors');
    const loading = document.getElementById('loading');
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
                    color: '#FDE68A',
                },
                '::placeholder': {
                    color: '#737373',
                },
            },
            invalid: {
                iconColor: '#FCA5A5',
                color: '#FCA5A5',
            },
        }
    });
    cardElement.mount('#card-element');
    const cardHolderName = document.getElementById('card-holder-name');
    const cardButton = document.getElementById('card-button');
    const clientSecret = cardButton.dataset.secret;

    cardButton.addEventListener('click', async (e) => {
        e.preventDefault();
        if (cardHolderName.value.length === 0) {
            paymentErrors.innerHTML = "Name field is required.";
        } else {            
            cardButton.disabled = true;
            cardButton.innerHTML = 'Loading...';
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
                paymentErrors.innerHTML = error.message;
                cardButton.disabled = false;
                cardButton.innerHTML = 'Add payment method';
            } else {
                cardButton.disabled = true;
                document.getElementById("payment_method").value = setupIntent.payment_method;
                checkoutForm.submit();
            }
        }
    });
</script>
@endsection