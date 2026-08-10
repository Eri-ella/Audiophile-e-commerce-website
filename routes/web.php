<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('client.index');
});

Route::get('/layout', function () {
    return view('layout.client_layout');
});
