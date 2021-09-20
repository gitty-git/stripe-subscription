<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function checkout($slug)
    {
        $plan = Plan::where('slug', $slug)->firstOrFail();
        // $intent = Auth::user()->createSetupIntent();
        $intent = auth()->user()->createSetupIntent();
        return view('billing.checkout', compact('plan', 'intent'));
    }

    public function processCheckout()
    {
        //
    }
}
