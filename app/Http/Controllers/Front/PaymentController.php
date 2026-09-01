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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use FedaPay\FedaPay;
use FedaPay\Transaction;
use Kkiapay\Kkiapay;

class PaymentController extends Controller
{
    // ===== Affiche le formulaire de paiement (checkout) =====
    public function create()
    {
        $cart = session('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart');
        }

        return view('client.checkout', ['cart' => $cart]);
    }

    // ===== Traite la soumission du formulaire =====
    public function store(Request $request)
    {
        Log::info('Payment Form Data', $request->all());

        $validated = $request->validate([
            'name'             => 'required|string|max:255',
            'email'            => 'required|email',
            'phone'            => 'required|min:8',
            'address'          => 'required|string|max:255',
            'zip'              => 'required|numeric',
            'city'             => 'required|string|max:255',
            'country'          => 'required|string|max:255',
            'payment_method'   => 'required|in:e-money,cash',
            'payment_provider' => 'required_if:payment_method,e-money|in:fedapay,kkiapay',
        ], [
            'payment_provider.in' => 'Le prestataire de paiement doit être soit FedaPay, soit Kkiapay.',
        ]);

        $cart = session('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart');
        }

        $total      = collect($cart)->sum(fn ($i) => $i['price'] * $i['qty']);
        $grandTotal = $total + 50;

        // 1. Création en BDD (transaction atomique)
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
                'provider' => $validated['payment_method'] === 'e-money' ? $validated['payment_provider'] : 'cash',
                'status'   => $validated['payment_method'] === 'cash' ? 'approved' : 'pending',
            ]);

            $commande->update(['payment_id' => $payment->id]);

            foreach ($cart as $id => $item) {
                $commande->products()->attach($id, ['quantity' => $item['qty']]);
                Product::where('id', $id)->decrement('stock', $item['qty']);
            }

            return $commande->id;
        });

        // 2. Gestion CASH → confirmation immédiate
        if ($validated['payment_method'] === 'cash') {
            $commande = Order::with(['client', 'delivery', 'products'])->find($commandeId);
            $this->finalizeOrder($commande, Payment::where('order_id', $commandeId)->first());

            return redirect()->route('payment.success', $commandeId);
        }

        // 3. Gestion E-MONEY (FedaPay ou Kkiapay)
        $commande = Order::with('client')->findOrFail($commandeId);
        $amountXof = (int) round($commande->amount * config('services.fedapay.usd_to_xof', 600));

        if ($validated['payment_provider'] === 'fedapay') {
            return $this->processFedaPay($commande, $amountXof);
        }

        if ($validated['payment_provider'] === 'kkiapay') {
            return $this->processKkiapay($commande, $amountXof);
        }

        return redirect()->route('cart')->withErrors(['payment' => 'Méthode de paiement non reconnue.']);
    }

    // ===== Logique FedaPay =====
    private function processFedaPay($commande, $amountXof)
    {
        FedaPay::setApiKey(config('services.fedapay.secret'));
        FedaPay::setEnvironment(config('services.fedapay.env'));

        try {
            $transaction = Transaction::create([
                'amount'      => $amountXof,
                'currency'    => ['iso' => 'XOF'],
                'description' => 'Commande #' . $commande->id . ' - Audiophile',
                'customer'    => [
                    'email'        => $commande->client->email,
                    'firstname'    => $commande->client->name,
                    'lastname'     => $commande->client->name,
                    'phone_number' => [
                        'number'  => preg_replace('/[^0-9]/', '', $commande->client->telephone ?? ''),
                        'country' => 'bj',
                    ],
                ],
                'callback_url' => route('payment.fedapay.callback', $commande->id),
            ]);

            Payment::where('order_id', $commande->id)->update(['external_id' => $transaction->id]);

            $token = $transaction->generateToken();
            return redirect($token->url);

        } catch (\Throwable $e) {
            $commande->update(['status' => 'failed']);
            Log::error('FedaPay Error', ['message' => $e->getMessage()]);
            return redirect()->route('cart')->withErrors(['payment' => 'FedaPay indisponible : ' . $e->getMessage()]);
        }
    }

    // ===== Logique Kkiapay (widget JS côté client) =====
    private function processKkiapay($commande, $amountXof)
    {
        $phone = preg_replace('/[^0-9]/', '', $commande->client->telephone ?? '');
        if (strlen($phone) === 8) {
            $phone = '229' . $phone;
        }

        return view('client.kkiapay_widget', [
            'commande'    => $commande,
            'amountXof'   => $amountXof,
            'phone'       => $phone,
            'publicKey'   => config('services.kkiapay.public_key'),
            'sandbox'     => config('services.kkiapay.sandbox', true),
            'callbackUrl' => route('payment.kkiapay.callback', $commande->id),
        ]);
    }

    // ===== Callback FedaPay (appelé via redirection du navigateur, GET) =====
    public function fedapayCallback(Request $request, $orderId)
    {
        $commande = Order::findOrFail($orderId);
        $payment  = Payment::where('order_id', $commande->id)->first();

        FedaPay::setApiKey(config('services.fedapay.secret'));
        FedaPay::setEnvironment(config('services.fedapay.env'));

        $transactionId = $request->query('id') ?? $request->query('transaction_id') ?? $payment?->external_id;

        if (!$transactionId) {
            return redirect()->route('cart')->withErrors(['payment' => 'ID de transaction manquant.']);
        }

        try {
            $transaction = Transaction::retrieve($transactionId);

            if ($transaction && $transaction->status === 'approved') {
                $this->finalizeOrder($commande, $payment);
                return redirect()->route('payment.success', $orderId);
            }

            $commande->update(['status' => 'failed']);
            $payment?->update(['status' => 'declined']);
            return view('client.payment_failed', compact('commande'));

        } catch (\Throwable $e) {
            Log::error('FedaPay Callback Error', ['message' => $e->getMessage()]);
            return redirect()->route('cart')->withErrors(['payment' => 'Erreur FedaPay: ' . $e->getMessage()]);
        }
    }

    // ===== Callback Kkiapay (appelé en AJAX/fetch par le widget JS, POST) =====
    // Utilise le VRAI SDK PHP (verifyTransaction), pas une URL REST inventée.
    public function kkiapayCallback(Request $request, $orderId)
    {
        $commande = Order::findOrFail($orderId);
        $payment  = Payment::where('order_id', $commande->id)->first();

        $transactionId = $request->input('transaction_id') ?? $request->query('transaction_id');

        if (!$transactionId) {
            return response()->json(['success' => false, 'message' => 'ID de transaction manquant.'], 422);
        }

        try {
            $kkiapay = new Kkiapay(
                config('services.kkiapay.public_key'),
                config('services.kkiapay.private_key'),
                config('services.kkiapay.secret'),
                config('services.kkiapay.sandbox', true)
            );

            $result = $kkiapay->verifyTransaction($transactionId);

            Log::info('KKiaPay Verify Result', (array) $result);

            $payment?->update(['external_id' => $transactionId]);

            $status = is_array($result) ? ($result['status'] ?? null) : ($result->status ?? null);

            if ($status === 'SUCCESS') {
                $this->finalizeOrder($commande, $payment);

                return response()->json([
                    'success'      => true,
                    'redirect_url' => route('payment.success', $orderId),
                ]);
            }

            $commande->update(['status' => 'failed']);
            $payment?->update(['status' => 'declined']);

            return response()->json(['success' => false, 'message' => 'Paiement non approuvé par KKiaPay.'], 422);

        } catch (\Throwable $e) {
            Log::error('KKiaPay Callback Error', ['message' => $e->getMessage()]);
            $commande->update(['status' => 'failed']);
            $payment?->update(['status' => 'declined']);

            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    // ===== Méthode utilitaire pour finaliser une commande réussie =====
    private function finalizeOrder($commande, $payment)
    {
        $commande->update(['status' => 'paid']);
        $payment?->update(['status' => 'approved']);
        session()->forget('cart');

        $commande->load(['client', 'delivery', 'products']);

        try {
            Mail::to($commande->client->email)->send(new OrderConfirmedMail($commande));
        } catch (\Throwable $e) {
            // On ne bloque JAMAIS la confirmation de commande à cause d'un
            // souci d'envoi d'email (config SMTP down, etc.) — on log juste.
            Log::error('Erreur envoi email confirmation', ['message' => $e->getMessage()]);
        }
    }

    // ===== Page de succès unifiée (FedaPay, KKiaPay, Cash) =====
    public function success(string $id)
    {
        $commande = Order::with(['client', 'delivery', 'payment', 'products'])->findOrFail($id);

        return view('client.order_success', compact('commande'));
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