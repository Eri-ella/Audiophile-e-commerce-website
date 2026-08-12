<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('client.index');
});

Route::get('/headphones', function () {
    return view('client.headphones');
});

Route::get('/speakers', function () {
    return view('client.speakers');
});

Route::get('/earphones', function () {
    return view('client.earphones');
});

Route::get('/headphile1', function () {
    return view('client.headphile1');
})->name('headphile1');

Route::get('/headphile2', function () {
    return view('client.headphile2');
})->name('headphile2');

Route::get('/headphile3', function () {
    return view('client.headphile3');
})->name('headphile3');

Route::get('/speaker1', function () {
    return view('client.speaker1');
})->name('speaker1');

Route::get('/speaker2', function () {
    return view('client.speaker2');
})->name('speaker2');

Route::get('/earphone1', function () {
    return view('client.earphone1');
})->name('earphone1');

Route::get('/cart', function () {
    $cart = session('cart', []);
    return view('client.cart', ['cart' => $cart]);
})->name('cart'); 
