<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function index()
    {
        return view('client.index');
    }

    public function cart()
    {
        return view('client.cart', ['cart' => session('cart', [])]);
    }

    // ** Navbar **
    public function headphones() { return view('client.headphones'); }
    public function speakers()   { return view('client.speakers'); }
    public function earphones()  { return view('client.earphones'); }

    
    public function show(string $slug)
    {
        // Mapping : slug → vue Blade
        $views = [
            // Casques
            'xx99-mark-ii'  => 'client.headphone',
            'xx99-mark-i'   => 'client.headphone',
            'xx59'          => 'client.headphone',
            // Speakers
            'zx9-speaker'   => 'client.speaker',
            'zx7-speaker'   => 'client.speaker',
            // Earphones
            'yx1-earphones' => 'client.earphone',
        ];

        $view = $views[$slug] ?? abort(404);
        return view($view, compact('slug'));
    }

    // ** Cart actions **
    public function addToCart(Request $request, string $slug)
    {
        $cart = session('cart', []);
        $qtyAdded = (int) $request->input('qty', 1);

        $cart[$slug] = [
            'id'    => $request->input('id'),
            'name'  => $request->input('name'),
            'price' => (int) $request->input('price'),
            'image' => $request->input('image'),
            'qty'   => ($cart[$slug]['qty'] ?? 0) + $qtyAdded,
        ];

        session(['cart' => $cart]);

        return back()->with('cart_success', [
            'qty'   => $qtyAdded,
            'total' => collect($cart)->sum('qty'),
        ]);
    }

    public function updateCart(Request $request, string $slug)
    {
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

    public function removeAllCart()
    {
        session()->forget('cart');
        
        return back();
    }
}