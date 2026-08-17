<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Order;
use App\Models\Delivery;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Detail;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|regex:/^[\+\s\-\d+]+$/|min:10',
            'address' => 'required|string|max:255',
            'zip' => 'required|numeric',
            'city' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'payment_method' => 'required|in:e-money,cash',
            'e_money_number' => 'nullable',
            'e_money_pin' => 'nullable',
        ]);

        $commandeId = DB::transaction(function () use ($validated, $request) {
            $client = User::updateOrCreate(
                ['email' => $validated['email']],
                ['name' => $validated['name'], 'telephone' => $validated['phone']]
            );

            $commande = new Order();
            $commande->client_id = $client->id;
            $commande->amount = collect(session('cart', []))->sum(fn ($item) => $item['price'] * $item['qty']);

            $delivery = new Delivery();
            $delivery->address = $validated['address'];
            $delivery->zip_code = $validated['zip'];
            $delivery->city = $validated['city'];
            $delivery->country = $validated['country'];
            $delivery->save();

            $payment = new Payment();
            $payment->type = $validated['payment_method'];
            $payment->number = $validated['e_money_number'];
            $payment->pin = $validated['e_money_pin'];
            $payment->save();

            $commande->delivery_id = $delivery->id;
            $commande->payment_id = $payment->id;
            $commande->save();

            $attachedCount = 0;

            foreach (session('cart', []) as $slug => $item) {
                $product = !empty($item['id']) 
                    ? Product::find($item['id']) 
                    : Product::where('name', $item['name'])->first();
                
                if ($product) {
                    $commande->products()->attach($product->id, ['quantity' => $item['qty']]);
                    $attachedCount++;
                }
            }

            if ($attachedCount === 0) {
                throw new \Exception('Aucun produit n\'a pu être associé à cette commande.');
            }

            session()->forget('cart');

            return $commande->id;
        });

        return redirect()->route('payment.show', $commandeId); 
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $commande = Order::with(['client', 'delivery', 'payment', 'products'])->findOrFail($id);

        return view('client.payment_box', ['commande' => $commande]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
