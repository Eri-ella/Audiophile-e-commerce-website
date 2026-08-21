<!DOCTYPE html>
<html>
<body style="font-family: Arial, sans-serif; background: #f4f4f4; padding: 20px;">
    <div style="max-width: 600px; margin: auto; background: white; border-radius: 10px; overflow: hidden;">

        {{-- En-tête orange --}}
        <div style="background: #D87D4A; padding: 20px; text-align: center;">
            <h1 style="color: white; margin: 0;">AUDIOPHILE 🎧</h1>
        </div>

        <div style="padding: 30px;">
            <h2 style="color: #101010;">Merci {{ $commande->client->name }} !</h2>
            <p style="color: #555;">
                Votre commande <strong>#{{ $commande->id }}</strong> a bien été payée et confirmée.
                Elle sera bientôt en route vers chez vous ! 
            </p>

            {{-- Récap des articles --}}
            <h3 style="color: #D87D4A;">Vos articles :</h3>
            <table style="width: 100%; border-collapse: collapse;">
                @foreach ($commande->products as $product)
                    <tr>
                        <td style="padding: 8px; border-bottom: 1px solid #eee;">
                            {{ $product->name }} <span style="color:#999;">x{{ $product->pivot->quantity }}</span>
                        </td>
                        <td style="padding: 8px; border-bottom: 1px solid #eee; text-align: right;">
                            $ {{ number_format($product->price * $product->pivot->quantity, 0, ',', ',') }}
                        </td>
                    </tr>
                @endforeach
                <tr>
                    <td style="padding: 12px 8px; font-weight: bold;">TOTAL PAYÉ</td>
                    <td style="padding: 12px 8px; text-align: right; font-weight: bold; color: #D87D4A;">
                        $ {{ number_format($commande->amount, 0, ',', ',') }}
                    </td>
                </tr>
            </table>

            {{-- Adresse --}}
            <p style="color: #555; margin-top: 20px;">
                 <strong>Livraison à :</strong><br>
                {{ $commande->delivery->address }}, {{ $commande->delivery->city }}, {{ $commande->delivery->country }}
            </p>

            <p style="color: #999; font-size: 12px; margin-top: 30px;">
                Merci pour votre confiance ! — L'équipe Audiophile
            </p>
        </div>
    </div>
</body>
</html>