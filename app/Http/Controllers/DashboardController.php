<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $currentSubscription = auth()->user()->subscription('default')->stripe_price;        
        $currentPlan = Plan::where('stripe_price_id', $currentSubscription)->firstOrFail();
        return view('dashboard', compact('currentPlan'));
    }
    
}
