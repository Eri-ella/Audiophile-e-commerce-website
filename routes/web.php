<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\ProductController;
use App\Http\Controllers\Back\ConnexionController;
use App\Http\Controllers\Front\PaymentController;

// ** Client **
Route::get('/', [ProductController::class, 'index'])->name('acceuil');

Route::get('/headphones', [ProductController::class, 'headphones'])->name('headphones');
Route::get('/speakers',   [ProductController::class, 'speakers'])->name('speakers');
Route::get('/earphones',  [ProductController::class, 'earphones'])->name('earphones');

// ** Route unique et dynamique **
Route::get('/product/{slug}', [ProductController::class, 'show'])->name('product.show');

// ** Anciens liens (redirigent proprement) **
Route::get('/headphile1', fn () => redirect()->route('product.show', 'xx99-mark-ii'))->name('headphile1');
Route::get('/headphile2', fn () => redirect()->route('product.show', 'xx99-mark-i'))->name('headphile2');
Route::get('/headphile3', fn () => redirect()->route('product.show', 'xx59'))->name('headphile3');
Route::get('/speaker1',   fn () => redirect()->route('product.show', 'zx9-speaker'))->name('speaker1');
Route::get('/speaker2',   fn () => redirect()->route('product.show', 'zx7-speaker'))->name('speaker2');
Route::get('/earphone1',  fn () => redirect()->route('product.show', 'yx1-earphones'))->name('earphone1');

Route::get('/cart', [ProductController::class, 'cart'])->name('cart');

// ** Payment actions **
Route::post('/payment', [PaymentController::class, 'store'])->name('payment.store');
Route::get('/payment/{id}', [PaymentController::class, 'show'])->name('payment.show');

// ** Cart actions **
Route::post('/cart/add/{slug}',    [ProductController::class, 'addToCart'])->name('cart.add');
Route::post('/cart/update/{slug}', [ProductController::class, 'updateCart'])->name('cart.update');
Route::post('/cart/remove-all',    [ProductController::class, 'removeAllCart'])->name('cart.removeAll');

// ** Admin **
Route::get('/connexion-admin', [ConnexionController::class, 'index'])->name('connexion-admin');

Route::get('/lateral', function(){
    return view('admin.lateral_bar');
})->name('lateral');

Route::get('/nav', function(){
    return view('admin.nav_bar');
})->name('nav');

Route::get('/product', function(){
    return view('admin.product');
})->name('product');

Route::get('/transaction', function(){
    return view('admin.transaction');
})->name('transaction');

Route::get('/user', function(){
    return view('admin.user');
})->name('user');

