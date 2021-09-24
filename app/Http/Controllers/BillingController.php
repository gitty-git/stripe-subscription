<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Http\Request;

class BillingController extends Controller
{
    public function index()
    {
        $plans = Plan::all();
        $currentPlan = auth()->user()->subscription('default') ?? NULL;
        return view('billing.index', compact('plans', 'currentPlan'));
    }

    public function cancel()
    {
        auth()->user()->subscription('default')->cancel();
        return redirect()->route('billing')->withMessage("You've canceled your plan");
    }

    public function resume()
    {
        auth()->user()->subscription('default')->resume();
        return redirect()->route('billing')->withMessage("You've resumed your plan");
    }
}
