<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function checkout($slug)
    {
        $plan = Plan::where('slug', $slug)->firstOrFail();
        $intent = auth()->user()->createSetupIntent();
        return view('billing.checkout', compact('plan', 'intent'));
    }

    public function processCheckout(Request $request)
    {
        $plan = Plan::findOrFail($request->input('billing_plan_id'));

        try {
            auth()->user()
            ->newSubscription('default', $plan->stripe_price_id)
            ->create($request->input('payment_method'));
            return redirect()->route('billing')->withMessage("You have been subscribed to $plan->name plan");
        }
        catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }

        
    }
}
