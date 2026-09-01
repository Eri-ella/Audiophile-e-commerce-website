<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Order;
use App\Mail\OrderConfirmedMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class WebhookController extends Controller
{
    public function fedapay(Request $request)
    {
        $payload = $request->all();
        
        Log::info('📡 Webhook FedaPay reçu', $payload);
        
        $transactionId = $payload['data']['object']['id'] ?? null;
        $status        = $payload['data']['object']['status'] ?? null;
        
        if (!$transactionId) {
            return response('Missing transaction ID', 400);
        }
        
        $payment = Payment::where('fedapay_id', $transactionId)->first();
        
        if (!$payment) {
            Log::warning(" Webhook reçu pour transaction inconnue : $transactionId");
            return response('Payment not found', 404);
        }
        
        $commande = Order::with(['client', 'delivery', 'products'])->find($payment->order_id);
        
        if ($status === 'approved' && $commande->status !== 'paid') {
            $commande->update(['status' => 'paid']);
            $payment->update(['status' => 'approved']);
            
            Mail::to($commande->client->email)->send(new OrderConfirmedMail($commande));
            
            Log::info(" Commande #$commande->id marquée comme payée via webhook");
            
        } elseif ($status === 'declined' || $status === 'failed') {
            $commande->update(['status' => 'failed']);
            $payment->update(['status' => 'declined']);
            
            Log::info(" Commande #$commande->id échouée via webhook");
        }
        
        return response('OK', 200);
    }
}