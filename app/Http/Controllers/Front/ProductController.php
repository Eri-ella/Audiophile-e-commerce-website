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

    // ** cart actions **

    public function addToCart (Request $request, string $slug) {
        $cart = session('cart', []);
        $qtyAdded = (int) $request->input('qty', 1);

        $cart[$slug] = [
            'name'  => $request->input('name'),
            'price' => (float) $request->input('price'),
            'image' => $request->input('image'),
            'qty'   => ($cart[$slug]['qty'] ?? 0) + $qtyAdded,
        ];

        session(['cart' => $cart]);

        $total = collect($cart)->sum('qty');

        return back()->with('cart_success', [
            'qty'   => $qtyAdded,
            'total' => $total,
        ]);
    }

    public function updateCart (Request $request, string $slug) {
        $cart = session('cart', []);
        $delta = (int) $request->input('delta');

        if (isset($cart[$slug])) {
            $cart[$slug]['qty'] = max(0, $cart[$slug]['qty'] + $delta);
            if ($cart[$slug]['qty'] === 0) {
                unset($cart[$slug]);
            }
        }

        session(['cart' => $cart]);

        return back();
    }

    public function removeAllCart () {
        session()->forget('cart');
        return back();
    }
}