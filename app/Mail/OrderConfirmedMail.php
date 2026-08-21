<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrderConfirmedMail extends Mailable
{
    use Queueable, SerializesModels;

    //  On passe la commande à l'email pour qu'il puisse afficher ses infos
    public function __construct(public Order $commande) {}

    // Le sujet de l'email
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '✅ Commande #' . $this->commande->id . ' confirmée - Audiophile',
        );
    }

    // Le "design" de l'email (la vue blade)
    public function content(): Content
    {
        return new Content(
            view: 'emails.order_confirmed',
        );
    }
}