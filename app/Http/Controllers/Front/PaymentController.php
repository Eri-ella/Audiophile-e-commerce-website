<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Delivery;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use App\Models\User;
use App\Mail\OrderConfirmedMail;
use Illuminate\Support\Facades\Mail;
use FedaPay\FedaPay;
use FedaPay\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    // ===== Affiche le formulaire de paiement (checkout) =====
    public function create()
    {
        $confirmedId = session('confirmed_order_id');
        $cart = session('cart', []);

        if (empty($cart) && !$confirmedId) {
            return redirect()->route('cart');
        }

        $commande = null;
        if ($confirmedId) {
            $commande = Order::with(['client', 'delivery', 'payment', 'products'])->find($confirmedId);
        }

        return view('client.cart', [
            'cart'     => $cart,
            'commande' => $commande,
        ]);
    }

    // ===== Traite la soumission du formulaire =====
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'           => 'required|string|max:255',
            'email'          => 'required|email',
            'phone'          => 'required|min:8',
            'address'        => 'required|string|max:255',
            'zip'            => 'required|numeric',
            'city'           => 'required|string|max:255',
            'country'        => 'required|string|max:255',
            'payment_method' => 'required|in:e-money,cash',
        ]);

        $cart = session('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart');
        }

        $total      = collect($cart)->sum(fn ($i) => $i['price'] * $i['qty']);
        $grandTotal = $total + 50;

        // 🟦 1. Tout créer en BDD
        $commandeId = DB::transaction(function () use ($validated, $cart, $grandTotal) {
            $client = User::updateOrCreate(
                ['email' => $validated['email']],
                [
                    'name'      => $validated['name'],
                    'telephone' => $validated['phone'],
                    'role'      => 'client',
                    'password'  => bcrypt(str()->random(12)),
                ]
            );

            $delivery = Delivery::create([
                'address'  => $validated['address'],
                'zip_code' => $validated['zip'],
                'city'     => $validated['city'],
                'country'  => $validated['country'],
            ]);

            $commande = Order::create([
                'client_id'   => $client->id,
                'delivery_id' => $delivery->id,
                'amount'      => $grandTotal,
                'status'      => $validated['payment_method'] === 'cash' ? 'paid' : 'pending',
            ]);

            $payment = Payment::create([
                'order_id' => $commande->id,
                'type'     => $validated['payment_method'],
                'status'   => $validated['payment_method'] === 'cash' ? 'approved' : 'pending',
            ]);

            $commande->update(['payment_id' => $payment->id]);

            foreach ($cart as $id => $item) {
                $commande->products()->attach($id, ['quantity' => $item['qty']]);
                Product::where('id', $id)->decrement('stock', $item['qty']);
            }

            return $commande->id;
        });

        // 💵 CASH → on reste sur checkout + modale + email
        if ($validated['payment_method'] === 'cash') {
            session()->forget('cart');

            $commande = Order::with(['client', 'delivery', 'products'])->find($commandeId);
            Mail::to($commande->client->email)->send(new OrderConfirmedMail($commande));

            // ✅ Redirection vers cart avec commande en flash
            return redirect()->route('cart')->with('confirmed_order_id', $commandeId);
        }

        // 💳 E-MONEY → appel FedaPay
        $commande = Order::with('client')->findOrFail($commandeId);

        FedaPay::setApiKey(config('services.fedapay.secret'));
        FedaPay::setEnvironment(config('services.fedapay.env'));

        try {
            $transaction = Transaction::create([
                'amount'      => (int) round($commande->amount),
                'currency'    => ['iso' => 'XOF'],
                'description' => 'Commande #' . $commande->id . ' - Audiophile',
                'customer'    => [
                    'email'        => $commande->client->email,
                    'firstname'    => $commande->client->name,
                    'lastname'     => $commande->client->name,
                    'phone_number' => [
                        'number'  => preg_replace('/[^0-9+]/', '', $commande->client->telephone ?? ''),
                        'country' => 'bj',
                    ],
                ],
                'callback_url' => route('payment.callback', $commande->id),
            ]);

            Payment::where('order_id', $commande->id)->update(['fedapay_id' => $transaction->id]);

            $token = $transaction->generateToken();

            return redirect($token->url);

        } catch (\Throwable $e) {
            $commande->update(['status' => 'failed']);

            return redirect()
                ->route('cart')
                ->withErrors(['payment' => 'Service de paiement indisponible : ' . $e->getMessage()]);
        }
    }

    // 🔄 FedaPay renvoie le client ici après paiement
    public function callback(Request $request, $orderId)
    {
        $commande = Order::findOrFail($orderId);
        $payment  = Payment::where('order_id', $commande->id)->first();

        FedaPay::setApiKey(config('services.fedapay.secret'));
        FedaPay::setEnvironment(config('services.fedapay.env'));

        $transactionId = $request->query('id') ?? $request->query('transaction_id') ?? $payment?->fedapay_id;
        $transaction   = Transaction::retrieve($transactionId);

        if ($transaction && $transaction->status === 'approved') {
            $commande->update(['status' => 'paid']);
            $payment?->update(['status' => 'approved']);
            session()->forget('cart');

            $commande->load(['client', 'delivery', 'products']);
            Mail::to($commande->client->email)->send(new OrderConfirmedMail($commande));

            // ✅ On revient sur cart + modale
            return redirect()->route('cart')->with('confirmed_order_id', $orderId);
        }

        $commande->update(['status' => 'failed']);
        $payment?->update(['status' => 'declined']);
        return view('client.payment_failed', compact('commande'));
    }

    public function show(string $id)
    {
        $commande = Order::with(['client', 'delivery', 'payment', 'products'])->findOrFail($id);

        $cart = [];
        foreach ($commande->products as $product) {
            $cart[$product->id] = [
                'name'  => $product->name,
                'price' => $product->price,
                'image' => $product->image_1 ?? $product->image_description,
                'qty'   => $product->pivot->quantity,
            ];
        }

        return view('client.cart_box', [
            'cart'     => $cart,
            'commande' => $commande,
            'readonly' => true,
        ]);
    }
}