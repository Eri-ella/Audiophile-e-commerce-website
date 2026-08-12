<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('client.index');
});

Route::get('/layout', function () {
    return view('layout.client_layout');
});

Route::get('/description', function () {
    return view('layout.description_layout');
});

Route::get('/product', function () {
    return view('layout.product_layout');
});

Route::get('/cart', function () {
    return view('client.cart_box');
});

Route::get('/payment', function () {
    return view('client.payment_box');
});