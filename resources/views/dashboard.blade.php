@extends('layouts.app')
@section('content')
<div class="relative text-white flex items-top justify-center min-h-screen bg-gray-900 sm:items-center py-4 sm:pt-0 font-mono">
    <p>Your current plan: <span class="font-bold">{{$currentPlan->name}}</span>. <a class="underline text-gray-500" href="{{ route('billing') }}">Change plan</a></p>
</div>
@endsection