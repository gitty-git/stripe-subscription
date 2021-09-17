@extends('layouts.app')
@section('content')
<div class="relative text-white flex items-top justify-center min-h-screen bg-gray-900 sm:items-center py-4 sm:pt-0 font-mono">
<div class="w-96">
    <div class=" text-5xl font-bold">Register</div>
    <div class="text-gray-500 text-xl">with 10-day free trial</div>

    <form action="{{ route('login') }}" class="mt-12">

        <div class="mt-6">
            <label for="name">Name</label>
            <input class="bg-gray-900  w-full p-2 border-2 border-gray-800 rounded-xl hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-gray-600 focus:ring-opacity-50" type="name" name="name">
        </div>

        <div class="mt-6">
            <label for="email">Email</label>
            <input class="bg-gray-900  w-full p-2 border-2 border-gray-800 rounded-xl hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-gray-600 focus:ring-opacity-50" type="email" name="email">
        </div>

        <div class="mt-6">
            <label for="password">Password</label>
            <input class="bg-gray-900  w-full p-2 border-2 border-gray-800 rounded-xl hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-gray-600 focus:ring-opacity-50" type="password" name="password">
        </div>

        <div class="mt-6">
            <label for="password_confirmation">Confirm password</label>
            <input class="bg-gray-900  w-full p-2 border-2 border-gray-800 rounded-xl hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-gray-600 focus:ring-opacity-50" type="password_confirmation" name="password_confirmation">
        </div>

        <div class="mt-6 flex">            
            <div class="text-gray-500">Already have an account?&nbsp;</div><a class="underline" href="{{ route('login') }}">Login</a>
        </div>

        <button type="submit" class="bg-white text-gray-900 w-full mt-6 p-2 rounded-xl hover:bg-gray-900 hover:border border-2 border-gray-800 hover:text-white duration-150 font-bold">Submit</button>
    </form>
</div>
</div>
@endsection