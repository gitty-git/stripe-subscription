@extends('layouts.app')
@section('content')
@if (Route::has('login'))
<div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
    @auth
    <a href="{{ url('/home') }}" class="text-2xl text-gray-500 dark:text-gray-500 underline">Home</a>
    @else
    <a href="{{ route('login') }}" class="text-2xl text-gray-500 dark:text-gray-500 underline">Log in</a>

    @if (Route::has('register'))
    <a href="{{ route('register') }}" class="ml-4 text-2xl text-gray-500 dark:text-gray-500 underline">Register</a>
    @endif
    @endauth
</div>
@endif

<div class="text-center flex flex-col items-center bg-gray-900">
    <div class="font-bold mt-32 text-4xl md:text-6xl w-full mb-6">
        This site can only take your money.
    </div>
    <div class="text-gray-500 w-full text-2xl md:text-3xl">Choose a plan where you can give your money to me:</div>

    <div class="flex mt-24">
        <div class="md:text-2xl text-xl mx-4 md:mx-8">Monthly billing</div>

        <div class="relative w-14 flex items-center select-none transition duration-200 ease-in">
            <input type="checkbox" name="toggle" id="toggle" class="checked:right-0 mx-1 absolute block w-6 h-6 rounded-full bg-white appearance-none cursor-pointer" />
            <label for="toggle" class="w-full toggle-label block overflow-hidden h-8 rounded-full border-2 border-gray-500 cursor-pointer"></label>
        </div>

        <div class="md:text-2xl text-xl mx-4 md:mx-8">Yearly billing</div>
    </div>

    <div class="mt-12 sm:gap-8 lg:mx-auto space-y-4 xl:w-2/3 sm:space-y-0 sm:grid md:grid-cols-2 lg:max-w-4xl sm:mt-16 xl:max-w-none xl:mx-0 2xl:grid-cols-3">
        @include('partials.billing-card', ['times' => 5, 'billing_type' => 'First', 'price' => 5, 'checkout' => '#'])
        @include('partials.billing-card', ['times' => 15, 'billing_type' => 'Second', 'price' => 15, 'checkout' => '#'])
        @include('partials.billing-card', ['times' => 30, 'billing_type' => 'Third', 'price' => 30, 'checkout' => '#'])
    </div>
</div>
@endsection