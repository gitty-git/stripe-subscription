<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $currentPlan = NULL;
        $userSubscription = $user->subscription('default') ?? NULL;

        if (!is_null($userSubscription)) {
            $currentPlan = Plan::where('stripe_price_id', $userSubscription->stripe_price)->first() ?? NULL;
        }

        $paymentMethods = $user->paymentMethods();
        $defaultPaymentMethod = $user->defaultPaymentMethod();
        
        return view('dashboard', compact('userSubscription', 'paymentMethods', 'defaultPaymentMethod', 'currentPlan'));
    }
    
}
