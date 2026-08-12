<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\ProductController;
use App\Http\Controllers\Back\ConnexionController;

// ** client **

Route::get('/', [ProductController::class, 'index']) -> name('acceuil');

Route::get('/headphones', [ProductController::class, 'headphones']) -> name('headphones');

Route::get('/speakers', [ProductController::class, 'speakers']) -> name('speakers');

Route::get('/earphones', [ProductController::class, 'earphones']) -> name('earphones');

Route::get('/headphile1', [ProductController::class, 'headphile1'])->name('headphile1');

Route::get('/headphile2', [ProductController::class, 'headphile2'])->name('headphile2');

Route::get('/headphile3', [ProductController::class, 'headphile3'])->name('headphile3');

Route::get('/speaker1', [ProductController::class, 'speaker1'])->name('speaker1');

Route::get('/speaker2', [ProductController::class, 'speaker2'])->name('speaker2');

Route::get('/earphone1', [ProductController::class, 'earphone1'])->name('earphone1');

Route::get('/cart', [ProductController::class, 'cart'])->name('cart'); 

// ** admin **

Route::get('/connexion-admin', [ConnexionController::class, 'index'])->name('connexion-admin'); 

Route::get('/lateral', function(){
    return view('admin.lateral_bar');
})->name('lateral'); 
