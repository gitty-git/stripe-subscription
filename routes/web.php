<?php

use App\Http\Controllers\BillingController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PaymentMethodController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [WelcomeController::class, 'index'])->name('welcome');

Route::group(['middleware' => 'auth'], fn() => 
    Route::get('billing', [BillingController::class, 'index'])->name('billing'),
    Route::get('checkout/{slug}', [CheckoutController::class, 'checkout'])->name('checkout'),
    Route::post('checkout', [CheckoutController::class, 'processCheckout'])->name('checkout.process'),
    Route::get('billing/cancel', [BillingController::class, 'cancel'])->name('billing.cancel'),
    Route::get('billing/resume', [BillingController::class, 'resume'])->name('billing.resume'),
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard'),
    Route::resource('payment-methods', PaymentMethodController::class),
    // Route::get('payment-methods/set-default/{id}', [PaymentMethodController::class, 'setDefault'])->name('payment-methods.set-default'),
);