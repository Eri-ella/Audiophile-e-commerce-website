<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\ProductController;
use App\Http\Controllers\Front\PaymentController;
use App\Http\Controllers\Back\ConnexionController;
use App\Http\Controllers\Back\dashboardController;
use Illuminate\Auth\Middleware\Authenticate;

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

// ** Payment **
Route::post('/payment', [PaymentController::class, 'store'])->name('payment.store');
Route::get('/payment/{id}', [PaymentController::class, 'show'])->name('payment.show');

// ** Cart : utilise l'ID **
Route::post('/cart/add/{id}',    [ProductController::class, 'addToCart'])->name('cart.add');
Route::post('/cart/update/{id}', [ProductController::class, 'updateCart'])->name('cart.update');
Route::post('/cart/remove-all',  [ProductController::class, 'removeAllCart'])->name('cart.removeAll');

// ** Admin **
Route::get('/connexion-admin', [ConnexionController::class, 'showLoginForm'])->name('connexion-admin.form');
Route::post('/connexion-admin', [ConnexionController::class, 'login'])->name('connexion-admin.login');

Route::middleware(['auth'])->group(function(){
    Route::get('/admin', function () {
        return view('admin.admin_page');
    })->name('admin');

    // apexcharts
    Route::get('/admin/dashboard/sales-data', [DashboardController::class, 'salesData'])
    ->name('admin.dashboard.sales-data');
});
    Route::get('/logout', [ConnexionController::class, 'logout'])->name('logout');

Route::get('/test', function () {
    return view('admin.test');
})->name('test');
