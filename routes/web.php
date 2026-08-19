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

// ** Route unique avec ID **
Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');

// ** Anciens liens (redirigent vers les IDs) **
Route::get('/headphile1', fn () => redirect('/product/1'))->name('headphile1');
Route::get('/headphile2', fn () => redirect('/product/2'))->name('headphile2');
Route::get('/headphile3', fn () => redirect('/product/3'))->name('headphile3');
Route::get('/speaker1',   fn () => redirect('/product/4'))->name('speaker1');
Route::get('/speaker2',   fn () => redirect('/product/5'))->name('speaker2');
Route::get('/earphone1',  fn () => redirect('/product/6'))->name('earphone1');

Route::get('/cart', [ProductController::class, 'cart'])->name('cart');

// ** Cart : utilise l'ID **
Route::post('/cart/add/{id}',    [ProductController::class, 'addToCart'])->name('cart.add');
Route::post('/cart/update/{id}', [ProductController::class, 'updateCart'])->name('cart.update');
Route::post('/cart/remove-all',  [ProductController::class, 'removeAllCart'])->name('cart.removeAll');

// ** Payment **
Route::get('/checkout', [PaymentController::class, 'create'])->name('checkout');
Route::post('/payment', [PaymentController::class, 'store'])->name('payment.store');
Route::get('/payment/{id}', [PaymentController::class, 'show'])->name('payment.show');
Route::get('/payment/callback/{orderId}', [PaymentController::class, 'callback'])->name('payment.callback');

// ** Admin : tout préfixé avec /admin pour éviter les conflits de noms **
Route::get('/connexion-admin', [ConnexionController::class, 'index'])->name('connexion-admin');

Route::get('/admin/lateral',     fn () => view('admin.lateral_bar'))->name('lateral');
Route::get('/admin/nav',         fn () => view('admin.nav_bar'))->name('nav');
Route::get('/admin/bord',        fn () => view('admin.tableau_bord'))->name('bord');
Route::get('/admin/product',     fn () => view('admin.product'))->name('product');
Route::get('/admin/addProduct',  fn () => view('admin.add_product'))->name('addProduct');
Route::get('/admin/setting',     fn () => view('admin.setting'))->name('setting');
Route::get('/admin/transaction', fn () => view('admin.transaction'))->name('transaction');
Route::get('/admin/user',        fn () => view('admin.user'))->name('user');