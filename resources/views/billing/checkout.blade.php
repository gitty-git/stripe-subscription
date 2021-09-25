@extends('layouts.app')
@section('content')

@if ($errors->any())
    @foreach ($errors->all() as $error)
        @include('partials.notification', ['message' => $error, 'colour' => 'red'])
    @endforeach
@endif

<div class="relative text-white flex items-top justify-center min-h-screen bg-gray-900 sm:items-center py-4 sm:pt-0 font-mono">
    <form action="{{ route('checkout.process') }}" method="POST" id="checkout-form" class="w-96">
        @csrf
        <div class="pb-4 text-red-300 text-sm" id="payment-errors"></div>

        <input type="hidden" name="billing_plan_id" value="{{ $plan->id }}" />

        <input type="hidden" name="payment_method" id="payment_method" value="">

        <label for="name">Name</label>
        <input id="card-holder-name" type="text" class="bg-gray-900 mb-8 w-full p-2 border-2 border-gray-800 rounded-xl hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-gray-600 focus:ring-opacity-50">

        <!-- Stripe Elements Placeholder -->
        <div id="card-element" class="mb-4"></div>

        <button data-secret="{{ $intent->client_secret }}" id="card-button" class="bg-white text-gray-900 w-full mt-6 p-2 rounded-xl hover:bg-gray-900 hover:border border-2 border-gray-800 hover:text-white duration-150 font-bold">
            Give ${{ number_format($plan->price / 100, 0) }}
        </button>
    </form>

    <div id="loading"></div>
</div>

<script src="https://js.stripe.com/v3/"></script>

<script>
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
        cardButton.disabled = true;
        cardButton.innerHTML = 'Loading...';
        const {setupIntent, error} = await stripe.confirmCardSetup(
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
            document.getElementById('payment-errors').innerHTML = error.message;
            cardButton.disabled = false;
            cardButton.innerHTML = 'Give ${{ number_format($plan->price / 100, 0) }}';
        } else {            
            cardButton.disabled = true;
            document.getElementById("payment_method").value = setupIntent.payment_method;
            document.getElementById('checkout-form').submit();
        }
    });
</script>
@endsection