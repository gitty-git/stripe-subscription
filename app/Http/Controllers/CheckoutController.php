<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Exception;
use Illuminate\Http\Request;
use Laravel\Cashier\Exceptions\IncompletePayment;

class CheckoutController extends Controller
{
    public function checkout($slug)
    {
        $plan = Plan::where('slug', $slug)->firstOrFail();
        $user = auth()->user();
        $currentPlan = $user->subscription('default') ?? NULL;

        if (!is_null($currentPlan) && $plan->stripe_price_id) {
            $currentPlan->swap($plan->stripe_price_id);
            return redirect()->route('billing')->withMessage("You've changed your plan to $plan->name plan");
        }

        $intent = $user->createSetupIntent();

        return view('billing.checkout', compact('plan', 'intent'));
    }

    public function processCheckout(Request $request)
    {
        $plan = Plan::findOrFail($request->input('billing_plan_id'));

        try {
            auth()->user()
                ->newSubscription('default', $plan->stripe_price_id)
                // ->trialDays(14)
                ->create($request->input('payment_method'));

            return redirect()->route('billing')->withMessage("You have been subscribed to $plan->name plan");
        }
        catch (IncompletePayment  $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }
}
