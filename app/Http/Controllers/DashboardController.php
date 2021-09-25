<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $currentSubscription = $user->subscription('default')->stripe_price;        
        $currentPlan = Plan::where('stripe_price_id', $currentSubscription)->first() ?? NULL;
        $paymentMethods = $user->paymentMethods();
        $defaultPaymentMethod = $user->defaultPaymentMethod();
        // dd($paymentMethods[0]);
        return view('dashboard', compact('currentPlan', 'paymentMethods', 'defaultPaymentMethod'));
    }
    
}
