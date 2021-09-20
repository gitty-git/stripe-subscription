<?php

use App\Http\Controllers\BillingController;
use App\Http\Controllers\CheckoutController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [BillingController::class, 'index']);

Route::group(['middleware' => 'auth'], fn() => 
    Route::get('checkout/{slug}', [CheckoutController::class, 'checkout'])->name('checkout'),
    Route::post('checkout', [CheckoutController::class, 'processCheckout'])->name('checkout.process'),
);