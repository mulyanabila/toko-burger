<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| HALAMAN AWAL
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('welcome');
});

Route::get('/burger', function () {
    return view('landing');
});

Route::view('/about', 'about');

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/

// REGISTER
Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'register']);

// LOGIN
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// LOGOUT
Route::get('/logout', [AuthController::class, 'logout']);


/*
|--------------------------------------------------------------------------
| SETELAH LOGIN
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    // HOME MENU
   Route::get('/menu', [ProductController::class, 'index']);

    // CART
    Route::post('/cart/{id}', [OrderController::class, 'add']);
    Route::delete('/cart/item/{id}', [OrderController::class, 'delete']);
    Route::get('/cart', [OrderController::class, 'cart']);

    // CHECKOUT
    Route::get('/checkout', [OrderController::class, 'checkout']);

    // CANCEL
    Route::get('/cancel/{id}', [OrderController::class, 'cancel']);

    // PAY
    Route::get('/pay/{id}', [OrderController::class, 'pay']);
});

Route::middleware('auth')->group(function () {

    Route::get('/admin/products', [ProductController::class, 'admin']);

    Route::get('/admin/products/create', [ProductController::class, 'create']);

    Route::post('/admin/products/store', [ProductController::class, 'store']);

    Route::get('/admin/products/edit/{id}', [ProductController::class, 'edit']);

    Route::post('/admin/products/update/{id}', [ProductController::class, 'update']);

    Route::get('/admin/products/delete/{id}', [ProductController::class, 'delete']);

});