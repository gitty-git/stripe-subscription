<?php

use App\Http\Controllers\BillingController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PaymentMethodController;

Route::get('/', [WelcomeController::class, 'index'])->name('welcome');

Route::group(['middleware' => 'auth'], function() { 
    Route::get('billing', [BillingController::class, 'index'])->name('billing');
    Route::get('checkout/{slug}', [CheckoutController::class, 'checkout'])->name('checkout');
    Route::post('checkout', [CheckoutController::class, 'processCheckout'])->name('checkout.process');
    Route::get('billing/cancel', [BillingController::class, 'cancel'])->name('billing.cancel');
    Route::get('billing/resume', [BillingController::class, 'resume'])->name('billing.resume');
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('payment-methods', PaymentMethodController::class);    
});

Route::stripeWebhooks('stripe-webhook');
