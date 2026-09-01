<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\ProductController;
use App\Http\Controllers\Front\PaymentController;
use App\Http\Controllers\Back\ProductController as ProductBackController;
use App\Http\Controllers\Back\ConnexionController;
use App\Http\Controllers\Back\CategoryController;
use App\Http\Controllers\Back\DashboardController;
use App\Http\Controllers\Front\WebhookController;

// ==========================================
// WEBHOOKS (Pour les notifications serveur)
// ==========================================
Route::post('/webhook/fedapay', [WebhookController::class, 'fedapay'])->name('webhook.fedapay');
// Route::post('/webhook/kkiapay', [WebhookController::class, 'kkiapay'])->name('webhook.kkiapay'); // À ajouter plus tard si besoin

// ==========================================
// CLIENT
// ==========================================
Route::get('/', [ProductController::class, 'index'])->name('acceuil');

Route::get('/headphones', [ProductController::class, 'headphones'])->name('headphones');
Route::get('/speakers',   [ProductController::class, 'speakers'])->name('speakers');
Route::get('/earphones',  [ProductController::class, 'earphones'])->name('earphones');

// Route unique avec ID
Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');

// Anciens liens (redirigent vers les IDs)
Route::get('/headphile1', fn () => redirect('/product/1'))->name('headphile1');
Route::get('/headphile2', fn () => redirect('/product/2'))->name('headphile2');
Route::get('/headphile3', fn () => redirect('/product/3'))->name('headphile3');
Route::get('/speaker1',   fn () => redirect('/product/4'))->name('speaker1');
Route::get('/speaker2',   fn () => redirect('/product/5'))->name('speaker2');
Route::get('/earphone1',  fn () => redirect('/product/6'))->name('earphone1');

Route::get('/cart', [ProductController::class, 'cart'])->name('cart');

// Cart : utilise l'ID
Route::post('/cart/add/{id}',    [ProductController::class, 'addToCart'])->name('cart.add');
Route::post('/cart/update/{id}', [ProductController::class, 'updateCart'])->name('cart.update');
Route::post('/cart/remove-all',  [ProductController::class, 'removeAllCart'])->name('cart.removeAll');

// ==========================================
// PAYMENT & CHECKOUT
// ==========================================
Route::get('/checkout', [PaymentController::class, 'create'])->name('checkout');
Route::post('/payment', [PaymentController::class, 'store'])->name('payment.store');
Route::get('/payment/{id}', [PaymentController::class, 'show'])->name('payment.show');

// Page de succès unifiée : FedaPay, KKiaPay et Cash y redirigent tous les 3
Route::get('/payment/success/{id}', [PaymentController::class, 'success'])->name('payment.success');

// Callback FedaPay : appelé par une redirection navigateur → reste en GET
Route::get('/payment/fedapay/callback/{orderId}', [PaymentController::class, 'fedapayCallback'])->name('payment.fedapay.callback');

// Callback KKiaPay : appelé en AJAX (fetch) depuis le widget JS → doit être en POST
Route::post('/payment/kkiapay/callback/{orderId}', [PaymentController::class, 'kkiapayCallback'])->name('payment.kkiapay.callback');

// ==========================================
// ADMIN
// ==========================================
Route::get('/connexion-admin', [ConnexionController::class, 'showLoginForm'])->name('connexion-admin.form');
Route::post('/connexion-admin', [ConnexionController::class, 'login'])->name('connexion-admin.login');

Route::middleware(['auth'])->group(function(){
    Route::get('/tableau-bord', [DashboardController::class,'index'])->name('admin.tableau-bord');

    // product
    Route::get('/product', [DashboardController::class,'index'])->name('admin.product');
    Route::post('/product/store', [ProductBackController::class, 'store'])->name('admin.add-product');
    Route::delete('/product/{id}', [ProductBackController::class, 'destroy'])->name('admin.delete-product');
    Route::put('/product/{id}', [ProductBackController::class, 'update'])->name('admin.update-product');
    Route::patch('/product/{id}/toggle', [ProductBackController::class, 'toggleStatus'])->name('product.toggle');

    //Route::get('/add-product', [DashboardController::class,'index'])->name('admin.add-product');
    // category 
    Route::get('/category', [DashboardController::class,'index'])->name('admin.category');
    Route::post('/category/store', [CategoryController::class, 'store'])->name('admin.add-category');
    Route::delete('/category/{id}', [CategoryController::class, 'destroy'])->name('admin.delete-category');
    Route::put('/category/{id}', [CategoryController::class, 'update'])->name('admin.update-category');
    Route::patch('/category/{id}/toggle', [CategoryController::class, 'toggleStatus'])->name('category.toggle');

    Route::get('/transaction', [DashboardController::class,'index'])->name('admin.transaction');
    Route::get('/user', [DashboardController::class,'index'])->name('admin.user');
    
    // adminitrateur
    Route::get('/setting', [DashboardController::class,'index'])->name('admin.setting');
    Route::put('/setting/{id}', [ConnexionController::class,'update'])->name('admin.update-setting');

    // log out
    Route::post('/logout', [ConnexionController::class, 'logout'])->name('logout');

    // apexcharts
    Route::get('/admin/dashboard/sales-data', [DashboardController::class, 'salesData'])->name('admin.dashboard.sales-data');
});
