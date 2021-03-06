@extends('layouts.app')
@section('content')
<div class="text-center my-32 flex flex-col px-4 items-center bg-gray-900">
    <div class="font-bold text-4xl md:text-5xl w-full mb-6">
        Choose a plan where you can give your money to me:
    </div>

    <div class="text-gray-500 w-full text-2xl md:text-3xl">
        @if (is_null($userSubscription))
            <p>You are on free plan now</p>
        @elseif(!is_null($userSubscription))
            <p>Your current plan is <span class="font-bold">{{ $currentPlan->name }}</span>@if($userSubscription->onTrial()), the trial version of which will end in {{ $userSubscription->trial_ends_at->diffForHumans() }}@endif.</p>
        @endif
    </div>

    <div class="flex mt-24">
        <div class="md:text-2xl text-xl mx-4 md:mx-8">Monthly billing</div>

        <div class="relative w-14 flex items-center select-none transition duration-200 ease-in">
            <input type="checkbox" name="toggle" id="toggle" class="checked:right-0 mx-1 absolute block appearance-none w-6 h-6 bg-white cursor-pointer rounded-full" />
            <label for="toggle" class="w-full toggle-label block overflow-hidden h-8 rounded-full border-2 border-gray-500 cursor-pointer"></label>
        </div>

        <div class="md:text-2xl text-xl mx-4 md:mx-8">Yearly billing</div>
    </div>

    <div class="mt-12 sm:gap-8 lg:mx-auto space-y-4 xl:w-2/3 sm:space-y-0 sm:grid md:grid-cols-2 lg:max-w-4xl sm:mt-16 xl:max-w-none xl:mx-0 2xl:grid-cols-3">
        @foreach($plans as $plan)          
            @include('partials.billing-card', [
            'times' => 5,
            'billing_type' => $plan->name,
            'price' => number_format($plan->price / 100, 0),
            'checkout' => route('checkout', $plan->slug)])
        @endforeach
    </div>
</div>
@endsection