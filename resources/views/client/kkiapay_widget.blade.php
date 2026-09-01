<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paiement sécurisé - KKiaPay</title>
    <script src="https://cdn.kkiapay.me/k.js"></script>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #F2F2F2;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
        }
        .loader-container {
            text-align: center;
            background: white;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        .spinner {
            border: 4px solid #f3f3f3;
            border-top: 4px solid #D87D4A;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            animation: spin 1s linear infinite;
            margin: 0 auto 20px;
        }
        @keyframes spin { 0% { transform: rotate(0deg); } 100% { transform: rotate(360deg); } }
        .btn-fallback {
            display: none;
            margin-top: 20px;
            padding: 12px 24px;
            background-color: #D87D4A;
            color: white;
            border: none;
            border-radius: 8px;
            font-weight: bold;
            cursor: pointer;
            font-size: 16px;
        }
        .btn-fallback:hover { background-color: #c06a3a; }
    </style>
</head>
<body>

    <div class="loader-container">
        <div class="spinner"></div>
        <p id="status-text">Initialisation du module de paiement sécurisé...</p>
        <button id="manual-pay-btn" class="btn-fallback">
             Cliquer ici pour ouvrir le paiement
        </button>
        <p style="font-size: 12px; color: #808080; margin-top: 15px;">
            Si la fenêtre ne s'ouvre pas, vérifiez que votre bloqueur de publicités (AdBlock) est désactivé.
        </p>
    </div>

    <script>
        const kkiapayConfig = {
            amount: {{ $amountXof }},
            key: "{{ $publicKey }}",
            sandbox: {{ $sandbox ? 'true' : 'false' }},
            callback: "{{ $callbackUrl }}",
            phone: "{{ $phone }}",
            email: "{{ $commande->client->email }}",
            fullname: "{{ $commande->client->name }}",
            theme: "#D87D4A",
        };

        // Fonction pour déclencher le widget
        function openPayment() {
            try {
                openKkiapayWidget(kkiapayConfig);
            } catch (error) {
                console.error("Erreur d'ouverture du widget:", error);
                document.getElementById('status-text').innerText = "Le navigateur a bloqué l'ouverture automatique.";
                document.getElementById('manual-pay-btn').style.display = 'inline-block';
            }
        }

        // Tenter l'ouverture automatique après 500ms
        setTimeout(openPayment, 500);

        // Bouton de secours
        document.getElementById('manual-pay-btn').addEventListener('click', openPayment);

        // Écouteur de SUCCÈS
        addKkiapayListener('success', (response) => {
            console.log("Paiement réussi, ID:", response.transactionId);
            document.getElementById('status-text').innerText = "Vérification du paiement en cours...";

            // Envoi de l'ID au backend Laravel pour vérification sécurisée
            fetch("{{ route('payment.kkiapay.callback', $commande->id) }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ transaction_id: response.transactionId })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    window.location.href = data.redirect_url;
                } else {
                    alert("Erreur de vérification : " + data.message);
                    window.location.href = "{{ route('cart') }}";
                }
            })
            .catch(error => {
                console.error("Erreur fetch:", error);
                alert("Une erreur réseau est survenue.");
            });
        });

        // Écouteur d'ÉCHEC ou d'ANNULATION
        // (le bon nom d'événement est "failed", pas "error")
        addKkiapayListener('failed', () => {
            console.log("Paiement annulé ou échoué");
            alert("Le paiement a été annulé.");
            window.location.href = "{{ route('cart') }}";
        });
    </script>
</body>
</html>