@extends('layouts.app')
@section('content')

<div class="relative text-white flex items-top justify-center min-h-screen bg-gray-900 sm:items-center py-4 sm:pt-0 font-mono">
    <form action="{{ route('checkout.process') }}" method="POST" id="checkout_form" class="w-96">
        @csrf
        <div class="pb-4 text-red-300 text-sm" id="payment_errors"></div>

        <input type="hidden" name="billing_plan_id" value="{{ $plan->id }}" />

        <input type="hidden" name="payment_method" id="payment_method" value="">

        <input id="card-holder-name" type="text" class="bg-gray-900 mb-8 w-full p-2 border-2 border-gray-800 rounded-xl hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-gray-600 focus:ring-opacity-50">

        <!-- Stripe Elements Placeholder -->
        <div id="card-element" class="mb-4"></div>

        <button data-secret="{{ $intent->client_secret }}" id="card-button" class="bg-white text-gray-900 w-full mt-6 p-2 rounded-xl hover:bg-gray-900 hover:border border-2 border-gray-800 hover:text-white duration-150 font-bold">
            Give ${{ number_format($plan->price / 100, 0) }}
        </button>
    </form>
</div>
@endsection