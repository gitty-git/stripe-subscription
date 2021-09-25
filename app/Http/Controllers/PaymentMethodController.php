<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;

class PaymentMethodController extends Controller
{
    public function create()
    {
        $intent = auth()->user()->createSetupIntent();
        return view('payment_methods.create', compact('intent'));   
    }

    public function store(Request $request)
    {   
        $user = auth()->user();
        $paymentMethod = $request->input('payment_method');

        try {            
            $user->addPaymentMethod($paymentMethod);
            
            if ($request->has('default_payment')) {
                $user->updateDefaultPaymentMethod($paymentMethod);
            }
        }
        catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }

        return redirect()->route('dashboard')->withMessage("The payment method has been added");
    }

    public function update(Request $request, $paymentMethod)
    {
        try {            
            auth()->user()->updateDefaultPaymentMethod($paymentMethod);
        }
        catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }

        return redirect()->route('dashboard')->withMessage("The payment method has been updated.");
    }

    public function destroy($paymentMethod)
    {
        $paymentMethod = auth()->user()->findPaymentMethod($paymentMethod);
        $paymentMethod->delete();

        return redirect()->route('dashboard')->withMessage("The payment method has been deleted.");
    }
}
