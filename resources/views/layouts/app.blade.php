<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body class="antialiased bg-gray-900 text-white font-mono px-4">
    @if (Route::has('login'))
    <div class="hidden fixed top-0 right-0 px-4 py-4 sm:block">
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

    @yield('content')
</body>

<footer class="text-left flex flex-col items-center text-gray-500 bg-gray-900">
    <div class="my-12 sm:gap-8 lg:mx-auto space-y-4 xl:w-2/3 sm:space-y-0 lg:max-w-4xl sm:mt-16 xl:max-w-none xl:mx-0">
        All rights reserved and so on and so forth...
    </div>
</footer>

<script src="{{ asset('js/app.js')}}"></script>
</html>