<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Order;

class ProductController extends Controller
{
    public function index()
    {
        return view('client.index');
    }

    public function cart()
    {
        $cart = session('cart', []);

        // 🆕 Vérifie si on vient de payer (pour afficher la modale de récap)
        $confirmedId = session('confirmed_order_id');
        $commande = $confirmedId
            ? Order::with(['client', 'delivery', 'products'])->find($confirmedId)
            : null;

        return view('client.cart', [
            'cart'     => $cart,
            'commande' => $commande,
        ]);
    }

    // ** Navbar : passe les produits depuis la BDD **
    public function headphones()
    {
        $products = Product::whereHas('categories', fn ($q) => $q->where('name', 'headphones'))->get();
        return view('client.headphones', compact('products'));
    }

    public function speakers()
    {
        $products = Product::whereHas('categories', fn ($q) => $q->where('name', 'speakers'))->get();
        return view('client.speakers', compact('products'));
    }

    public function earphones()
    {
        $products = Product::whereHas('categories', fn ($q) => $q->where('name', 'earphones'))->get();
        return view('client.earphones', compact('products'));
    }

    // ** Page produit : utilise l'ID au lieu du slug **
    public function show(int $id)
    {
        $product = Product::with(['categories', 'contents'])->findOrFail($id);

        $views = [
            'headphones' => 'client.headphone',
            'speakers'   => 'client.speaker',
            'earphones'  => 'client.earphone',
        ];

        $view = $views[$product->categories?->name] ?? abort(404);

        $others = Product::where('id', '!=', $product->id)
                         ->with('categories')
                         ->latest()
                         ->limit(3)
                         ->get();

        return view($view, compact('product', 'others'));
    }

    // ** Cart : utilise l'ID au lieu du slug **
    public function addToCart(Request $request, int $id)
    {
        $cart = session('cart', []);
        $qtyAdded = (int) $request->input('qty', 1);

        $cart[$id] = [
            'id'    => $id,
            'name'  => $request->input('name'),
            'price' => (int) $request->input('price'),
            'image' => $request->input('image'),
            'qty'   => ($cart[$id]['qty'] ?? 0) + $qtyAdded,
        ];

        session(['cart' => $cart]);

        return back()->with('cart_success', [
            'qty'   => $qtyAdded,
            'total' => collect($cart)->sum('qty'),
        ]);
    }

    public function updateCart(Request $request, int $id)
    {
        $cart = session('cart', []);
        $delta = (int) $request->input('delta');

        if (isset($cart[$id])) {
            $cart[$id]['qty'] = max(0, $cart[$id]['qty'] + $delta);
            if ($cart[$id]['qty'] === 0) {
                unset($cart[$id]);
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