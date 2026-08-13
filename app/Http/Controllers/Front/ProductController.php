<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function index () {
        return view('client.index');
    }

    public function cart () {
        $cart = session('cart', []);
        return view('client.cart', ['cart' => $cart]);
    }

    // ** navbar **

    public function headphones () {
        return view('client.headphones');
    }

    public function speakers () {
        return view('client.speakers');
    }

    public function earphones () {
        return view('client.earphones');
    }

    // ** each product **

    // headphones

    public function headphile1 () {
        return view('client.headphile1');
    }

    public function headphile2 () {
        return view('client.headphile2');
    }

    public function headphile3 () {
        return view('client.headphile3');
    }

    // speakers

    public function speaker1 () {
        return view('client.speaker1');
    }

    public function speaker2 () {
        return view('client.speaker2');
    }

    // earphones

    public function earphone1 () {
        return view('client.earphone1');
    }
}
