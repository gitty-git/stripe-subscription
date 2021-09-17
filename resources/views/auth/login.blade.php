@extends('layouts.app')
@section('content')
<div class="w-96">
    <div class=" text-5xl font-bold">Login</div>
    <div class="text-gray-500 text-xl">Or <a href="{{ route('register') }}" class="underline">start 10-day free trial</a></div>

    <form action="{{ route('login') }}" class="mt-12">
        <div class="mt-6">
            <label for="email">Email</label>
            <input class="bg-gray-900  w-full p-2 border-2 border-gray-800 rounded-xl hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-gray-600 focus:ring-opacity-50" type="email" name="email">
        </div>

        <div class="mt-6">
            <label for="password">Password</label>
            <input class="bg-gray-900  w-full p-2 border-2 border-gray-800 rounded-xl hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-gray-600 focus:ring-opacity-50" type="password" name="password">
        </div>

        <div class="mt-6 flex  justify-between">
            <label class="flex items-center"><input class="w-4 h-4 -mt-1 bg-gray-900" type="checkbox" name="remember_me" value="value"><span class="ml-2">Remember me</span></label>
            <a class="underline" href="#">Forgot your password?</a>
        </div>

        <button type="submit" class="bg-white text-gray-900 w-full mt-6 p-2 rounded-xl hover:bg-gray-900 hover:border border-2 border-gray-800 hover:text-white duration-150 font-bold">Enter</button>
    </form>
</div>

@endsection