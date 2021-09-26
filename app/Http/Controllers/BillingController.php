<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Exception;
use Illuminate\Http\Request;

class BillingController extends Controller
{
    public function index()
    {
        $plans = Plan::all();
        $userSubscription = auth()->user()->subscription('default') ?? NULL;
        $currentPlan = NULL;

        if (!is_null($userSubscription)) {
            $currentPlan = Plan::where('stripe_price_id', $userSubscription->stripe_price)->first() ?? NULL;
        }        

        return view('billing.index', compact('plans', 'userSubscription', 'currentPlan'));
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
