<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Http\Request;

class BillingController extends Controller
{
    public function index()
    {
        $plans = Plan::all();
        $currentPlan = auth()->user()->subscription('default')->stripe_price ?? NULL;
        return view('billing.index', compact('plans', 'currentPlan'));
    }
}
