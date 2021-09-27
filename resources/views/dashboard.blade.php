@extends('layouts.app')
@section('content')

<div class="relative flex flex-col text-white items-top justify-center min-h-screen bg-gray-900 sm:items-center py-4 sm:pt-0 font-mono">
    <div class="text-2xl mb-4">
        @if(is_null($userSubscription))
        <p>You are on <span class="font-bold">Free</span> plan now. <a class="underline text-gray-500" href="{{ route('billing') }}">Upgrade plan</a></p>
        @else
        <p>Your current plan: <span class="font-bold">{{ $currentPlan->name }}</span>. <a class="underline text-gray-500" href="{{ route('billing') }}">Change plan</a></p>
        @endif
    </div>
    
    <div class="border-2 px-4 py-6 mt-8 border-gray-800 rounded-xl">
        @if (count($paymentMethods) > 0)
        <p class="px-4 pb-4 text-xl">Your payment methods:</p>

        <table class="table-auto w-full">
            <thead>
                <tr>
                    <th class="p-4">Brand</th>
                    <th class="p-4">Expires at</th>
                    <th class="p-4">Last four symbols</th>
                    <th class="p-4">Is Default</th>
                    <th class="p-4"></th>
                </tr>
            </thead>
            
            <tbody>
                @foreach($paymentMethods as $paymentMethod)
                <tr>
                    <td class="p-4">{{ $paymentMethod->card->brand }}</td>
                    <td class="p-4">{{ $paymentMethod->card->exp_month }} / {{ $paymentMethod->card->exp_year }}</td>
                    <td class="p-4">............{{ $paymentMethod->card->last4 }}</td>
                    <td class="p-4 text-right">
                        @if ($defaultPaymentMethod && $defaultPaymentMethod->id === $paymentMethod->id)
                            Default
                        @else
                            <form action="{{ route('payment-methods.update', $paymentMethod->id) }}" method="POST">
                                @csrf 
                                @method('PUT')
                                <button class="underline text-gray-500" type="submit">Set default</button>
                            </form>                            
                        @endif
                    </td>
                    <td class="text-right p-4">
                        <form action="{{ route('payment-methods.destroy', $paymentMethod->id) }}" method="POST">
                            @csrf 
                            @method('DELETE')
                            <button type="submit">&#10006</button>
                        </form>                        
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <p class="px-4 text-gray-500 text-xl">You have no pyment methods yet.</p>
        @endif 
        <a href="{{ route('payment-methods.create') }}" class="bg-white flex mx-4 justify-center text-gray-900 mt-6 p-2 rounded-xl hover:bg-gray-900 hover:border border-2 border-gray-800 hover:text-white duration-150 font-bold">Add new payment method</a>
    </div>
       
</div>
@endsection